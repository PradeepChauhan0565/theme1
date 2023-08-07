<?php

namespace App\Http\Livewire\Component;

use App\Models\Concept;
use App\Models\MstMaterial;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchComponentGrid extends Component
{
    public $query;
    public $results = [];
    public $highlightIndex;

    public $table_name;
    public $search_column_name;
    public $table_id;
    public $search_id;
    public $no_of_record;
    public $name;
    public $hideNoResult = null;
    public $default_value = null;
    public $where_column = null;
    public $where_value = null;
    public $search_class;
    public $where_con;


    protected $listeners = ['reRenderChild', 'childRefresh'];
    public function reRenderChild($default_value)
    {
        if ($default_value) {
            $this->resultClick($default_value);
        } else {
            $this->query = null;
        }
    }

    public function childRefresh($id)
    {
        $this->resultClick($id);
    }
   

    public function mount($table_name, $search_column_name, $table_id,  $no_of_record, $name, $default_value = null, $where_column = null, $where_value = null, $search_class = null, $where_con = null)
    {
        $this->table_name = $table_name;
        $this->search_column_name = $search_column_name;
        $this->table_id = $table_id;
        $this->no_of_record = $no_of_record;
        $this->name = $name;
        $this->default_value = $default_value;
        $this->where_column = $where_column;
        $this->where_value = $where_value;
        $this->search_class = $search_class;
        // dd($where_con);
        $this->where_con = $where_con;

        if ($default_value) {
            $this->resultClick($default_value);
        } else {
            $this->query = null;
        }
    }

    

    public function queryClick()
    {
        // dd($this->where_value);
        if ($this->query) {
        } else {
            $this->hideNoResult = null;
            $this->results = DB::table($this->table_name)
                ->when($this->where_value, function ($q) {
                    $q->where($this->where_column, $this->where_value);
                })
                ->when($this->where_con, function ($q) {
                    $q->whereRaw($this->where_con);
                })
                ->orderBy($this->search_column_name, 'asc')
                ->take($this->no_of_record)
                ->get();
        }
    }

    public function updatedQuery()
    {

        $this->hideNoResult = null;
        if (strlen($this->query) == 0) {
            $this->emit('getTableId', null, $this->name);
        }
        if (strlen($this->query) >= 1) {
            $this->results = DB::table($this->table_name)->where('deleted_at', NULL)
                ->where($this->search_column_name, 'like', '%' . $this->query . '%')
                ->when($this->where_value, function ($q) {
                    $q->where($this->where_column, $this->where_value);
                })
                ->when($this->where_con, function ($q) {
                    $q->whereRaw($this->where_con);
                })
                ->take($this->no_of_record)
                ->get();
        }
    }
    public function resultClick($id)
    {
        // dd($id);
        $table_id = $this->table_id;
        $search_column_name = $this->search_column_name;
        $d = DB::table($this->table_name)->where($this->table_id, $id)->first();

        if ($d) {
            $this->query = $d->$search_column_name;
            $this->search_id = $d->$table_id;
            $this->reset1();
            $this->emit('getTableId', $this->search_id, $this->name);
        }
    }


    public function reset1()
    {
        $this->hideNoResult = 1;
        $this->results = [];
        $this->highlightIndex = 0;
    }

    public function incrementHighlight()
    {
        // if ($this->highlightIndex === count($this->results) - 1) {
        //     $this->highlightIndex = 0;
        //     return;
        // }
        // $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        // if ($this->highlightIndex === 0) {
        //     $this->highlightIndex = count($this->results) - 1;
        //     return;
        // }
        // $this->highlightIndex--;
    }

    public function selectContact()
    {
        // $contact = $this->results[$this->highlightIndex] ?? null;
        // if ($contact) {
        //     $this->redirect(route('show-contact', $contact['id']));
        // }
    }


    public function render()
    {
        return view('livewire.component.search-component-grid');
    }
}
