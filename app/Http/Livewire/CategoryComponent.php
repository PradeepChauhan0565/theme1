<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use App\Models\url;
use App\Models\Category;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class CategoryComponent extends Component
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


    public $cat_id;
    public $name;
    public $description;
    public $banner;
    public $old_banner;
    public $banner_title;
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
        $this->cat_id = null;
        $this->name = null;
        $this->description = null;
        $this->banner = null;
        $this->old_banner = null;
        $this->banner_title = null;
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
            'name' => 'required',
        ], [
            'name.required' => 'Category name is required.',
        ]);

        $slug = Str::slug($this->name, "-");
        if ($this->banner) {
            $image_name = 0;
            $image_name = $this->banner->getClientOriginalName();
            $image = $this->banner->storeAs('public/categorybanners', $image_name);
        }
        Category::create([
            'name' => $this->name,
            'description' => $this->description,
            'banner' => $image_name ?? null,
            'slug' => $slug,
            'banner_title' => $this->banner_title,
            'order_by' => $this->order_by ?: null,
            'created_by' => Auth::user()->id
        ]);

        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function edit($id)
    {
        $this->delete = null;
        $this->cat_id = $id;

        $cat = Category::find($id);
        $this->name = $cat->name;
        $this->description = $cat->description;
        $this->old_banner = $cat->banner;
        $this->banner_title = $cat->banner_title;
        $this->order_by = $cat->order_by;
        $this->emit('childRefresh', $id);
    }

    public function update()
    {

        // $this->banner = null;
        if (empty($this->old_banner)) {
            Category::where('id', $this->cat_id)->update([
                'banner' => null,
            ]);
        }

        if ($this->banner) {
            $imagename = $this->banner->getClientOriginalName();
            $image = $this->banner->storeAs('public/categorybanners', $imagename);
        } else {
            $img = Category::find($this->cat_id);
            if ($img) {
                $imagename = $img->banner;
            }
        }
        $slug = Str::slug($this->name, "-");

        Category::find($this->cat_id)->update([
            'name' => $this->name,
            'description' => $this->description,
            'banner' => $imagename,
            'banner_title' => $this->banner_title,
            'slug' => $slug,
            'order_by' => $this->order_by ?: null,
            'updated_by' => Auth::user()->id
        ]);
        $this->dispatchBrowserEvent('livewireUpdated');
    }
    public function removepreview()
    {
        $this->banner = null;
    }
    public function removeold()
    {
        $this->old_banner = null;
    }
    public function view($disabled, $id)
    {
        $this->delete = null;
        $this->cat_id = $id;
        $cats = Category::find($id);
        $this->name = $cats->name;
        $this->description = $cats->description;
        $this->old_banner = $cats->banner;
        $this->banner_title = $cats->banner_title;
        $this->order_by = $cats->order_by;
        $this->disabled = $disabled;
    }

    public function deleteConfirmation($id, $delete)
    {
        $this->cat_id = $id;
        $this->delete = $delete;
    }

    public function delete()
    {
        Category::find($this->cat_id)->delete();
        $this->cat_id = null;
        $this->delete = null;
    }

    public function statusChange($id)
    {
        $d = 0;
        if ($this->status[$id] == 1) {
            $d = 1;
        }
        Category::find($id)->update([
            'status' => $d,
        ]);
    }

    // public function removeImage($old_banner)
    // {
    //     Category::find($this->old_banner)->delete();
    // }

    public function companyChange()
    {
        // $companies = Company::where('comapny_code','Like',)
    }

    public function render()
    {

        $this->status = [];
        $categories = Category::all();
        foreach ($categories as $categories) {
            $this->status[$categories->id] = $categories->status;
        }
        $table = new Category();
        $columns = $table->getTableColumns('categories');
        // $columns = $table->getTableColumns('urls');
        return view('livewire.category-component', [
            // 'categories' => Category::orderBy('id', 'asc')
            'categories' => Category::when($this->search, function ($q) use ($columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', $this->search . '%');
                }
            })->orderBy($this->sort_column, $this->sort)

                ->paginate(15),
        ]);
    }
}
