<?php

namespace App\Http\Livewire\Component;

use App\Exports\GridExport;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\CustomClasses\ColectionPaginate;

class ChetakGrid extends Component
{
    use WithFileUploads;
    use WithPagination;
    // protected $paginationTheme = 'bootstrap';


    public $search_fields = [];
    public $search_fields2 = [];
    public $symbol_fields = [];
    public $per_page;
    public $conTap = null;
    public $conTap1;
    public $sortBy = null;
    public $orderBy = "desc";
    public $isFilter = null;
    public $headings = [];
    public $headings_filter = [];
    public $table;
    public $where_con;
    public $pk;
    public $pk_value;
    public $deleteModal = false;
    public $show_col = [];
    public $check_filter = [];
    public $search_global;
    public $title = "Title";
    public $store_data = [];
    public $is_edit;
    public $inline_edit;
    public $row_selected;
    public $current_page = 1;
    public $row_iteration = null;
    public $add_new = null;
    public $raw_query = null;
    public $total_sum = [];
    public $group_by = [];
    public $isExpand = false;
    public $expand_item = [];
    public $group_recoders = [];
    public $isGrouped = false;

    protected $listeners = ['close', 'sortIndex', 'getTableId', 'update', 'edit', 'editWithContextMenu', 'errowKeyPress', 'addNew', 'get_group_cols'];
    public function sortIndex($start, $end)
    {
        $start_key = null;
        $end_key = null;
        $start_array = [];
        $end_array = [];
        $headings = $this->headings;
        foreach ($headings as $key => $col) {
            if ($col['id'] == $start) {
                $start_key = $key;
                $start_array = $this->headings[$key];
                unset($this->headings[$key]);
            }
            if ($col['id'] == $end) {
                $end_key = $key;
                $end_array = $this->headings[$key];
                unset($this->headings[$key]);
            }
        }
        $this->headings[$end_key] = $start_array;
        $this->headings[$start_key] = $end_array;
    }




