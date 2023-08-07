@extends('adminlte::page')
@section('title', ucfirst($component))

@section('content_header')
<span style="padding: 0px !important;"></span>
@stop
@section('content')
<style>
    tr,
    td,
    th {
        padding: 3px 15px !important;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<div>
    {{-- {{$component}} --}}
    @livewire($component.'-component')
</div>
{{-- <div wire:ignore aria-live="polite" aria-atomic="true"
    style="position: absolute; top:0; right:0; min-height: 200px;" id="tt"> --}}
    <div wire:ignore class="toast bg-success" style="position: absolute; top: 10px; right: 10px; z-index: 9999;"
        data-autohide="true" data-delay="3000">
        <div class="toast-body">
            Updated Successfully...
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    {{--
</div> --}}
<script>
    $(document).ready(function(){
        window.addEventListener('livewireUpdated', event => {
            $("#exampleModal").modal('hide');
            $('.toast').toast('show');
        })
        window.addEventListener('livewireEdit', event => {
           console.log('test');
            $("#exampleModal").modal('show');
        })
        
    });
</script>
@stop