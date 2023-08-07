<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use App\Models\url;
use App\Models\HeadingSingleBanner;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class HeadingSingleBannerComponent extends Component
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


    public $h_id;
    public $heading_first;
    public $heading_second;
    public $heading_third;
    public $heading_forth;
    public $banner_image;
    public $old_banner_image;
    public $image_title;
    public $url;
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
        $this->h_id = null;
        $this->heading_first = null;
        $this->heading_second = null;
        $this->heading_third = null;
        $this->heading_forth = null;
        $this->banner_image = null;
        $this->old_banner_image = null;
        $this->image_title = null;
        $this->url = null;
        $this->disabled = null;
    }

    public function search()
    {
        dd('test');
    }

    public function store()
    {
        if ($this->banner_image) {
            $name = $this->banner_image->getClientOriginalName();
            $image = $this->banner_image->storeAs('public/singlebanner', $name);
        }
        HeadingSingleBanner::create([
            'heading_first' => $this->heading_first,
            'heading_second' => $this->heading_second,
            'heading_third' => $this->heading_third,
            'heading_forth' => $this->heading_forth,
            'banner_image' => $name,
            'heading_forth' => $this->image_title,
            'url' => $this->url,
            'created_by' => Auth::user()->id
        ]);

        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function edit($id)
    {
        $this->delete = null;
        $this->h_id = $id;

        $headings = HeadingSingleBanner::find($id);
        $this->heading_first = $headings->heading_first;
        $this->heading_second = $headings->heading_second;
        $this->heading_third = $headings->heading_third;
        $this->heading_forth = $headings->heading_forth;
        $this->old_banner_image = $headings->banner_image;
        $this->image_title = $headings->image_title;
        $this->url = $headings->url;
        $this->emit('childRefresh', $id);
    }




    public function update()
    {
        if ($this->banner_image) {
            $name = $this->banner_image->getClientOriginalName();
            $image = $this->banner_image->storeAs('public/singlebanner', $name);
        } else {
            $img = HeadingSingleBanner::find($this->h_id);
            if ($img) {
                $name = $img->banner_image;
            }
        }

        HeadingSingleBanner::find($this->h_id)->update([
            'heading_first' => $this->heading_first,
            'heading_second' => $this->heading_second,
            'heading_third' => $this->heading_third,
            'heading_forth' => $this->heading_forth,
            'image_title' => $this->image_title,
            'url' => $this->url,
            'banner_image' => $name,
            'updated_by' => Auth::user()->id
        ]);
        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function view($disabled, $id)
    {
        $this->delete = null;
        $this->h_id = $id;
        $heads = HeadingSingleBanner::find($id);
        $this->heading_first = $heads->heading_first;
        $this->heading_second = $heads->heading_second;
        $this->heading_third = $heads->heading_third;
        $this->heading_forth = $heads->heading_forth;
        $this->url = $heads->url;
        $this->old_banner_image = $heads->banner_image;
        $this->disabled = $disabled;
    }

    public function deleteConfirmation($id, $delete)
    {
        $this->h_id = $id;
        $this->delete = $delete;
    }

    public function delete()
    {
        HeadingSingleBanner::find($this->h_id)->delete();
        $this->h_id = null;
        $this->delete = null;
    }



    public function companyChange()
    {
        // $companies = Company::where('comapny_code','Like',)
    }

    public function render()
    {



        // $columns = $table->getTableColumns('urls');
        return view('livewire.heading-single-banner-component', [
            'headings' => HeadingSingleBanner::orderBy('id', 'asc')
                // 'urls' => HeadingSingleBanner::when($this->search, function ($q) use ($columns) {
                //     foreach ($columns as $column) {
                //         $q->orWhere($column, 'LIKE', $this->search . '%');
                //     }
                // })
                // ->orWhereHas('company', function ($q) {
                //     $q->where('company_code', 'LIKE', '%' . $this->search . '%');
                // })
                // ->orWhereHas('department', function ($q) {
                //     $q->where('department_code', 'LIKE', '%' . $this->search . '%');
                // })
                // ->orderBy($this->sort_column, $this->sort)
                ->when($this->search, function ($qs) {
                    $qs->where('heading_first', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('heading_second', 'LIKE', '%' . $this->search . '%');
                })
                ->paginate(15),
        ]);
    }
}
