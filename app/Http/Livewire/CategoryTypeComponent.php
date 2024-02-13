<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use App\Models\url;
use App\Models\Category;
use App\Models\CategoryType;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class CategoryTypeComponent extends Component
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


    public $catype_id;
    public $category_id;
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
        $this->catype_id = null;
        $this->category_id = null;
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
            'category_id' => 'required',
            'name' => 'required',
        ], [
            'category_id.required' => 'Category is required.',
            'name.required' => 'Category type is required.',
        ]);

        $slug = Str::slug($this->name, "-");
        $image_name = null;
        if ($this->banner) {
            $image_name = $this->banner->getClientOriginalName();
            $image = $this->banner->storeAs('public/categorytypebanners', $image_name);
        }


        CategoryType::create([
            'category_id' => $this->category_id,
            'name' => $this->name,
            'description' => $this->description,
            'banner' => $image_name  ?? null,
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
        $this->catype_id = $id;
        $catype = CategoryType::find($id);

        $this->category_id = $catype->category_id;
        $this->name = $catype->name;
        $this->description = $catype->description;
        $this->old_banner = $catype->banner;
        $this->banner_title = $catype->banner_title;
        $this->order_by = $catype->order_by;
        $this->emit('childRefresh', $id);
    }

    public function update()
    {
        if (empty($this->old_banner)) {
            CategoryType::where('id', $this->catype_id)->update([
                'banner' => null,
            ]);
        }
        if ($this->banner) {
            $imagename = $this->banner->getClientOriginalName();
            $image = $this->banner->storeAs('public/categorytypebanners', $imagename);
        } else {
            $img = CategoryType::find($this->catype_id);
            if ($img) {
                $imagename = $img->banner;
            }
        }
        $slug = Str::slug($this->name, "-");

        CategoryType::find($this->catype_id)->update([
            'category_id' => $this->category_id,
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
        $this->catype_id = $id;
        $cats = CategoryType::find($id);
        $this->category_id = $cats->category_id;
        $this->name = $cats->name;
        $this->description = $cats->description;
        $this->old_banner = $cats->banner;
        $this->banner_title = $cats->banner_title;
        $this->order_by = $cats->order_by;
        $this->disabled = $disabled;
    }

    public function deleteConfirmation($id, $delete)
    {
        $this->catype_id = $id;
        $this->delete = $delete;
    }

    public function delete()
    {
        CategoryType::find($this->catype_id)->delete();
        $this->catype_id = null;
        $this->delete = null;
    }

    public function statusChange($id)
    {
        $d = 0;
        if ($this->status[$id] == 1) {
            $d = 1;
        }
        CategoryType::find($id)->update([
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
        $ctypes = CategoryType::all();
        foreach ($ctypes as $ctypes) {
            $this->status[$ctypes->id] = $ctypes->status;
        }

        $table = new CategoryType();
        $columns = $table->getTableColumns('category_types');
        return view('livewire.category-type-component', [
            'categories' => Category::all(),
            // 'categorytypes' => CategoryType::orderBy('id', 'asc')
            'categorytypes' => CategoryType::when($this->search, function ($q) use ($columns) {
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
                ->paginate(15),
        ]);
    }
}
