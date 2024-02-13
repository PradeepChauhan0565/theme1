<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use App\Models\url;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\SubCategory;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class SubCategoryComponent extends Component
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


    public $category;
    public $sb_id;
    public $categorytype_id;
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
        $this->sb_id = null;
        $this->category = null;
        $this->categorytype_id = null;
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
            'category' => 'required',
            'categorytype_id' => 'required',
            'name' => 'required',
        ], [
            'category.required' => 'Category is required.',
            'categorytype_id.required' => 'Category type is required.',
            'name.required' => 'Sub Category  is required.',
        ]);

        $slug = Str::slug($this->name, "-");
        $image_name = null;
        if ($this->banner) {
            $image_name = $this->banner->getClientOriginalName();
            $image = $this->banner->storeAs('public/subcategorybanners', $image_name);
        }
        SubCategory::create([
            'category_id' => $this->category,
            'categorytype_id' => $this->categorytype_id,
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
        $this->sb_id = $id;
        $sbc = SubCategory::find($id);

        $this->category = $sbc->category_id;
        $this->categorytype_id = $sbc->categorytype_id;
        $this->name = $sbc->name;
        $this->description = $sbc->description;
        $this->old_banner = $sbc->banner;
        $this->banner_title = $sbc->banner_title;
        $this->order_by = $sbc->order_by;
        $this->emit('childRefresh', $id);
    }

    public function update()
    {
        if (empty($this->old_banner)) {
            SubCategory::where('id', $this->sb_id)->update([
                'banner' => null,
            ]);
        }
        if ($this->banner) {
            $imagename = $this->banner->getClientOriginalName();
            $image = $this->banner->storeAs('public/subcategorybanners', $imagename);
        } else {
            $img = SubCategory::find($this->sb_id);
            if ($img) {
                $imagename = $img->banner;
            }
        }
        $slug = Str::slug($this->name, "-");

        SubCategory::find($this->sb_id)->update([
            'category_id' => $this->category,
            'categorytype_id' => $this->categorytype_id,
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
        $this->sb_id = $id;
        $sbc = SubCategory::find($id);
        $this->category = $sbc->category_id;
        $this->categorytype_id = $sbc->categorytype_id;
        $this->name = $sbc->name;
        $this->description = $sbc->description;
        $this->old_banner = $sbc->banner;
        $this->banner_title = $sbc->banner_title;
        $this->order_by = $sbc->order_by;
        $this->disabled = $disabled;
    }

    public function deleteConfirmation($id, $delete)
    {
        $this->sb_id = $id;
        $this->delete = $delete;
    }

    public function delete()
    {
        SubCategory::find($this->sb_id)->delete();
        $this->sb_id = null;
        $this->delete = null;
    }

    public function statusChange($id)
    {
        $d = 0;
        if ($this->status[$id] == 1) {
            $d = 1;
        }
        SubCategory::find($id)->update([
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
        $sbc = SubCategory::all();
        foreach ($sbc as $sbc) {
            $this->status[$sbc->id] = $sbc->status;
        }

        $table = new SubCategory();
        $columns = $table->getTableColumns('sub_categories');
        return view('livewire.sub-category-component', [
            'categories' => Category::all(),
            'catype' => CategoryType::where('category_id', $this->category)->get(),
            // 'subcategory' => SubCategory::orderBy('id', 'asc')
            'subcategory' => SubCategory::when($this->search, function ($q) use ($columns) {
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
