<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use App\Models\url;
use App\Models\WeddingIdentity;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class WeddingIdentityComponent extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $sort = "asc";
    public $sort_column = 'created_at';
    public $disabled;
    public $delete;


    public $wi_id;
    public $menu_id;
    public $wi_image;
    public $old_wi_image;
    public $image_title;
    public $heading;
    public $content;
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
        $this->wi_id = null;
        $this->wi_image = null;
        $this->old_wi_image = null;
        $this->image_title = null;
        $this->heading = null;
        $this->content = null;
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
            'wi_image' => 'required',
            'image_title' => 'required',
            'heading' => 'required',
            'content' => 'required',
            'url' => 'required',
        ], [
            'wi_image.required' => 'Image is required.',
            'image_title.required' => 'Image title is required.',
            'heading.required' => 'Heading is required.',
            'content.required' => 'Content is required.',
            'url.required' => 'Url is required.',
        ]);
        if ($this->wi_image) {
            $name = $this->wi_image->getClientOriginalName();
            $image = $this->wi_image->storeAs('public/wiimages', $name);
        }

        WeddingIdentity::create([
            'wi_image' => $name,
            'image_title' => $this->image_title,
            'heading' => $this->heading,
            'content' => $this->content,
            'url' => $this->url,
            'order_by' => $this->order_by ?: null,
            'created_by' => Auth::user()->id
        ]);

        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function edit($id)
    {
        $this->delete = null;
        $this->wi_id = $id;

        $wi = WeddingIdentity::find($id);
        $this->old_wi_image = $wi->wi_image;
        $this->image_title = $wi->image_title;
        $this->heading = $wi->heading;
        $this->content = $wi->content;
        $this->url = $wi->url;
        $this->order_by = $wi->order_by;
        $this->emit('childRefresh', $id);
    }

    public function update()
    {
        $name = null;

        if ($this->wi_image) {
            $name = $this->wi_image->getClientOriginalName();
            $image = $this->wi_image->storeAs('public/wiimages', $name);
        } else {
            $img = WeddingIdentity::find($this->wi_id);
            if ($img) {
                $name = $img->wi_image;
            }
        }

        WeddingIdentity::find($this->wi_id)->update([
            'wi_image' => $name,
            'image_title' => $this->image_title,
            'heading' => $this->heading,
            'content' => $this->content,
            'url' => $this->url,
            'order_by' => $this->order_by ?: null,
            'updated_by' => Auth::user()->id
        ]);
        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function view($disabled, $id)
    {
        $this->delete = null;
        $this->wi_id = $id;
        $url = WeddingIdentity::find($id);
        $this->old_wi_image = $url->wi_image;
        $this->url = $url->url;
        $this->heading = $url->heading;
        $this->content = $url->content;
        $this->order_by = $url->order_by;
        $this->disabled = $disabled;
    }

    public function deleteConfirmation($id, $delete)
    {
        $this->wi_id = $id;
        $this->delete = $delete;
    }

    public function delete()
    {
        WeddingIdentity::find($this->wi_id)->delete();
        $this->wi_id = null;
        $this->delete = null;
    }

    public function statusChange($id)
    {
        $d = 0;
        if ($this->status[$id] == 1) {
            $d = 1;
        }
        WeddingIdentity::find($id)->update([
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
        $weddings = WeddingIdentity::all();
        foreach ($weddings as $weddings) {
            $this->status[$weddings->id] = $weddings->status;
        }


        // $columns = $table->getTableColumns('urls');
        return view('livewire.wedding-identity-component', [
            'wedingidentity' => WeddingIdentity::orderBy('id', 'asc')
                // 'urls' => HeroBanner::when($this->search, function ($q) use ($columns) {
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
                    $qs->where('image_title', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('order_by', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('heading', 'LIKE', '%' . $this->search . '%');
                })
                ->paginate(15),
        ]);
    }
}
