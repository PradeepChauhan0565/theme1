<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use App\Models\url;
use App\Models\SocialMedia;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class SocialMediaComponent extends Component
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


    public $sm_id;
    public $name;
    public $icon;
    public $link;
    public $status = [];
    public $order_by;
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
        $this->sm_id = null;
        $this->name = null;
        $this->icon = null;
        $this->link = null;
        $this->order_by = null;
        $this->disabled = null;
    }

    public function search()
    {
        dd('test');
    }

    public function store()
    {

        SocialMedia::create([
            'name' => $this->name,
            'icon' => $this->icon,
            'link' => $this->link,
            'order_by' => $this->order_by,
            'created_by' => Auth::user()->id
        ]);

        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function edit($id)
    {
        $this->delete = null;
        $this->sm_id = $id;

        $social = SocialMedia::find($id);
        $this->name = $social->name;
        $this->icon = $social->icon;
        $this->link = $social->link;
        $this->order_by = $social->order_by;
        $this->emit('childRefresh', $id);
    }




    public function update()
    {
        SocialMedia::find($this->sm_id)->update([
            'name' => $this->name,
            'icon' => $this->icon,
            'link' => $this->link,
            'order_by' => $this->order_by,
            'updated_by' => Auth::user()->id
        ]);
        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function view($disabled, $id)
    {
        $this->delete = null;
        $this->sm_id = $id;
        $socials = SocialMedia::find($id);
        $this->name = $socials->name;
        $this->icon = $socials->icon;
        $this->link = $socials->link;
        $this->order_by = $socials->order_by;
        $this->disabled = $disabled;
    }

    public function deleteConfirmation($id, $delete)
    {
        $this->sm_id = $id;
        $this->delete = $delete;
    }

    public function delete()
    {
        SocialMedia::find($this->sm_id)->delete();
        $this->sm_id = null;
        $this->delete = null;
    }

    public function statusChange($id)
    {
        $d = 0;
        if ($this->status[$id] == 1) {
            $d = 1;
        }
        SocialMedia::find($id)->update([
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
        $social = SocialMedia::all();
        foreach ($social as $social) {
            $this->status[$social->id] = $social->status;
        }


        $table = new SocialMedia();
        $columns = $table->getTableColumns('social_media');
        return view('livewire.social-media-component', [
            // 'socials' => SocialMedia::orderBy('id', 'asc')
            'socials' => SocialMedia::when($this->search, function ($q) use ($columns) {
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
                //         ->orWhere('order_by', 'LIKE', '%' . $this->search . '%');
                // })
                ->paginate(15),
        ]);
    }
}
