<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use App\Models\url;
use App\Models\ShopByCategory;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ShopByCategoryComponent extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $sort = "asc";
    public $sort_column = 'created_at';
    public $disabled;
    public $delete;


    public $sbc_id;
    public $menu_id;
    public $sbc_image;
    public $old_sbc_image;
    public $image_title;
    public $button_name;
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
        $this->sbc_id = null;
        $this->sbc_image = null;
        $this->old_sbc_image = null;
        $this->image_title = null;
        $this->button_name = null;
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
            'sbc_image' => 'required',
            'image_title' => 'required',
            'button_name' => 'required',
            'url' => 'required',
        ], [
            'sbc_image.required' => 'Image is required.',
            'image_title.required' => 'Image title is required.',
            'button_name.required' => 'Button name is required.',
            'url.required' => 'Url is required.',
        ]);
        if ($this->sbc_image) {
            $name = $this->sbc_image->getClientOriginalName();
            $image = $this->sbc_image->storeAs('public/sbcimages', $name);
        }
        ShopByCategory::create([
            'sbc_image' => $name,
            'image_title' => $this->image_title,
            'button_name' => $this->button_name,
            'url' => $this->url,
            'order_by' => $this->order_by ?: null,
            'created_by' => Auth::user()->id
        ]);

        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function edit($id)
    {
        $this->delete = null;
        $this->sbc_id = $id;

        $sbc = ShopByCategory::find($id);
        $this->old_sbc_image = $sbc->sbc_image;
        $this->image_title = $sbc->image_title;
        $this->button_name = $sbc->button_name;
        $this->url = $sbc->url;
        $this->order_by = $sbc->order_by;
        $this->emit('childRefresh', $id);
    }

    public function update()
    {
        $name = null;

        if ($this->sbc_image) {
            $name = $this->sbc_image->getClientOriginalName();
            $image = $this->sbc_image->storeAs('public/sbcimages', $name);
        } else {
            $img = ShopByCategory::find($this->sbc_id);
            if ($img) {
                $name = $img->sbc_image;
            }
        }

        ShopByCategory::find($this->sbc_id)->update([
            'sbc_image' => $name,
            'button_name' => $this->button_name,
            'url' => $this->url,
            'order_by' => $this->order_by ?: null,
            'updated_by' => Auth::user()->id
        ]);
        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function view($disabled, $id)
    {
        $this->delete = null;
        $this->sbc_id = $id;
        $url = ShopByCategory::find($id);
        $this->old_sbc_image = $url->sbc_image;
        $this->url = $url->url;
        $this->button_name = $url->button_name;
        $this->order_by = $url->order_by;
        $this->disabled = $disabled;
    }

    public function deleteConfirmation($id, $delete)
    {
        $this->sbc_id = $id;
        $this->delete = $delete;
    }

    public function delete()
    {
        ShopByCategory::find($this->sbc_id)->delete();
        $this->sbc_id = null;
        $this->delete = null;
    }

    public function statusChange($id)
    {
        $d = 0;
        if ($this->status[$id] == 1) {
            $d = 1;
        }
        ShopByCategory::find($id)->update([
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
        $shops = ShopByCategory::all();
        foreach ($shops as $shops) {
            $this->status[$shops->id] = $shops->status;
        }
        $table = new ShopByCategory();
        $columns = $table->getTableColumns('shop_by_categories');
        // $columns = $table->getTableColumns('urls');
        return view('livewire.shop-by-category-component', [
            // 'sbc_images' => ShopByCategory::orderBy('id', 'asc')
            'sbc_images' => ShopByCategory::when($this->search, function ($q) use ($columns) {
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
                //         ->orWhere('order_by', 'LIKE', '%' . $this->search . '%')
                //         ->orWhere('button_name', 'LIKE', '%' . $this->search . '%');
                // })->orderBy($this->sort_column, $this->sort)
                ->paginate(15),
        ]);
    }
}
