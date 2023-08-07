<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use App\Models\url;
use App\Models\ContactDetails;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ContactDetailsComponent extends Component
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


    public $ct_id;
    public $email;
    public $mobile_number;
    public $whatsapp_number;
    public $phone_number;
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
        $this->ct_id = null;
        $this->email = null;
        $this->mobile_number = null;
        $this->whatsapp_number = null;
        $this->phone_number = null;
        $this->disabled = null;
    }

    public function search()
    {
        dd('test');
    }

    public function store()
    {
        $this->validate([
            'email' => 'required|email',
            'mobile_number' => 'required |digits:10',
            'whatsapp_number' => 'required |digits:10',
        ], [
            'email.required' => 'Email is required.',
            'mobile_number.required' => 'Mobile number is required.',
            'whatsapp_number.required' => 'Whatsapp number is required.',
        ]);


        ContactDetails::create([
            'email' => $this->email,
            'mobile_number' => $this->mobile_number,
            'whatsapp_number' => $this->whatsapp_number,
            'phone_number' => $this->phone_number,
            'created_by' => Auth::user()->id
        ]);

        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function edit($id)
    {
        $this->delete = null;
        $this->ct_id = $id;

        $contacts = ContactDetails::find($id);
        $this->email = $contacts->email;
        $this->mobile_number = $contacts->mobile_number;
        $this->whatsapp_number = $contacts->whatsapp_number;
        $this->phone_number = $contacts->phone_number;
        $this->emit('childRefresh', $id);
    }




    public function update()
    {


        ContactDetails::find($this->ct_id)->update([
            'email' => $this->email,
            'mobile_number' => $this->mobile_number,
            'whatsapp_number' => $this->whatsapp_number,
            'phone_number' => $this->phone_number,
            'updated_by' => Auth::user()->id
        ]);
        $this->dispatchBrowserEvent('livewireUpdated');
    }

    public function view($disabled, $id)
    {
        $this->delete = null;
        $this->ct_id = $id;
        $cnts = ContactDetails::find($id);
        $this->email = $cnts->email;
        $this->mobile_number = $cnts->mobile_number;
        $this->whatsapp_number = $cnts->whatsapp_number;
        $this->phone_number = $cnts->phone_number;
        $this->disabled = $disabled;
    }

    public function deleteConfirmation($id, $delete)
    {
        $this->ct_id = $id;
        $this->delete = $delete;
    }

    public function delete()
    {
        ContactDetails::find($this->ct_id)->delete();
        $this->ct_id = null;
        $this->delete = null;
    }



    public function companyChange()
    {
        // $companies = Company::where('comapny_code','Like',)
    }

    public function render()
    {



        // $columns = $table->getTableColumns('urls');
        return view('livewire.contact-details-component', [
            'contacts' => ContactDetails::orderBy('id', 'asc')
                // 'urls' => ContactDetails::when($this->search, function ($q) use ($columns) {
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
                    $qs->where('email', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('mobile_number', 'LIKE', '%' . $this->search . '%');
                })
                ->paginate(15),
        ]);
    }
}
