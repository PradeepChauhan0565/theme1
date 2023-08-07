<?php

namespace App\Http\Livewire;

use Livewire\Component;

class GridParent extends Component
{

    public  $headings = [];
    public  $table = null;
    public  $where_con = null;
    public $table_id = null;
    public $action = null;
    public  $raw_query = null;
    // public $dropdown_menu = [['action' => 'View', 'icon' => 'fa fa-pen-square fa-lg']];
    public $dropdown_menu = [];
    protected $listeners = ['get_grid_id', 'getUpdatedData', 'getAddedData', 'getDeletedData'];
    public $modal = false;
    public $jewellery_code;
    public $inner_diameter;
    public $prodsize_id;
    public $ctr = 1;
    public $grid_name = 'first_grid';


    public function get_grid_id($id, $action)
    {
        $this->table_id = $id;
        $this->action = $action;
        $this->ctr .= $action;
        // dd($id, $action);
    }

    public function getUpdatedData($data)
    {
        dd($data);
    }
    public function getAddedData($data)
    {
        dd($data);
    }
    public function getDeletedData($data)
    {
        dd($data);
    }

    public function show()
    {
        $this->modal = true;
    }



    public function mount()
    {
        $this->headings = [

            [
                'id' => 1,
                'label' => 'Date',
                'field' => 'qry_date',
                'field_type' => 'date',
                'filter' => true,
                'editable' => true,
                'visibility' => true,
                'validation' => [
                    'required' => 'required',
                    'date' => 'date format',
                ],
            ],
            [
                'id' => 2,
                'label' => 'Module',
                'field' => 'qry_module_id',
                'field_type' => 'text',
                'filter' => true,
                'editable' => false,
                'default_value' => 10,
                'relation' => [
                    'table_name' => 'mst_parameter_lists',
                    'relation_col' => 'paralist_id',
                    'display_col' => 'paralist_desc',
                    'display_col1' => ['paralist_code', 'Module Code'],
                    'double' => true,
                ],

            ],
            [
                'id' => 3,
                'label' => 'Sub Module',
                'field' => 'qry_modulesub_id',
                'field_type' => 'checkbox',
                'filter' => true,
                'editable' => true,
                'relation' => [
                    'table_name' => 'mst_parameter_lists',
                    'relation_col' => 'paralist_id',
                    'display_col' => 'paralist_desc',
                    'display_col1' => ['paralist_code', 'Module Code'],
                ],
                'validation' => [
                    'required' => 'required',
                ],
            ],
            [
                'id' => 4,
                'label' => 'Particular',
                'field' => 'qry_particular',
                'field_type' => 'text',
                'filter' => true,
                'editable' => true,
                'validation' => [
                    'required' => 'required',
                ],
            ],
            [
                'id' => 5,
                'label' => 'Status',
                'field' => 'qry_status_id',
                'field_type' => 'bit',
                'filter' => true,
                'editable' => true,
                'fixed_value' => [1 => 'Pending', 2 => 'Testing', 3 => 'Done'],
                'validation' => [
                    'required' => 'required',
                ],
            ],
            [
                'id' => 6,
                'label' => 'Emp Names',
                'field' => 'emp_names',
                'field_type' => 'text',
                'filter' => true,
                'editable' => true,
                'multiple' => true,
                'relation' => [
                    'map_table_name' => 'emp_map_qries',
                    'map_relation_col_from' => 'empqry_qry_id',
                    'map_relation_col_to' => 'empqry_emp_id',
                    'table_name' => 'mst_employees',
                    'relation_col' => 'emp_id',
                    'display_col' => 'emp_name',
                ],
                'validation' => [
                    'required' => 'required',
                ],
            ],
            [
                'id' => 7,
                'label' => 'Remark',
                'field' => 'qry_remark',
                'field_type' => 'text',
                'filter' => true,
                'editable' => true,
                'validation' => [
                    'required' => 'Required',
                ],
            ],
            // [
            //     'id' => 8,
            //     'label' => 'Image',
            //     'field' => 'qry_image',
            //     'field_type' => 'image',
            //     'filter' => false,
            //     'editable' => true,
            //     'file_path' => 'diamond',
            // ],
            [
                'id' => 9,
                'label' => 'Count',
                'field' => 'qry_count',
                'field_type' => 'number',
                'filter' => true,
                'editable' => true,
                'number_format' => [true, 2]
            ],
        ];
        // $this->headings = [];
        $this->table = 'mst_queries';
        $this->raw_query = "exec spc_sales_trans_pricing_access
        @p_trans_id = " . 4 . ",
        @p_transitem_id = " . 161 . ",
        @p_transitemrm_id = " . 2391 . ",
        @p_accseq_id = " . 7 . ",
        @p_acctable_id = " . 1 . ",
        @p_prccondrec_id = " . 1 . ",
        @user_id  = " . 83 . " ";
        $this->raw_query = null;
        // $this->where_con = 'qry_count=7';
    }

    public function openNewTab()
    {

        $this->dispatchBrowserEvent('openNewTab', ['message' => 1]);
    }
    public function render()
    {
        return view('livewire.grid-parent');
    }
}
