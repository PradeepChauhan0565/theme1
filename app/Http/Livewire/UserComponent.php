<?php

namespace App\Http\Livewire;


use App\Models\Interview;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class UserComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    // use SoftDeletes;
    public $search;
    public $sort = "asc";
    public $sort_column = 'created_at';
    public $disabled;
    public $delete;
    public $msg = null;


    public $user_id = null;
    public $name = null;
    public $email  = null;
    public $email_verified_at = null;
    public $password = null;
    public $password_confirmation = null;
    public $remember_token = null;
    public $emp_code = null;
    public $profile_photo_path = null;
    public $employee_id = null;
    public $role_id = null;



    protected $listeners = [
        'getTableId'
    ];

    public function hydrate()
    {
    }

    public function getTableId($table_id, $column_name)
    {
        $this->$column_name = $table_id;
        
    }

    public function sort($column)
    {
        $this->sort_column = $column;
        $this->sort == 'asc' ? $this->sort = 'desc' : $this->sort = 'asc';
    }




    public function add()
    {
        $this->user_id = null;
        $this->name = null;
        $this->email  = null;
        $this->email_verified_at = null;
        $this->password = null;
        $this->remember_token = null;
        $this->emp_code = null;
        $this->profile_photo_path = null;
        $this->employee_id = null;
        $this->role_id = null;
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
            'email' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Require',
            'email.required' => 'Require',
            'password.required' => 'Require',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'password' => Hash::make($this->password),
            'remember_token' => $this->remember_token,
            'emp_code' => $this->emp_code,
            'profile_photo_path' => $this->profile_photo_path,
            'employee_id' => $this->employee_id,
            'role_id' => $this->role_id,
            'created_by' => Auth::user()->id,
        ]);

        $this->msg = "Save successfully...";
        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function edit($id)
    {
        $this->delete = null;
        $this->user_id = $id;
        $user = User::find($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->email_verified_at = $user->email_verified_at;
        $this->password = $user->password;
        $this->remember_token = $user->remember_token;
        
        $this->emit('childRefresh', $id);
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ], [
            'name.required' => 'Require',
            'email.required' => 'Require',
            'password.required' => 'Require',
        ]);

        User::find($this->user_id)->update([
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'password' => $this->password,
            'remember_token' => $this->remember_token,
            // 'emp_code' => $this->emp_code,
            // 'profile_photo_path' => $this->profile_photo_path,
            'updated_by' => Auth::user()->id,
        ]);
    }

    public function view($disabled, $id)
    {
        $this->delete = null;
        $user = User::find($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->email_verified_at = $user->email_verified_at;
        $this->password = $user->password;
        $this->remember_token = $user->remember_token;
        $this->emp_code = $user->emp_code;
        $this->profile_photo_path = $user->profile_photo_path;
        $this->employee_id = $user->employee_id;
        $this->role_id = $user->role_id;
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
        // $companies = Company::where('comapny_name','Like',)
    }

    public function render()
    {

        $table = new User();
        $columns = $table->getTableColumns('companies');
        return view('livewire.user-component', [
            'users' => User::when($this->search, function ($q) use ($columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', $this->search . '%');
                }
            })
                // ->orWhereHas('company', function ($q) {
                //     $q->where('company_name', 'LIKE', '%' . $this->search . '%');
                // })
                // ->orWhereHas('department', function ($q) {
                //     $q->where('department_name', 'LIKE', '%' . $this->search . '%');
                // })
                ->orderBy($this->sort_column, $this->sort)
                ->paginate(15),
        ]);
    }
}
