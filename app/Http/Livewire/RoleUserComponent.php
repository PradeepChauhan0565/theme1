<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class RoleUserComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $sort = "asc";
    public $sort_column = 'created_at';
    public $disabled;
    public $delete;

    public $user_id;
    public $role_id;
    public $role_user_id;
    public $roles=[];
    public $users=[];



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
        $this->users = User::all();
    }




    public function add()
    {
        $this->user_id = null;
        $this->role_id = null;
        $this->role_user_id = null;
        $this->disabled = null;
    }

    public function search()
    {
        dd('test');
    }

    public function store()
    {
        $this->validate([
            'user_id' => 'required',
            'role_id' => 'required',
        ], [
            'user_id.required' => 'Require',
            'role_id.required' => 'Require',
        ]);
        RoleUser::create([
            'role_id' => $this->role_id,
            'user_id' => $this->user_id,
            'created_by' => Auth::user()->id
        ]);

        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function edit($id)
    {
        $this->delete = null;
        $this->role_user_id = $id;
        $role_user = RoleUser::find($id);
        $this->role_id = $role_user->role_id;
        $this->user_id = $role_user->user_id;
        $this->emit('childRefresh', $this->user_id);
    }

    public function update()
    {
        RoleUser::find($this->user_id)->update([
            'role_id' => $this->role_id,
            'user_id' => $this->user_id,
            'updated_by' => Auth::user()->id
        ]);
        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function view($disabled, $id)
    {
        $this->delete = null;
        $this->user_id = $id;
        $role_user = RoleUser::find($id);
        $this->role_id = $role_user->role_id;
        $this->user_id = $role_user->user_id;
        $this->disabled = $disabled;
    }

    public function deleteConfirmation($id, $delete)
    {
        $this->user_id = $id;
        $this->delete = $delete;
    }

    public function delete()
    {
        User::find($this->user_id)->delete();
        $this->user_id = null;
        $this->delete = null;
    }

    public function companyChange()
    {
        // $companies = Company::where('comapny_code','Like',)
    }

    public function render()
    {

        $table = new RoleUser();
        $columns = $table->getTableColumns('role_user');
        return view('livewire.role-user-component', [
            'role_users' => RoleUser::when($this->search, function ($q) use ($columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', $this->search . '%');
                }
            })
                ->orderBy($this->sort_column, $this->sort)
                ->paginate(15),
        ]);
    }
}

