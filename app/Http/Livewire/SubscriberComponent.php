<?php

namespace App\Http\Livewire;

use App\Models\Subscribe;
use Livewire\Component;
use Livewire\WithPagination;

class SubscriberComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public function render()
    {
        return view('livewire.subscriber-component', [
            'Subscribers' => Subscribe::orderBy('id', 'DESC')->when($this->search, function ($q) {
                $q->where('email', 'LIKE', '%' . $this->search . '%');
            })->paginate(500),
        ]);
    }
}
