<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use App\Models\DiadondQuality;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class DiamondQualityComponent extends Component
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


    public $sz_id;
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
        $this->sz_id = null;
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

        DiadondQuality::create([
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
        $this->sz_id = $id;
        $datas = DiadondQuality::find($id);
        $this->code = $datas->code;
        $this->description = $datas->description;
        $this->order_by = $datas->order_by;
        $this->emit('childRefresh', $id);
    }

    public function update()
    {

        DiadondQuality::find($this->sz_id)->update([
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
        $this->sz_id = $id;
        $datas = DiadondQuality::find($id);
        $this->code = $datas->code;
        $this->description = $datas->description;
        $this->order_by = $datas->order_by;
        $this->disabled = $disabled;
    }

    public function deleteConfirmation($id, $delete)
    {
        $this->sz_id = $id;
        $this->delete = $delete;
    }

    public function delete()
    {
        DiadondQuality::find($this->sz_id)->delete();
        $this->sz_id = null;
        $this->delete = null;
    }

    public function statusChange($id)
    {
        $d = 0;
        if ($this->status[$id] == 1) {
            $d = 1;
        }
        DiadondQuality::find($id)->update([
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
        $datas = DiadondQuality::all();
        foreach ($datas as $datas) {
            $this->status[$datas->id] = $datas->status;
        }

        $table = new DiadondQuality();
        $columns = $table->getTableColumns('diadond_qualities');
        return view('livewire.diamond-quality-component', [
            'diadond_qualities' => DiadondQuality::when($this->search, function ($q) use ($columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', $this->search . '%');
                }
            })->orderBy($this->sort_column, $this->sort)
                // ->orWhereHas('company', function ($q) {
                //     $q->where('company_code', 'LIKE', '%' . $this->search . '%');
                // })
                // ->orWhereHas('department', function ($q) {
                //     $q->where('department_code', 'LIKE', '%' . $this->search . '%');
                // })
                // ->orderBy($this->sort_column, $this->sort)
                // ->when($this->search, function ($qs) {
                //     $qs->where('name', 'LIKE', '%' . $this->search . '%')
                //         ->orWhere('order_by', 'LIKE', '%' . $this->search . '%')
                //         ->orWhere('category_id', 'LIKE', '%' . $this->search . '%');
                // })
                ->paginate(10),
        ]);
    }
}
