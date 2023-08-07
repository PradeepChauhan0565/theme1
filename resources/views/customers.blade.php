@extends('adminlte::page')
@section('title', 'Customer')

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
<div style="height: 85vh; overflow-y: auto">
    @livewire('customer-component')
</div>
@stop