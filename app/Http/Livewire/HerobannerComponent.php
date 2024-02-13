<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use App\Models\url;
use App\Models\HeroBanner;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class HerobannerComponent extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $sort = "asc";
    public $sort_column = 'created_at';
    public $disabled;
    public $delete;


    public $banner_id;
    public $menu_id;
    public $hb_image;
    public $old_hb_image;
    public $image_path;
    public $image_title;
    public $url;
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
        $this->banner_id = null;
        $this->hb_image = null;
        $this->old_hb_image = null;
        $this->image_title = null;
        $this->url = null;
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
            'hb_image' => 'required',
            'image_title' => 'required',
            'url' => 'required',
        ], [
            'hb_image.required' => 'Banner image is required.',
            'image_title.required' => 'Image title is required.',
            'url.required' => 'Url is required.',
        ]);
        if ($this->hb_image) {
            $name = $this->hb_image->getClientOriginalName();
            $image_path = $this->hb_image->storeAs('public/herobanner', $name);
            // $name = $this->hb_image->store('public/herobanner');
        }
        HeroBanner::create([
            'hb_image' => $name,
            'image_path' => $image_path,
            'image_title' => $this->image_title,
            'url' => $this->url,
            'order_by' => $this->order_by ?: null,
            'created_by' => Auth::user()->id
        ]);

        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function edit($id)
    {
        $this->delete = null;
        $this->banner_id = $id;

        $banners = HeroBanner::find($id);
        $this->old_hb_image = $banners->hb_image;
        $this->image_path = $banners->image_path;
        $this->image_title = $banners->image_title;
        $this->url = $banners->url;
        $this->order_by = $banners->order_by;
        $this->emit('childRefresh', $id);
    }




    public function update()
    {
        if (empty($this->old_hb_image)) {
            HeroBanner::where('id', $this->banner_id)->update([
                'hb_image' => null,
            ]);
        }
        $name = null;
        $image_path = null;
        if ($this->hb_image) {
            $name = $this->hb_image->getClientOriginalName();
            $image_path = $this->hb_image->storeAs('public/herobanner/', $name);
        } else {
            $img = HeroBanner::find($this->banner_id);
            if ($img) {
                $name = $img->hb_image;
            }
        }


        HeroBanner::find($this->banner_id)->update([
            'hb_image' => $name,
            'image_path' => $image_path,
            'image_title' => $this->image_title,
            'url' => $this->url,
            'order_by' => $this->order_by ?: null,
            'updated_by' => Auth::user()->id
        ]);
        $this->dispatchBrowserEvent('livewireUpdated');
    }
    public function removepreview()
    {
        $this->hb_image = null;
    }
    public function removeold()
    {
        $this->old_hb_image = null;
    }
    public function view($disabled, $id)
    {
        $this->delete = null;
        $this->banner_id = $id;
        $url = HeroBanner::find($id);
        $this->old_hb_image = $url->hb_image;
        $this->image_title = $url->image_title;
        $this->url = $url->url;
        $this->order_by = $url->order_by;
        $this->disabled = $disabled;
    }

    public function deleteConfirmation($id, $delete)
    {
        $this->banner_id = $id;
        $this->delete = $delete;
    }

    public function delete()
    {
        HeroBanner::find($this->banner_id)->delete();
        $this->banner_id = null;
        $this->delete = null;
    }


    public function statusChange($id)
    {
        $d = 0;
        if ($this->status[$id] == 1) {
            $d = 1;
        }
        HeroBanner::find($id)->update([
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
        $banners = HeroBanner::all();
        foreach ($banners as $banners) {
            $this->status[$banners->id] = $banners->status;
        }
        $table = new HeroBanner();
        $columns = $table->getTableColumns('hero_banners');
        return view('livewire.herobanner-component', [
            // 'h_banners' => HeroBanner::orderBy('id', 'asc')
            'h_banners' => HeroBanner::when($this->search, function ($q) use ($columns) {
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
                //     $qs->where('image_title', 'LIKE', '%' . $this->search . '%')
                //         ->orWhere('order_by', 'LIKE', '%' . $this->search . '%');
                // })
                ->paginate(15),
        ]);
    }
}
