<?php

namespace App\Http\Livewire\Component;

use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchComponent extends Component
{
    public $query;
    public $contacts;
    public $highlightIndex;
    public $t_id;
    public $table_name;
    public $table_id;
    public $table_search_column;
    public $table_search_column1;
    public $name;
    public $table_default_value;
    protected $listeners = [
        'childRefresh'
    ];

    public function childRefresh($id)
    {
        $this->t_id = $id;
        $this->setData($id);
    }

    public function mount($table_name, $table_search_column, $name, $table_default_value = null, $table_search_column1 = null)
    {
        $this->table_name = $table_name;
        $this->table_search_column = $table_search_column;
        $this->table_search_column1 = $table_search_column1;
        $this->name = $name;
        $this->table_default_value = $table_default_value;

        $this->reset1();
    }

    public function reset1()
    {
        // $this->query = '';
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
        $table_search_column = $this->table_search_column;
        $get_row = DB::table($this->table_name)->where('id', $id)->first();
        if ($get_row) {
            $this->query = $get_row->$table_search_column;
            $this->table_id = $get_row->id;
            $this->emit('getTableId', $this->table_id, $this->name);
            $this->reset1();
        }
    }

    public function queryClick()
    {
        if (strlen($this->query) == 0) {
            $this->contacts = json_decode(json_encode(DB::table($this->table_name)
                ->orderBy($this->table_search_column, 'asc')
                ->take(15)
                ->get()), true);
        }
    }

    public function updatedQuery()
    {
        $this->contacts = json_decode(json_encode(DB::table($this->table_name)
            ->where($this->table_search_column, 'like', '%' . $this->query . '%')
            ->when($this->table_search_column1, function ($q) {
                $q->orWhere($this->table_search_column1, 'like', '%' . $this->query . '%');
            })
            ->orderBy($this->table_search_column, 'asc')
            ->take(15)
            ->get()), true);
    }
    public function render()
    {
        return view('livewire.component.search-component');
    }
}
