<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use App\Models\url;
use App\Models\FeaturedCollections;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class FeaturedCollectionsComponent extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $sort = "asc";
    public $sort_column = 'created_at';
    public $disabled;
    public $delete;


    public $fc_id;
    public $menu_id;
    public $fc_image;
    public $image_title;
    public $oldfc_image;
    public $url;
    public $order_by;
    public $status = [];
    public $component_name;


    protected $rules = [
        'fc_image' => 'image|mimes:png,jpg,gif,webp,jpeg',
    ];

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
        $this->fc_id = null;
        $this->fc_image = null;
        $this->image_title = null;
        $this->oldfc_image = null;
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
            'fc_image' => 'required',
            'image_title' => 'required',
            'url' => 'required',
        ], [
            'fc_image.required' => 'Image is required.',
            'image_title.required' => 'Image title is required.',
            'url.required' => 'Url is required.',
        ]);
        if ($this->fc_image) {
            $name = $this->fc_image->getClientOriginalName();
            $image = $this->fc_image->storeAs('public/collections', $name);
        }
        FeaturedCollections::create([
            'fc_image' => $name,
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
        $this->fc_id = $id;

        $wi = FeaturedCollections::find($id);
        $this->oldfc_image = $wi->fc_image;
        $this->image_title = $wi->image_title;
        $this->url = $wi->url;
        $this->order_by = $wi->order_by;
        $this->emit('childRefresh', $id);
    }

    public function update()
    {
        $name = null;

        if ($this->fc_image) {
            $name = $this->fc_image->getClientOriginalName();
            $image = $this->fc_image->storeAs('public/collections', $name);
        } else {
            $img = FeaturedCollections::find($this->fc_id);
            if ($img) {
                $name = $img->fc_image;
            }
        }

        FeaturedCollections::find($this->fc_id)->update([
            'fc_image' => $name,
            'image_title' => $this->image_title,
            'url' => $this->url,
            'order_by' => $this->order_by ?: null,
            'updated_by' => Auth::user()->id
        ]);
        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function view($disabled, $id)
    {
        $this->delete = null;
        $this->fc_id = $id;
        $url = FeaturedCollections::find($id);
        $this->oldfc_image = $url->fc_image;
        $this->url = $url->url;
        $this->order_by = $url->order_by;
        $this->disabled = $disabled;
    }

    public function deleteConfirmation($id, $delete)
    {
        $this->fc_id = $id;
        $this->delete = $delete;
    }

    public function delete()
    {
        FeaturedCollections::find($this->fc_id)->delete();
        $this->fc_id = null;
        $this->delete = null;
    }

    public function statusChange($id)
    {
        $d = 0;
        if ($this->status[$id] == 1) {
            $d = 1;
        }
        FeaturedCollections::find($id)->update([
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
        $collections = FeaturedCollections::all();
        foreach ($collections as $collections) {
            $this->status[$collections->id] = $collections->status;
        }
        $table = new FeaturedCollections();
        $columns = $table->getTableColumns('featured_collections');

        // $columns = $table->getTableColumns('urls');
        return view('livewire.featured-collections-component', [
            // 'collections' => FeaturedCollections::orderBy('id', 'asc')
            'collections' => FeaturedCollections::when($this->search, function ($q) use ($columns) {
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
