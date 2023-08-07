@extends('adminlte::page')
@section('title', 'Complaint')

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
<div>
    @livewire('complaint-component',['status'=>$status])
</div>
@stop