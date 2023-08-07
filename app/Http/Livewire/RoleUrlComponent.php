<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\RoleUrl;
use App\Models\url;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class RoleUrlComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $sort = "asc";
    public $sort_column = 'created_at';
    public $disabled;
    public $delete;

    public $url_id;
    public $role_id;
    public $role_url_id;
    public $roles=[];
    public $urls=[];



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

    public function mount()
    {
        $this->roles = Role::all();
        $this->urls = url::all();
    }




    public function add()
    {
        $this->url_id = null;
        $this->role_id = null;
        $this->role_url_id = null;
        $this->disabled = null;
    }

    public function search()
    {
        dd('test');
    }

    public function store()
    {
        $this->validate([
            'url_id' => 'required',
            'role_id' => 'required',
        ], [
            'url_id.required' => 'Require',
            'role_id.required' => 'Require',
        ]);
        RoleUrl::create([
            'role_id' => $this->role_id,
            'url_id' => $this->url_id,
            'created_by' => Auth::user()->id
        ]);

        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function edit($id)
    {
        $this->delete = null;
        $this->role_url_id = $id;
        $role_url = RoleUrl::find($id);
        $this->role_id = $role_url->role_id;
        $this->url_id = $role_url->url_id;
        $this->emit('childRefresh', $this->url_id);
    }

    public function update()
    {
        RoleUrl::find($this->url_id)->update([
            'role_id' => $this->role_id,
            'url_id' => $this->url_id,
            'updated_by' => Auth::user()->id
        ]);
        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function view($disabled, $id)
    {
        $this->delete = null;
        $this->url_id = $id;
        $role_url = RoleUrl::find($id);
        $this->role_id = $role_url->role_id;
        $this->url_id = $role_url->url_id;
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

        $table = new RoleUrl();
        $columns = $table->getTableColumns('role_url');
        return view('livewire.role-url-component', [
            'role_urls' => RoleUrl::when($this->search, function ($q) use ($columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', $this->search . '%');
                }
            })
                ->orderBy($this->sort_column, $this->sort)
                ->paginate(15),
        ]);
    }
}

