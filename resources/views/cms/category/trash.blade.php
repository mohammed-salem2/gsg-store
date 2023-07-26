@extends('layouts.cms')

@section('title', 'Deleted Product')

@section('pageTitle', 'product')

@section('activeTitle', 'trash')

@section('content')
<x-alert  />
<div class="card">
    <div class="card-header">
        <a href="{{ route('categories.index') }}" class="btn btn-sm btn-info">
            Categories
        </a>
        <a href="{{ route('categories.restore-all') }}" class="btn btn-sm btn-info">
            <i class="fas fa-trash-restore"></i> Restore All
        </a>
        <a href="{{ route('categories.delete-all') }}" class="btn btn-sm btn-danger">
            <i class="fas fa-trash"></i> Delete All
        </a>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped">
            <x-trash-table
            :ths="['#' , 'Name' , 'Parent Name' , 'Status', 'Settings']"
            :parents="$categories"
            restore="categories.restore"
            destory="categories.force-delete"
            :values="['id' , 'name'  , 'parent_name' , 'status']"
            />
        </table>
        {{$categories->links()}}
    </div>
    <!-- /.card-body -->
</div>
@endsection
