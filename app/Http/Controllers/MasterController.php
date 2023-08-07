<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($component)
    {
       
        if($this->component_exists($component."-component"))
        {

            return view('masters', compact('component'));
        }
        else{
            return view('404');
        }
    }

    function component_exists($class)
{
    $manifest = app(\Livewire\LivewireComponentsFinder::class)->getManifest();
    return (bool) array_key_exists($class, $manifest);
}
}
