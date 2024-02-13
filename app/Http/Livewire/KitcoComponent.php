<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use App\Models\Metal_type;
use App\Models\Kitco;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class KitcoComponent extends Component
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
    public $metal_type_id;
    public $gram;
    public $rate;
    public $kt10;
    public $kt14;
    public $kt18;
    public $kt22;
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
        $this->metal_type_id = null;
        $this->gram = null;
        $this->rate = null;
        $this->kt10 = null;
        $this->kt14 = null;
        $this->kt18 = null;
        $this->kt22 = null;
        $this->disabled = null;
    }

    public function search()
    {
        dd('test');
    }
    public function store()
    {
        $this->validate([
            'metal_type_id' => 'required',
            'gram' => 'required',
            'rate' => 'required',
        ], [
            'metal_type_id.required' => 'Metal is required.',
            'gram.required' => 'Gram is required.',
            'rate.required' => 'Rate is required.',
        ]);

        Kitco::create([
            'metal_type_id' => $this->metal_type_id,
            'gram' => $this->gram,
            'rate' => $this->rate,
            'kt10' => $this->kt10,
            'kt14' => $this->kt14,
            'kt18' => $this->kt18,
            'kt22' => $this->kt22,
            'created_by' => Auth::user()->id
        ]);

        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function edit($id)
    {
        $this->delete = null;
        $this->mt_id = $id;
        $datas = Kitco::find($id);
        $this->metal_type_id = $datas->metal_type_id;
        $this->gram = $datas->gram;
        $this->rate = $datas->rate;
        $this->kt10 = $datas->kt10;
        $this->kt14 = $datas->kt14;
        $this->kt18 = $datas->kt18;
        $this->kt22 = $datas->kt22;
        $this->emit('childRefresh', $id);
    }

    public function update()
    {

        Kitco::find($this->mt_id)->update([
            'metal_type_id' => $this->metal_type_id,
            'gram' => $this->gram,
            'rate' => $this->rate,
            'kt10' => $this->kt10,
            'kt14' => $this->kt14,
            'kt18' => $this->kt18,
            'kt22' => $this->kt22,

            'updated_by' => Auth::user()->id
        ]);
        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function view($disabled, $id)
    {
        $this->delete = null;
        $this->mt_id = $id;
        $datas = Kitco::find($id);
        $this->metal_type_id = $datas->metal_type_id;
        $this->gram = $datas->gram;
        $this->rate = $datas->rate;
        $this->kt10 = $datas->kt10;
        $this->kt14 = $datas->kt14;
        $this->kt18 = $datas->kt18;
        $this->kt22 = $datas->kt22;
        $this->disabled = $disabled;
    }

    public function deleteConfirmation($id, $delete)
    {
        $this->mt_id = $id;
        $this->delete = $delete;
    }

    public function delete()
    {
        Kitco::find($this->mt_id)->delete();
        $this->mt_id = null;
        $this->delete = null;
    }


    public function companyChange()
    {
        // $companies = Company::where('comapny_code','Like',)
    }

    public function render()
    {



        $table = new Kitco();
        $columns = $table->getTableColumns('metal_types');
        return view('livewire.kitco-component', [
            'metal_types' => Metal_type::all(),
            'kitcos' => Kitco::orderBy('id', 'asc')
                ->when($this->search, function ($qs) {
                    $qs->where('metal_type_id', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('gram', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('rate', 'LIKE', '%' . $this->search . '%');
                })
                ->paginate(10),
        ]);
    }
}
