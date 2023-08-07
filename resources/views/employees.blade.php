@extends('adminlte::page')
@push('css')
<style type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Raleway&family=Roboto&display=swap"rel="stylesheet">body {
        font-family: 'Roboto', sans-serif !important;
    }
</style>
@endpush
@section('title', 'Employees')

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
    @livewire('employee-component')
</div>
@stop