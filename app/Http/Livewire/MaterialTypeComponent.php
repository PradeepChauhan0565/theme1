<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use App\Models\MaterialType;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class MaterialTypeComponent extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $sort = "asc";
    public $sort_column = 'created_at';
    public $disabled;
    public $delete;
    public $menu_id;


    public $mt_id;
    public $code;
    public $description;
    public $order_by;
    public $status = [];
    public $component_name;




    protected $listeners = [
        'getTableId'
    ];

    public function getTableId($table_id, $column_code)
    {
        $this->$column_code = $table_id;
    }

    public function sort($column)
    {
        $this->sort_column = $column;
        $this->sort == 'asc' ? $this->sort = 'desc' : $this->sort = 'asc';
    }




    public function add()
    {
        $this->mt_id = null;
        $this->code = null;
        $this->description = null;
        $this->order_by = null;
        $this->disabled = null;
    }

    public function search()
    {
        dd('test');
    }
    public function store()
    {
        $this->validate([
            'code' => 'required',
        ], [
            'code.required' => 'Code is required.',
        ]);

        MaterialType::create([
            'code' => $this->code,
            'description' => $this->description,
            'order_by' => $this->order_by ?: null,
            'created_by' => Auth::user()->id
        ]);

        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function edit($id)
    {
        $this->delete = null;
        $this->mt_id = $id;
        $datas = MaterialType::find($id);
        $this->code = $datas->code;
        $this->description = $datas->description;
        $this->order_by = $datas->order_by;
        $this->emit('childRefresh', $id);
    }

    public function update()
    {

        MaterialType::find($this->mt_id)->update([
            'code' => $this->code,
            'description' => $this->description,
            'order_by' => $this->order_by ?: null,
            'updated_by' => Auth::user()->id
        ]);
        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function view($disabled, $id)
    {
        $this->delete = null;
        $this->mt_id = $id;
        $datas = MaterialType::find($id);
        $this->code = $datas->code;
        $this->description = $datas->description;
        $this->order_by = $datas->order_by;
        $this->disabled = $disabled;
    }

    public function deleteConfirmation($id, $delete)
    {
        $this->mt_id = $id;
        $this->delete = $delete;
    }

    public function delete()
    {
        MaterialType::find($this->mt_id)->delete();
        $this->mt_id = null;
        $this->delete = null;
    }

    public function statusChange($id)
    {
        $d = 0;
        if ($this->status[$id] == 1) {
            $d = 1;
        }
        MaterialType::find($id)->update([
            'status' => $d,
        ]);
    }
    public function companyChange()
    {
        // $companies = Company::where('comapny_code','Like',)
    }

    public function render()
    {

        $this->status = [];
        $datas = MaterialType::all();
        foreach ($datas as $datas) {
            $this->status[$datas->id] = $datas->status;
        }

        $table = new MaterialType();
        $columns = $table->getTableColumns('material_types');

        return view('livewire.material-type-component', [
            'materialTypes' => MaterialType::when($this->search, function ($q) use ($columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', $this->search . '%');
                }
            })->orderBy($this->sort_column, $this->sort)

                ->paginate(10),
        ]);
    }
}
