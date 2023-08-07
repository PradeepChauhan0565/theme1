<?php

namespace App\Http\Livewire;

use App\Exports\GridExport;
use App\Models\MstEmployee;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\CustomClasses\ColectionPaginate;
use App\Models\MstCsStoneType;

class ChetakGrid extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


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
    public $exportable = false;
    public $deletable = false;
    public $editable = false;
    public $addable = false;
    public $viewable = false;
    public $dropdown_menu = [];
    public $context_menu = [];
    public $selected_checkbox = [];
    public $select_all;
    public $show_checkbox = false;
    public $imageZoom = false;
    public $per_page_item_show = false;
    public $groupable = false;
    public $image_zoom_path;
    public $chetak_grid_name;
    public $grid_selected = false;
    public $dragable = false;

    protected $listeners = ['userChange', 'close', 'sortIndex', 'getTableId', 'update', 'edit', 'editWithContextMenu', 'errowKeyPress', 'addNew', 'get_group_cols', 'refreshGrid', 'getDragRowId'];
    public function refreshGrid()
    {
    }

    public function gridSelected()
    {
        $this->grid_selected = !$this->grid_selected;
    }

    public function getDragRowId($start_id, $end_id, $chetak_grid_name)
    {
        if ($this->chetak_grid_name == $chetak_grid_name) {
            $ids = $start_id . "-" . $end_id;
            $this->emit('get_grid_id', $ids, $chetak_grid_name . '_drag_id');
        }
    }
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

    public function updatedSelectAll()
    {
        if ($this->select_all == true) {
            $pk = $this->pk;
            if ($this->raw_query) {
                $datas =  DB::select(DB::raw($this->raw_query));
                foreach ($datas as $data) {
                    $this->selected_checkbox[$data->$pk] = true;
                }
            } else {

                $datas =  DB::table($this->table)->get();
                foreach ($datas as $data) {
                    $this->selected_checkbox[$data->$pk] = true;
                }
            }
            $this->emit('get_grid_id', $this->selected_checkbox, $this->chetak_grid_name . '_selected_rows');
        } else {
            $this->selected_checkbox = [];
        }
    }

    public function hydrate()
    {
        $this->dispatchBrowserEvent('updateSelect2');
    }



    public function userChange($data, $col)
    {
        $this->store_data[$col] = $data;
    }

    public function showImage($path)
    {

        $this->image_zoom_path = $path;
        $this->imageZoom = true;
    }


    public function getTableId($table_id, $column_code)
    {
        $this->store_data[$column_code] = $table_id;
    }
    public function rowSelected($id, $row_iteraion)
    {
        $this->row_selected = $id;
        $this->row_iteration = $row_iteraion;
        $this->emit('get_grid_id', $id, $this->chetak_grid_name . '_click');
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
        $per_page_item_show = false,
        $dropdown_menu = [],
        $context_menu = [],
        $show_checkbox = false,
        $groupable = false,
        $sortBy = null,
        $grid_name = null,
        $dragable = false,
    ) {
        $this->dropdown_menu = $dropdown_menu;
        $this->context_menu = $context_menu;
        $this->title = $title;
        $this->exportable  = $exportable;
        $this->deletable = $deletable;
        $this->editable = $editable;
        $this->addable = $addable;
        $this->viewable = $viewable;
        $this->per_page = $per_page_items;
        $this->per_page_item_show = $per_page_item_show;
        $this->inline_edit = $inline_edit;
        $this->raw_query = $raw_query;
        $this->show_checkbox = $show_checkbox;
        $this->groupable = $groupable;
        $this->sortBy = $sortBy;
        $this->chetak_grid_name = $grid_name ?? $table;
        $this->headings = $headings;
        $this->dragable = $dragable;

        if ($raw_query) {
            $data = (array)collect(DB::select(DB::raw($this->raw_query)))->first();
            if (count($data) > 0) {
                $viewReportColumns = array_keys($data);
                $this->pk = $viewReportColumns[0];
            } else {
                $this->pk = $this->headings[0]['field'];
            }

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
        } else {
            // dd($table);
            $heads = DB::getSchemaBuilder()->getColumnListing($table);

            // $pk = DB::select("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE where  TABLE_NAME ='" . $table . "'");

            // if (count($pk)) {
            //     $this->pk = $pk[0]->COLUMN_NAME ?? $heads[0];
            // } else {
            //     $this->pk = $heads[0];
            // }
            $this->pk = $heads[0];
            $this->table = $table;
            $this->where_con = $where_con;
        }
        if (count($headings) > 0) {
            foreach ($headings as $key => $heading) {
                $this->symbol_fields[$heading['field']] = "=";
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
            $this->show_col[$col['id']] = $col['visibility'] ?? true;
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
        foreach ($this->headings as $heading) {
            $this->store_data[$heading['field']] = null;
            // $col = $heading['field'];
            // if ($heading['field_type'] == "date") {
            //     $this->store_data[$heading['field']] = $data->$col;
            // } else {
            //     if (isset($heading['multiple']) && $heading['multiple'] == true) {
            //         $ids =  DB::table($heading['relation']['map_table_name'])
            //             ->where($heading['relation']['map_relation_col_from'], $this->row_selected)
            //             ->pluck($heading['relation']['map_relation_col_to'])->toArray();

            //         $this->store_data[$heading['field']] = $ids;
            //     } else {

            //         $this->store_data[$heading['field']] = $data->$col;
            //     }
            // }
            if (isset($heading['default_value'])) {
                $this->store_data[$heading['field']] = $heading['default_value'];
            }
        }
        $this->updatedShowCol();
        $this->dispatchBrowserEvent('updateSelect2');
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

    public function recoders()
    {
        if ($this->raw_query) {
            $result = null;
            $paginatedResult = collect(DB::select(DB::raw($this->raw_query)));
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

                if (isset($heading['relation'])) {
                    if (isset($heading['multiple']) && $heading['multiple'] == true) {
                        // // $column = $this->table . "." . $heading['field'];
                        // $col_name[] = $heading['relation']['map_table_name'] . "." . $heading['field'];
                    } else {
                        $column = 't' . $key . "." . $heading['relation']['display_col'] . " as " . $heading['field'];
                        $col_name[] = 't' . $key . "." . $heading['relation']['display_col'] . " as " . $heading['field'];
                    }
                } else {
                    $column = $this->table . "." . $heading['field'];
                    $col_name[] = $this->table . "." . $heading['field'];
                }
                // $col_name[] = $column;
            }
            // dd($this->pk);
            $col_name[] = $this->table . "." . $this->pk;
            $recoders = DB::table($this->table)->select();
            if ($this->where_con) {
                $recoders =   $recoders->whereRaw($this->where_con);
            }
            if ($this->search_global) {
                $recoders =   $recoders->where(function ($q) use ($column, $recoders) {
                    foreach ($this->headings as $key1 => $headings) {
                        if (isset($headings['relation']) && !isset($headings['multiple'])) {
                            $column = 't' . $key1  . "." . $headings['relation']['display_col'];
                            $q->orWhere($column, 'LIKE', '%' . $this->search_global . '%');
                        } else {
                            $column = $this->table . "." . $headings['field'];
                            $q->orWhere($column, 'LIKE', '%' . $this->search_global . '%');
                        }
                    }
                });
            }


            // single column search code start
            if (count($this->search_fields) > 0) {
                foreach ($this->headings as $key => $headings) {
                    $column = $headings['field'];
                    if ($headings['field_type'] == 'text') {
                        if (isset($headings['relation'])) {

                            if (isset($this->search_fields[$headings['field']])) {
                                if (isset($headings['multiple'])) {
                                    $recoders =   $recoders->where($headings['field'], 'LIKE', '%' . $this->search_fields[$headings['field']] . '%');
                                } else {
                                    $column = 't' . $key . "." . $headings['relation']['display_col'];
                                    $recoders =   $recoders->where($column, 'LIKE', '%' . $this->search_fields[$headings['field']] . '%');
                                }

                                // $recoders->where($column, 'LIKE', '%' . $this->search_fields[$headings['field']]  . '%');
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
                    if ($headings['field_type'] == 'bit') {
                        if (isset($headings['fixed_value'])) {
                            if (isset($this->search_fields[$headings['field']])) {
                                $item = $this->search_fields[$headings['field']];
                                $filteredArray = array_filter($headings['fixed_value'], function ($element) use ($item) {
                                    return stripos($element, $item) !== false;
                                });
                                $filteredKeys = array_keys($filteredArray);
                                $ids = implode(",", $filteredKeys);
                                if (count($filteredKeys) > 0) {

                                    $recoders =   $recoders->whereRaw($this->table . "." . $column . " in( " . $ids . ")");
                                } else {
                                    $ids = 0;
                                    $recoders =   $recoders->whereRaw($this->table . "." . $column . " in( " . $ids . ")");
                                }
                            }
                        } else {

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
            }
            // single column search code end


            foreach ($this->headings as $key => $headings) {
                if (isset($headings['relation']) && !isset($headings['multiple'])) {
                    $raw_cols = $headings['relation']['relation_col'] . "," . $headings['relation']['display_col'];
                    if (isset($headings['relation']['display_col1'][0])) {
                        $raw_cols .= "," . $headings['relation']['display_col1'][0];
                        $col_name[] = 't' . $key . "." . $headings['relation']['display_col1'][0] . " as " . $headings['field'] . $headings['relation']['display_col1'][0];
                    } else {
                        $raw_cols .= "," . $headings['relation']['display_col'];
                        // $col_name[] = $headings['relation']['display_col'];
                    }
                    $recoders = $recoders->leftJoin($headings['relation']['table_name'] . ' as t' . $key, function ($join) use ($headings, $key, $raw_cols) {
                        $join->on($this->table . "." . $headings['field'], '=', 't' . $key . "." . $headings['relation']['relation_col'])
                            ->selectRaw($raw_cols)
                            ->where('t' . $key . '.deleted_at', null);
                    });
                    // dd($recoders->get());
                } elseif (isset($headings['multiple']) && $headings['multiple'] == true) {
                    $query = "select " . $this->pk . ", STRING_AGG(" . $headings['relation']['display_col'] . ",', ') as " . $headings['field'] . " from (SELECT " . $this->pk . "," . $headings['relation']['table_name'] . "." . $headings['relation']['display_col'] . " FROM " . $this->table . " JOIN " . $headings['relation']['map_table_name'] . " ON " . $this->pk . " = " . $headings['relation']['map_table_name'] . "." . $headings['relation']['map_relation_col_from'] . " JOIN " . $headings['relation']['table_name'] . " ON " . $headings['relation']['map_table_name'] . "." . $headings['relation']['map_relation_col_to'] . " = " . $headings['relation']['table_name'] . "." . $headings['relation']['relation_col'] . ") a1 group by " . $this->pk;
                    $recoders = $recoders->leftJoinSub($query, 'rms', function ($join) {
                        $join->on('rms.qry_id', '=', 'mst_queries.qry_id');
                    });
                    $col_name[] = 'rms.emp_names';
                }
            }

            // dd($col_name);
            if ($this->sortBy) {
                $recoders = $recoders->orderBy($this->table . "." . $this->sortBy, $this->orderBy);
            }

            $recoders = $recoders
                ->where($this->table . "." . 'deleted_at', NULL)
                ->select($col_name);
            // dd($recoders->get());
            // dd($recoders->toSql());


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
        // dd($recoders);
        return  $recoders;
    }
    public function render()
    {


        $recoders = $this->recoders();
        return view('livewire.chetak-grid', [
            'recoders' => $recoders,
        ]);
    }

    public function gridExport($ext)
    {
        $col_name_export = [];
        ini_set('max_execution_time', 1000);
        ini_set('memory_limit', '-1');
        if ($this->raw_query) {
            $export_type = 1;
        } else {
            $export_type = 1;
        }
        foreach ($this->headings as $key => $heading) {
            $column = $this->table . "." . $heading['field'];
            $column_export = $heading['label'];
            if (isset($heading['relation'])) {
                if (isset($heading['multiple']) && $heading['multiple'] == true) {
                    $column = $this->table . "." . $heading['field'];
                } else {

                    $column = 't' . $key . "." . $heading['relation']['display_col'] . " as " . $heading['field'];
                }
            }
            $col_name[] = $column;

            if (isset($heading['fixed_value'])) {
                $col_name_export[] = ['column' => $column_export, 'field_type' => $heading['field_type'], 'field' => $heading['field'], 'fixed_value' => $heading['fixed_value']];
            } else {
                $col_name_export[] = ['column' => $column_export, 'field_type' => $heading['field_type'], 'field' => $heading['field']];
            }
        }
        $recoders =  $this->recoders();
        return Excel::download(new GridExport($recoders, $col_name_export, $export_type), 'recoders.' . $ext);
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
                    $carbonDate = Carbon::parse($data->$col)->format('Y-m-d');
                    if (isset($heading['default'])) {
                        $this->store_data[$heading['field']] = $heading['default'];
                    } else {

                        $this->store_data[$heading['field']] = $carbonDate;
                    }
                } else {
                    if (isset($heading['multiple']) && $heading['multiple'] == true) {
                        $ids =  DB::table($heading['relation']['map_table_name'])
                            ->where($heading['relation']['map_relation_col_from'], $id)
                            ->pluck($heading['relation']['map_relation_col_to'])->toArray();
                        if (isset($heading['default'])) {
                            $this->store_data[$heading['field']] = $heading['default'];
                        } else {
                            $this->store_data[$heading['field']] = $ids;
                        }
                    } else {
                        if (isset($heading['default'])) {
                            $this->store_data[$heading['field']] = $heading['default'];
                        } else {
                            $this->store_data[$heading['field']] = $data->$col;
                        }
                    }
                }
            }
            $this->pk_value = $id;
            $this->is_edit = true;
            // $this->emit('childRefresh', $data->$col != 0 ? $data->$col : null);
        } else {
            $this->emit('get_grid_id', $id, $this->chetak_grid_name . "_" . $action);
        }
    }
    public function edit()
    {
        if ($this->row_selected && !$this->add_new) {
            if ($this->raw_query) {
                $data = collect(DB::select(DB::raw($this->raw_query)))->where($this->pk, $this->row_selected)->first();
            } else {
                $data = DB::table($this->table)->where($this->pk, $this->row_selected)->first();
            }
            foreach ($this->headings as $heading) {
                $col = $heading['field'];
                if ($heading['field_type'] == "date") {
                    if (isset($heading['default'])) {
                        $this->store_data[$heading['field']] = $heading['default'];
                    } else {
                        $this->store_data[$heading['field']] = $data->$col;
                    }
                } else {
                    if (isset($heading['multiple']) && $heading['multiple'] == true) {
                        $ids =  DB::table($heading['relation']['map_table_name'])
                            ->where($heading['relation']['map_relation_col_from'], $this->row_selected)
                            ->pluck($heading['relation']['map_relation_col_to'])->toArray();

                        $this->store_data[$heading['field']] = $ids;
                    } else {
                        if (isset($heading['default'])) {
                            $this->store_data[$heading['field']] = $heading['default'];
                        } else {
                            $this->store_data[$heading['field']] = $data->$col;
                        }
                    }
                }
            }
            $this->pk_value = $this->row_selected;
            $this->is_edit = true;
            Paginator::currentPageResolver(function () {
                return $this->current_page;
            });
        }
    }
    public function editWithContextMenu($id, $action)
    {
        $this->row_selected = $id;
        // dd($id);
        // $this->edit();
        $this->getPk($id, $action);
    }

    public function errowKeyPress($action, $orderBy)
    {

        if (!$this->is_edit && $this->grid_selected) {
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
    }



    public function editModeOff()
    {
        $this->pk_value = null;
        $this->is_edit = false;
        // $this->store_data = [];
        $this->add_new = null;
    }

    public function addNew()
    {
        if ($this->inline_edit) {
            $this->add_new = 1;
            $this->pk_value = null;
        }
    }
    public function addNewClick()
    {
        if ($this->inline_edit) {
            $this->add_new = 1;
            $this->pk_value = null;
        }
    }

    public function update()
    {
        // dd($this->store_data);
        $this->resetErrorBag();
        $validation_data = [];
        $validation_message = [];
        $validation = null;
        foreach ($this->headings as $heading) {
            if (isset($heading['validation'])) {
                $validation = null;
                foreach ($heading['validation'] as $key => $value) {
                    $validation .= $key . "|";
                    $validation_message['store_data.' . $heading['field'] . '.' . $key] = $value;
                }
                $validation_data['store_data.' . $heading['field']] = $validation;
            }
        }


        if (count($this->store_data) > 0) {
            if (count($validation_data) > 0)
                $this->validate($validation_data, $validation_message);
            $data = [];
            $multi_data = [];
            foreach ($this->headings as $heading) {
                $key = $heading['field'];
                $value = $this->store_data[$heading['field']] ?? null;
                if ($heading['field_type'] == 'image') {
                    $dd = DB::table($this->table)->where($this->pk, $this->pk_value)->where($key, $value)->first();
                    if ($dd) {
                        $data[$key] = $value;
                    } else {
                        $path = null;
                        if (isset($heading['file_path']) && strlen($heading['file_path']) > 0) {
                            $path = $heading['file_path'] . "/";
                        }
                        if ($value) {
                            $name =  $path . $value->getClientOriginalName();
                            $myimage = $value->storeAs('images', $name, 'local');
                            $data[$key] = $myimage;
                        } else {
                            $data[$key] = null;
                        }
                    }
                } elseif (isset($heading['multiple']) && $heading['multiple']) {
                    $multi_data[$key] = $this->store_data[$key] ?? null;
                } else {
                    $data[$key] = $this->store_data[$key] ?? null;
                }
            }

            if ($this->pk_value) {
                if ($this->raw_query) {
                    $this->emit('getUpdatedData', $data);
                } else {
                    $data['updated_at'] = now();
                    $data['updated_by'] = Auth::user()->id;
                    DB::table($this->table)->where($this->pk, $this->pk_value)->update($data);
                    foreach ($this->headings as $heading) {
                        if (isset($heading['multiple']) && $heading['multiple']) {
                            DB::table($heading['relation']['map_table_name'])
                                ->where($heading['relation']['map_relation_col_from'], $this->pk_value)
                                ->delete();
                            $new_ids = $multi_data[$heading['field']];
                            foreach ($new_ids as $id) {
                                DB::table($heading['relation']['map_table_name'])->insert([
                                    $heading['relation']['map_relation_col_from'] => $this->pk_value,
                                    $heading['relation']['map_relation_col_to'] => $id,
                                ]);
                            }
                        }
                    }
                }
            } else {
                if ($this->raw_query) {
                    $this->emit('getAddedData', $data);
                } else {

                    $data['updated_at'] = $data['created_at'] = now();
                    $data['created_by'] = Auth::user()->id;
                    $new_table_id =  DB::table($this->table)->insertGetId($data);
                    if ($new_table_id) {
                        foreach ($this->headings as $heading) {
                            if (isset($heading['multiple']) && $heading['multiple']) {
                                $new_ids = $multi_data[$heading['field']];
                                foreach ($new_ids as $id) {
                                    DB::table($heading['relation']['map_table_name'])->insert([
                                        $heading['relation']['map_relation_col_from'] => $new_table_id,
                                        $heading['relation']['map_relation_col_to'] => $id,
                                    ]);
                                }
                            }
                        }
                    }
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
