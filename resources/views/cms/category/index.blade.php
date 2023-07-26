@extends('layouts.cms')

@section('title', 'Index Category')

@section('pageTitle', 'Category')

@section('activeTitle', 'Index Category')

@section('content')
<x-alert  />
    <div class="card">
        <div class="card-header">
            {{-- <h3 class="card-title">Striped Full Width Table</h3> --}}
            <a href="{{ route('categories.create') }}" class="btn btn-sm btn-info">
                Create New Category
            </a>
            <a href="{{ route('categories.trash') }}" class="btn btn-sm btn-warning">
                <i class="fas fa-trash"></i> Trash
            </a>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped">
                <x-table
                :ths="['#' , 'Name' , 'Parent Name' , 'Status' , 'Products Number', 'Created By' , 'Settings']"
                :parents="$categories"
                edit="categories.edit"
                show="categories.show"
                destory="categories.destroy"
                relation="parent"
                table="category"
                :values="['id' , 'name' , 'forign_id' , 'status' , 'products_count']"
                />
            </table>
            {{ $categories->links() }}
        </div>
        <!-- /.card-body -->
    </div>
@endsection