    public function getTableId($table_id, $column_code)
    {
        $this->store_data[$column_code] = $table_id;
    }
    public function rowSelected($id, $row_iteraion)
    {
        $this->row_selected = $id;
        $this->row_iteration = $row_iteraion;
    }
    public function mount(
        $headings = [],
        $table = null,
        $raw_query = null,
        $where_con = null,
        $title = [],
        $inline_edit = false,
        $deletable = false,
        $editable = false,
        $addable = false,
        $viewable = false,
        $exportable = false,
        $per_page_items = null,
    ) {
        // for no filter sample coloumn
        // [
        //     'id' => 1,
        //     'label' => 'Mat Code',
        //     'field' => 'mat_code',
        //     'field_type' => 'text',
        //     'filter' => false,
        // ],
        // for filter sample coloumn
        // [
        //     'id' => 1,
        //     'label' => 'Mat Code',
        //     'field' => 'mat_code',
        //     'field_type' => 'text',
        //     'filter' => true,
        // ],

        // for filter with relation
        // [
        //     'id' => 3,
        //     'label' => 'Material Type',
        //     'field' => 'mat_mattype_id',
        //     'field_type' => 'checkbox',
        //     'filter' => true,
        //     'relation' => [
        //         'table_name' => 'mst_material_types',
        //         'relation_col' => 'mattype_id',
        //         'display_col' => 'mattype_code',
        //     ],
        // ],
        $this->title = $title;
        $this->exportable  = $exportable;
        $this->deletable = $deletable;
        $this->editable = $editable;
        $this->addable = $addable;
        $this->viewable = $viewable;
        $this->per_page = $per_page_items;
        $this->inline_edit = $inline_edit;
        $this->raw_query = $raw_query;
        if ($raw_query) {
            $data = (array)collect(DB::select(DB::raw($this->raw_query)))->first();
            $viewReportColumns = array_keys($data);
            $this->pk = $viewReportColumns[0];
            if (count($headings) == 0) {

                $col_type = "text";
                $ctr = 1;
                foreach ($data as $key => $hd) {
                    if (is_numeric($data[$key])) {
                        $col_type = 'number';
                    } else {
                        $col_type = "text";
                    }
                    $headings[] = [
                        'id' => $ctr,
                        'label' => str_replace('_', ' ', $key),
                        'field' => $key,
                        'field_type' => 'text',
                        'number_format' => false,
                        'filter' => true,
                        'editable' => true,
                    ];
                    $ctr++;
                }
            }
            // dd($headings);
        } else {
            $heads = DB::getSchemaBuilder()->getColumnListing($table);
            $this->pk = $heads[0];
            $this->table = $table;
            $this->where_con = $where_con;
        }
        if (count($headings) > 0) {
            foreach ($this->headings as $key => $heading) {
                $this->symbol_fields[$heading['field']] = "=";
                // if ($raw_query) {
                //     $this->headings[$key]['relation'] = [];
                // }
            }
        } else {
            $skip_cols = ['NA', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at', 'id'];
            $field_type = [];
            $number_format = [];
            $col_type = DB::select(DB::raw("SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='" . $table . "'"));
            foreach ($col_type as $ct) {
                $type = $ct->DATA_TYPE;
                $field = $ct->COLUMN_NAME;
                if (strpos($type, 'int') !== false) {
                    $field_type[$field] = 'number';
                    $number_format[$field] = true;
                }
                if (strpos($type, 'bigint') !== false) {
                    $field_type[$field] = 'number';
                    $number_format[$field] = false;
                }
                if (strpos($type, 'decimal') !== false) {
                    $field_type[$field] = 'number';
                    $number_format[$field] = true;
                }

                if (strpos($type, 'bit') !== false) {
                    $field_type[$field] = 'number';
                    $number_format[$field] = false;
                }
                if (strpos($type, 'tinyint') !== false) {
                    $field_type[$field] = 'number';
                    $number_format[$field] = false;
                }
                if (strpos($type, 'smallint') !== false) {
                    $field_type[$field] = 'number';
                    $number_format[$field] = false;
                }
                if (strpos($type, 'char') !== false) {

                    $field_type[$field] = 'text';
                    $number_format[$field] = false;
                }
                if (strpos($type, 'timestamp') !== false) {
                    $field_type[$field] = 'date';
                    $number_format[$field] = false;
                }
                if (strpos($type, 'date') !== false) {
                    $field_type[$field] = 'date';
                    $number_format[$field] = false;
                }
                if (strpos($type, 'text') !== false) {
                    $field_type[$field] = 'text';
                    $number_format[$field] = false;
                }
            }
            foreach ($heads as $key => $hd) {
                if (array_search($hd, $skip_cols) || $this->pk == $hd) {
                    continue;
                }
                $headings[] = [
                    'id' => $key + 1,
                    'label' => str_replace('_', ' ', $hd),
                    'field' => $hd,
                    'field_type' => $field_type[$hd],
                    'number_format' => [$number_format[$hd], 2],
                    'filter' => true,
                    'editable' => true,
                ];
            }
            foreach ($headings as $heading) {
                $this->symbol_fields[$heading['field']] = "=";
            }
        }


        $keys = array_column($headings, 'id');
        array_multisort($keys, SORT_ASC, $headings);
        $this->headings = $headings;
        $this->headings_filter = $this->headings;
        foreach ($this->headings as $key => $col) {
            $this->show_col[$col['id']] = true;
            if ($col['field_type'] == 'checkbox') {
                if (isset($col['relation'])) {
                    $r_table_name = $col['relation']['table_name'];
                    $r_col_id = $col['relation']['relation_col'];
                    $r_col_display = $col['relation']['display_col'];
                    $this->check_filter[$col['field']] =  json_decode(json_encode(DB::table($table)
                        ->select($table . "." . $col['field'], $r_table_name . "." . $r_col_display)
                        ->leftJoin($r_table_name, function ($join) use ($col, $r_table_name, $r_col_id) {
                            $join->on($this->table . "." . $col['field'], '=', $r_table_name . "." . $r_col_id);
                        })
                        ->where($table . "." . 'deleted_at', NULL)
                        ->when($where_con, function ($q) use ($where_con) {
                            $q->whereRaw($where_con);
                        })
                        ->groupBy($table . "." . $col['field'], $r_table_name . "." . $r_col_display)
                        ->get()), true);
                }
            }
        }
        // dd($this->headings);
        foreach ($this->headings as $col) {
            if ($col['field_type'] == "checkbox") {
                if (isset($col['relation'])) {
                    foreach ($this->check_filter[$col['field']] as $key => $item_check) {
                        $mycol = $col['field'];
                        // $this->search_fields[$col['field']][$item_check[$mycol] ?? 'blank'] = true;
                    }
                }
            }
        }
    }
    public function get_group_cols($id)
    {
        foreach ($this->headings as $col) {
            if ($col['id'] == $id) {
                $this->group_by[] = $col['field'];
            }
        }
    }
    public function removeFromGroup($id)
    {
        unset($this->group_by[$id]);
    }

    public function expand($id)
    {
        $this->isExpand = true;
        $this->expand_item[] = $id;
        // dd($id);
    }
    public function collaps($id)
    {
        if (($key = array_search($id, $this->expand_item)) !== false) {
            unset($this->expand_item[$key]);
        }
    }
    public function render()
    {
        if ($this->raw_query) {
            $result = null;
            $paginatedResult = collect(DB::select(DB::raw($this->raw_query)));
            // dd($paginatedResult);
            foreach ($this->headings as $headings) {
                if (isset($headings['agg']) && $headings['agg'] == true && $headings['field_type'] == 'number') {
                    $this->total_sum[$headings['field']] = $paginatedResult->sum($headings['field']);
                }
            }

            if (count($this->search_fields) > 0) {
                $this->resetPage();
                foreach ($this->headings as $headings) {
                    $column = $headings['field'];
                    if ($headings['field_type'] == 'text') {
                        if (isset($this->search_fields[$headings['field']])) {
                            $paginatedResult = $paginatedResult->filter(function ($item) use ($column, $headings) {
                                if (strpos(strtolower($item->$column), strtolower($this->search_fields[$headings['field']])) !== false) {
                                    return true;
                                }
                                return false;;
                            });
                        }
                    }
                    if ($headings['field_type'] == 'number') {

                        if (isset($this->search_fields[$headings['field']]) && $this->search_fields[$headings['field']] != null) {
                            $paginatedResult = $paginatedResult->filter(function ($item) use ($column, $headings) {

                                switch ($this->symbol_fields[$headings['field']]) {
                                    case '>':
                                        if ($item->$column > $this->search_fields[$headings['field']]) {
                                            return true;
                                        }
                                        break;
                                    case '<':
                                        if ($item->$column < $this->search_fields[$headings['field']]) {
                                            return true;
                                        }
                                        break;
                                    case '<=':
                                        if ($item->$column <= $this->search_fields[$headings['field']]) {
                                            return true;
                                        }
                                        break;

                                    case '>=':
                                        if ($item->$column >= $this->search_fields[$headings['field']]) {
                                            return true;
                                        }
                                        break;

                                    case '!=':
                                        if ($item->$column != $this->search_fields[$headings['field']]) {
                                            return true;
                                        }
                                        break;
                                    case '==':
                                        if ($item->$column == $this->search_fields[$headings['field']]) {
                                            return true;
                                        }
                                        break;

                                    default:
                                        return false;
                                }
                                return false;
                            });
                        }
                        if (isset($this->search_fields[$headings['field']])) {
                        }
                    }
                }
            }
            if (!$this->per_page) {
                $per_page = 15;
            } else {
                $per_page = $this->per_page;
            }
            if (count($this->group_by) > 0) {
                foreach ($this->group_by as $group_col) {

                    $paginatedResult =   $paginatedResult->groupBy($group_col);
                }
                if ($this->sortBy) {
                    if ($this->orderBy == 'desc') {
                        $paginatedResult =  $paginatedResult->sortByDesc($this->sortBy);
                    } else {
                        $paginatedResult =  $paginatedResult->sortBy($this->sortBy);
                    }
                }
                $this->isGrouped = true;
                $recoders = ColectionPaginate::paginate($paginatedResult, $per_page);
            } else {
                if ($this->sortBy) {
                    if ($this->orderBy == 'desc') {
                        $paginatedResult =  $paginatedResult->sortByDesc($this->sortBy);
                    } else {
                        $paginatedResult =  $paginatedResult->sortBy($this->sortBy);
                    }
                }
                $recoders = ColectionPaginate::paginate($paginatedResult, $per_page);
            }
        } else {

            if (!$this->per_page) {
                $per_page = 15;
            } else {
                $per_page = $this->per_page;
            }
            $col_name = [];
            foreach ($this->headings as $key => $heading) {
                $column = $this->table . "." . $heading['field'];
                if (isset($heading['relation'])) {
                    $column = 't' . $key . "." . $heading['relation']['display_col'] . " as " . $heading['field'];
                }
                $col_name[] = $column;
            }
            $col_name[] = $this->table . "." . $this->pk;
            $recoders = DB::table($this->table)->select();
            if ($this->where_con) {
                $recoders =   $recoders->whereRaw($this->where_con);
            }
            if ($this->search_global) {
                $recoders =   $recoders->where(function ($q) use ($column, $recoders) {
                    foreach ($this->headings as $key1 => $headings) {
                        if (isset($headings['relation'])) {
                            $column = 't' . $key1  . "." . $headings['relation']['display_col'];
                            $q->orWhere($column, 'LIKE', '%' . $this->search_global . '%');
                        } else {
                            $column = $this->table . "." . $headings['field'];
                            $q->orWhere($column, 'LIKE', '%' . $this->search_global . '%');
                        }
                    }
                });
            }

            if (count($this->search_fields) > 0) {
                // $this->resetPage();
                foreach ($this->headings as $key => $headings) {
                    $column = $headings['field'];
                    if ($headings['field_type'] == 'text') {
                        if (isset($headings['relation'])) {
                            if (isset($this->search_fields[$headings['field']])) {
                                // $recoders =   $recoders->where($this->table . "." . $column, 'LIKE', '%' . $this->search_fields[$headings['field']] . '%');
                                $column = 't' . $key . "." . $headings['relation']['display_col'];
                                $recoders->where($column, 'LIKE', '%' . $this->search_fields[$headings['field']]  . '%');
                            }
                        } else {
                            if (isset($this->search_fields[$headings['field']])) {
                                $recoders =   $recoders->where($this->table . "." . $column, 'LIKE', '%' . $this->search_fields[$headings['field']] . '%');
                            }
                        }
                    }
                    if ($headings['field_type'] == 'number') {
                        if (isset($this->search_fields[$headings['field']]) && $this->search_fields[$headings['field']] != null) {
                            $recoders =   $recoders->whereRaw($this->table . "." . $column . $this->symbol_fields[$headings['field']] . $this->search_fields[$headings['field']]);
                        }
                    }

                    if ($headings['field_type'] == 'date') {
                        if ($headings['field_type'] == 'date') {
                            if (isset($this->search_fields[$headings['field']]) && isset($this->search_fields2[$headings['field']]) && $this->symbol_fields[$headings['field']] == "range") {
                                $recoders =   $recoders->whereRaw($this->table . "." . $column . " BETWEEN '" . $this->search_fields[$headings['field']] . "' AND '" . $this->search_fields2[$headings['field']] . "'");
                            } elseif (isset($this->search_fields[$headings['field']]) && $this->symbol_fields[$headings['field']] != "range") {
                                $recoders =   $recoders->whereRaw($this->table . "." . $column . " " . $this->symbol_fields[$headings['field']] . " '" . $this->search_fields[$headings['field']] . "'");
                            }
                        }
                    }
                    if ($headings['field_type'] == 'checkbox') {
                        $r_ids = [];
                        $r_id_null = null;
                        if (isset($this->search_fields[$headings['field']])) {
                            foreach ($this->search_fields[$headings['field']] as $key => $item) {
                                if ($item) {
                                    if ($key == 'blank') {
                                        $r_id_null = $key;
                                    } else {
                                        $r_ids[] = $key;
                                    }
                                }
                            }

                            if (count($r_ids) > 0) {
                                $ids = implode(",", $r_ids);
                                if ($r_id_null == 'blank') {

                                    $recoders =   $recoders->whereRaw("(" . $this->table . "." . $column . " in( " . $ids . ") or " . $this->table . "." . $column . " is null)");
                                } else {

                                    $recoders =   $recoders->whereRaw($this->table . "." . $column . " in( " . $ids . ")");
                                }
                            }
                        }
                    }
                }
            }

            foreach ($this->headings as $key => $headings) {
                if (isset($headings['relation'])) {
                    $recoders = $recoders->leftJoin($headings['relation']['table_name'] . ' as t' . $key, function ($join) use ($headings, $key) {
                        $join->on($this->table . "." . $headings['field'], '=', 't' . $key . "." . $headings['relation']['relation_col'])
                            ->selectRaw($headings['relation']['relation_col'] . "," . $headings['relation']['display_col']);
                    });
                }
            }

            if ($this->sortBy) {
                $recoders = $recoders->orderBy($this->sortBy, $this->orderBy);
            }

            $recoders = $recoders
                ->where($this->table . "." . 'deleted_at', NULL)
                ->select($col_name);

            foreach ($this->headings as $headings) {
                if (isset($headings['agg']) && $headings['agg'] == true && $headings['field_type'] == 'number') {
                    $this->total_sum[$headings['field']] = $recoders->sum($headings['field']);
                }
            }


            if (count($this->group_by) > 0) {
                $recoders = $recoders->get()->take(99);
                $gp = [];
                foreach ($this->group_by as $group_col) {
                    $gp[] = $group_col;
                }
                $recoders =   $recoders->groupBy($gp);

                $recoders = ColectionPaginate::paginate($recoders, $per_page);
                $this->current_page = $recoders->currentPage();
                $this->isGrouped = true;
            } else {
                $recoders = $recoders->paginate($per_page);
                $this->current_page = $recoders->currentPage();
            }
        }
        return view('livewire.component.chetak-grid', [
            'recoders' => $recoders,
        ]);
    }

    public function getPk($id, $action)
    {
        if ($action == "inlineEdit") {
            if ($this->raw_query) {
                $data = collect(DB::select(DB::raw($this->raw_query)))->where($this->pk, $id)->first();
            } else {
                $data = DB::table($this->table)->where($this->pk, $id)->first();
            }
            foreach ($this->headings as $heading) {
                $col = $heading['field'];
                if ($heading['field_type'] == "date") {
                    $this->store_data[$heading['field']] = $data->$col;
                } else {
                    $this->store_data[$heading['field']] = $data->$col;
                }
            }
            $this->pk_value = $id;
            $this->is_edit = true;
            // $this->emit('childRefresh', $data->$col != 0 ? $data->$col : null);
        } else {
            $this->emit('get_grid_id', $id, $action);
        }
    }
    public function editWithContextMenu($id)
    {
        $this->row_selected = $id;
        $this->edit();
    }

    public function errowKeyPress($action, $orderBy)
    {
        if (!$this->per_page) {
            $per_page = 15;
        } else {
            $per_page = $this->per_page;
        }
        if ($this->row_selected) {
            $pk = $this->pk;
            $d = null;
            if ($this->sortBy) {
                $sb = $this->sortBy;
                if ($this->raw_query) {
                    $data1 = collect(DB::select(DB::raw($this->raw_query)))->where($this->pk, $this->row_selected)->first();
                    $d = $data1->$sb;
                } else {
                    $data1 = DB::table($this->table)->where($this->pk, $this->row_selected)->first();
                    $d = $data1->$sb;
                }
            }

            if ($this->raw_query) {
                $data = collect(DB::select(DB::raw($this->raw_query)))->where($this->pk, $this->row_selected)->first();
            } else {
                $data = DB::table($this->table)
                    ->when($this->sortBy, function ($q) use ($orderBy, $action, $d) {

                        $q->where($this->sortBy, $action, $d)
                            ->orderBy($this->sortBy, $orderBy);
                    })
                    ->when(!$this->sortBy, function ($q) use ($orderBy, $action, $pk) {
                        $q->where($pk, $action, $this->row_selected)
                            ->orderBy($this->pk, $orderBy);
                    })
                    ->first();
            }
            if ($data) {
                $this->row_selected = $data->$pk;
            }
            if ($action == ">") {
                $this->row_iteration++;
            }
            if ($action == "<") {
                $this->row_iteration--;
            }
            if ($this->row_iteration > $per_page) {
                $this->current_page++;
                $this->row_iteration = 1;
            }
            if ($this->row_iteration < 1) {
                $this->current_page--;
                $this->row_iteration = $per_page;
            }
            Paginator::currentPageResolver(function () {
                return $this->current_page;
            });
            $this->editModeOff();
        }
    }

    public function edit()
    {
        if ($this->row_selected) {
            if ($this->raw_query) {
                $data = collect(DB::select(DB::raw($this->raw_query)))->where($this->pk, $this->row_selected)->first();
            } else {
                $data = DB::table($this->table)->where($this->pk, $this->row_selected)->first();
            }
            foreach ($this->headings as $heading) {
                $col = $heading['field'];
                if ($heading['field_type'] == "date") {
                    $this->store_data[$heading['field']] = $data->$col;
                } else {
                    $this->store_data[$heading['field']] = $data->$col;
                }
            }
            $this->pk_value = $this->row_selected;
            $this->is_edit = true;
            // $this->emit('childRefresh', $data->$col != 0 ? $data->$col : null);
            Paginator::currentPageResolver(function () {
                return $this->current_page;
            });
        }
    }

    public function editModeOff()
    {
        $this->pk_value = null;
        $this->is_edit = false;
        $this->store_data = [];
        $this->add_new = null;
    }

    public function addNew()
    {
        if ($this->inline_edit) {
            $this->add_new = 1;
            $this->pk_value = null;
        }
    }

    public function update()
    {

        if (count($this->store_data) > 0) {

            if ($this->pk_value) {
                if ($this->raw_query) {
                    $this->emit('getUpdatedData', $this->store_data);
                } else {
                    DB::table($this->table)->where($this->pk, $this->pk_value)->update($this->store_data);
                }
            } else {
                if ($this->raw_query) {
                    $this->emit('getAddedData', $this->store_data);
                } else {
                    DB::table($this->table)->insert($this->store_data);
                }
            }
            $this->editModeOff();
        }
    }

    public function updatedShowCol()
    {
        $headings = $this->headings_filter;

        foreach ($headings as $key => $col) {
            if ($this->show_col[$col['id']] == false) {
                unset($this->headings[$key]);
            } else {
                $this->headings[$key] = $this->headings_filter[$key];
            }
        }
        // dd($this->headings);
    }


    public function deleteModalShow($c_id)
    {
        $this->pk_value = $c_id;
        $this->deleteModal = true;
    }

    public function deleteRow($c_id)
    {
        if ($this->raw_query) {
            $this->emit('getDeletedData', $c_id);
        } else {
            DB::table($this->table)->where($this->pk, $this->pk_value)->update([
                'deleted_at' => now(),
                'deleted_by' => Auth::user()->id,
            ]);
        }

        $this->deleteModal = false;
    }

    public function close()
    {
        $this->editModeOff();
        $this->conTap = null;
    }
    public function showMenu($id)
    {
        if ($this->conTap == $id) {
            $this->conTap = null;
        } else {
            $this->conTap = $id;
            $this->conTap1 = 1;
        }
        $this->editModeOff();
    }

    public function clickAway()
    {
        if (!$this->conTap1) {
            if ($this->conTap)
                $this->conTap = null;
        } else {
            $this->conTap1 = null;
        }
    }

    public function sort($col)
    {
        $this->sortBy = $col;
        if ($this->orderBy == "desc") {
            $this->orderBy = "asc";
        } else {
            $this->orderBy = "desc";
        }
    }



    public function gridExport()
    {
        ini_set('max_execution_time', 1000);
        ini_set('memory_limit', '-1');
        $col_name = [];
        $col_name_export = [];
        $export_type = 0;
        foreach ($this->headings as $heading) {
            $column = $this->table . "." . $heading['field'];
            $column_export = $heading['label'];
            if (isset($heading['relation'])) {
                $column = $heading['relation']['display_col'];
            }
            $col_name[] = $column;
            $col_name_export[] = $column_export;
        }
        $col_name = [];
        foreach ($this->headings as $heading) {
            $column = $this->table . "." . $heading['field'];
            if (isset($heading['relation'])) {
                $column = $heading['relation']['table_name'] . "." . $heading['relation']['display_col'];
            }
            $col_name[] = $column;
        }
        if ($this->raw_query) {
            $recoders = collect(DB::select(DB::raw($this->raw_query)));
            $export_type = 1;
        } else {
            $col_name[] = $this->table . "." . $this->pk;
            $recoders = DB::table($this->table)->select();
            if ($this->where_con) {
                $recoders =   $recoders->whereRaw($this->where_con);
            }
            if ($this->search_global) {
                $recoders =   $recoders->where(function ($q) use ($column, $recoders) {
                    foreach ($this->headings as $headings) {
                        if (isset($headings['relation'])) {
                            $column = $headings['relation']['table_name'] . "." . $headings['relation']['display_col'];
                            $q->orWhere($column, 'LIKE', '%' . $this->search_global . '%');
                        } else {
                            $column = $this->table . "." . $headings['field'];
                            $q->orWhere($column, 'LIKE', '%' . $this->search_global . '%');
                        }
                    }
                });
            }

            if (count($this->search_fields) > 0) {
                foreach ($this->headings as $headings) {
                    $column = $headings['field'];
                    if ($headings['field_type'] == 'text') {
                        if (isset($this->search_fields[$headings['field']])) {
                            $recoders =   $recoders->where($this->table . "." . $column, 'LIKE', '%' . $this->search_fields[$headings['field']] . '%');
                        }
                    }
                    if ($headings['field_type'] == 'number') {
                        if (isset($this->search_fields[$headings['field']])) {
                            $recoders =   $recoders->whereRaw($this->table . "." . $column . $this->symbol_fields[$headings['field']] . $this->search_fields[$headings['field']]);
                        }
                    }

                    if ($headings['field_type'] == 'date') {
                        if ($headings['field_type'] == 'date') {
                            if (isset($this->search_fields[$headings['field']]) && isset($this->search_fields2[$headings['field']]) && $this->symbol_fields[$headings['field']] == "range") {
                                $recoders =   $recoders->whereRaw($this->table . "." . $column . " BETWEEN '" . $this->search_fields[$headings['field']] . "' AND '" . $this->search_fields2[$headings['field']] . "'");
                            } elseif (isset($this->search_fields[$headings['field']]) && $this->symbol_fields[$headings['field']] != "range") {
                                $recoders =   $recoders->whereRaw($this->table . "." . $column . " " . $this->symbol_fields[$headings['field']] . " '" . $this->search_fields[$headings['field']] . "'");
                            }
                        }
                    }
                    if ($headings['field_type'] == 'checkbox') {
                        $r_ids = [];
                        $r_id_null = null;
                        if (isset($this->search_fields[$headings['field']])) {
                            foreach ($this->search_fields[$headings['field']] as $key => $item) {
                                if ($item) {
                                    if ($key == 'blank') {
                                        $r_id_null = $key;
                                    } else {
                                        $r_ids[] = $key;
                                    }
                                }
                            }

                            if (count($r_ids) > 0) {
                                $ids = implode(",", $r_ids);
                                if ($r_id_null == 'blank') {

                                    $recoders =   $recoders->whereRaw("(" . $this->table . "." . $column . " in( " . $ids . ") or " . $this->table . "." . $column . " is null)");
                                } else {

                                    $recoders =   $recoders->whereRaw($this->table . "." . $column . " in( " . $ids . ")");
                                }
                            }
                        }
                    }
                }
            }

            foreach ($this->headings as $headings) {
                if (isset($headings['relation'])) {
                    $recoders = $recoders->leftJoin($headings['relation']['table_name'], function ($join) use ($headings) {
                        $join->on($this->table . "." . $headings['field'], '=', $headings['relation']['table_name'] . "." . $headings['relation']['relation_col'])
                            ->selectRaw($headings['relation']['relation_col'] . "," . $headings['relation']['display_col']);
                    });
                }
            }

            if ($this->sortBy) {
                $recoders = $recoders->orderBy($this->sortBy, $this->orderBy);
            }
            $recoders = $recoders
                ->where($this->table . "." . 'deleted_at', NULL)
                ->select($col_name);
        }
        return Excel::download(new GridExport($recoders, $col_name_export, $export_type), 'grid.csv');
    }

    function paginateCollection($collection, $perPage, $pageName = 'page', $fragment = null)
    {
        $currentPage = \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage($pageName);
        $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage);
        parse_str(request()->getQueryString(), $query);
        unset($query[$pageName]);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentPageItems,
            $collection->count(),
            $perPage,
            $currentPage,
            [
                'pageName' => $pageName,
                'path' => \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPath(),
                'query' => $query,
                'fragment' => $fragment
            ]
        );

        return $paginator;
    }
}
