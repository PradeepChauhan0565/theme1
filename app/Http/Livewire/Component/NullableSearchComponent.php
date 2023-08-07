<?php

namespace App\Http\Livewire\Component;

use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class NullableSearchComponent extends Component
{
    public $query;
    public $contacts;
    public $highlightIndex;
    public $t_id;
    public $table_name;
    public $table_id;
    public $table_search_column;
    public $search_table_id;
    public $name;
    public $table_default_value;
    public $where_condition;
    protected $listeners = [
        'childRefresh'
    ];

    public function childRefresh($id)
    {
        $this->t_id = $id;
        $this->setData($id);
    }

    public function mount($table_name, $table_search_column, $name, $table_default_value = null,$where_condition=null,$search_table_id=null)
    {
      
        $this->table_name = $table_name;
        $this->table_search_column = $table_search_column;
        $this->name = $name;
        $this->table_default_value = $table_default_value;
        $this->where_condition = $where_condition;
        $this->search_table_id = $search_table_id;
        $this->reset1();
    }

    public function reset1()
    {
        $this->contacts = [];
        $this->highlightIndex = 0;
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->contacts) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->contacts) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function setData($id)
    {
        $table_id = $this->search_table_id ? $this->search_table_id : 'id';
        $table_search_column = $this->table_search_column;
        $get_row = DB::table($this->table_name)->where($table_id, $id)->first();
        if($get_row){
            
            $this->query = $get_row->$table_search_column;
            $this->table_id = $get_row->$table_id;
            $this->emit('getTableId', $this->table_id, $this->name);
            $this->reset1();
        }
        
    }

    public function queryClick()
    {
        
        if(strlen($this->query)==0)
        {
            $this->contacts = json_decode(json_encode(DB::table($this->table_name)
            ->when($this->where_condition,function($q){
                $q->whereRaw($this->where_condition);
            })
            ->orderBy($this->table_search_column,'asc')
            ->take(15)
            ->get()), true); 
           
        }
         
    }

    public function updatedQuery()
    {
        $this->contacts = json_decode(json_encode(DB::table($this->table_name)
            ->where($this->table_search_column, 'like', '%' . $this->query . '%')
            ->when($this->where_condition,function($q){
                $q->whereRaw($this->where_condition);
            })
            ->orderBy($this->table_search_column,'asc')
            ->take(15)
            ->get()), true);
            if(count($this->contacts)==0)
            {
                $this->table_id = $this->query; 
                $this->emit('getTableId', $this->table_id, $this->name);  
            }
    }
    public function render()
    {
        return view('livewire.component.nullable-search-component');
    }
}
