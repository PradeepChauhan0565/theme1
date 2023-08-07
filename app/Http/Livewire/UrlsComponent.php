<?php

namespace App\Http\Livewire;



use App\Models\url;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UrlsComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $sort = "asc";
    public $sort_column = 'created_at';
    public $disabled;
    public $delete;

    public $url_id;
    public $menu_id;
    public $url_text;
    public $url;
    public $icon;
    public $label;
    public $label_color;
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
        $this->url_id = null;
        $this->url_text = null;
        $this->url = null;
        $this->icon = null;
        $this->label = null;
        $this->label_color = null;
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
            'url_text' => 'required',
            'url' => 'required',
        ], [
            'url_text.required' => 'Require',
            'url.required' => 'Require',
        ]);
        url::create([
            'text' => $this->url_text,
            'url' => $this->url,
            'icon' => $this->icon,
            'label' => $this->label ?: null,
            'label_color' => $this->label_color,
            'order_by' => $this->order_by ?: null,
            'menu_id' => $this->menu_id,
            'created_by' => Auth::user()->id
        ]);

        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function edit($id)
    {
        $this->delete = null;
        $this->url_id = $id;
        $url = url::find($id);
        $this->url_text = $url->text;
        $this->url = $url->url;
        $this->icon = $url->icon;
        $this->label = $url->label;
        $this->label_color = $url->label_color;
        $this->order_by = $url->order_by;
        $this->menu_id = $url->menu_id;
        $this->emit('childRefresh', $id);
    }

    public function update()
    {
        url::find($this->url_id)->update([
            'text' => $this->url_text,
            'url' => $this->url,
            'icon' => $this->icon,
            'label' => $this->label ?: null,
            'label_color' => $this->label_color,
            'order_by' => $this->order_by ?: null,
            'menu_id' => $this->menu_id,
            'updated_by' => Auth::user()->id
        ]);
        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function view($disabled, $id)
    {
        $this->delete = null;
        $this->url_id = $id;
        $url = url::find($id);
        $this->url_text = $url->text;
        $this->url = $url->url;
        $this->icon = $url->icon;
        $this->label = $url->label;
        $this->label_color = $url->label_color;
        $this->order_by = $url->order_by;
        $this->disabled = $disabled;
    }

    public function deleteConfirmation($id, $delete)
    {
        $this->url_id = $id;
        $this->delete = $delete;
    }

    public function delete()
    {
        url::find($this->url_id)->delete();
        $this->url_id = null;
        $this->delete = null;
    }

    public function companyChange()
    {
        // $companies = Company::where('comapny_code','Like',)
    }

    public function render()
    {

        $table = new url();
        $columns = $table->getTableColumns('urls');
        return view('livewire.urls-component', [
            'urls' => url::when($this->search, function ($q) use ($columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', $this->search . '%');
                }
            })
                // ->orWhereHas('company', function ($q) {
                //     $q->where('company_code', 'LIKE', '%' . $this->search . '%');
                // })
                // ->orWhereHas('department', function ($q) {
                //     $q->where('department_code', 'LIKE', '%' . $this->search . '%');
                // })
                ->orderBy($this->sort_column, $this->sort)
                ->paginate(15),
        ]);
    }
}
