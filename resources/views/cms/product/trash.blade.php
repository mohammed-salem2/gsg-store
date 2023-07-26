@extends('layouts.cms')

@section('title', 'Deleted Product')

@section('pageTitle', 'product')

@section('activeTitle', 'trash')

@section('content')
<x-alert  />
<div class="card">
    <div class="card-header">
        <a href="{{ route('products.index') }}" class="btn btn-sm btn-info">
            Products
        </a>
        <a href="{{ route('products.restore-all') }}" class="btn btn-sm btn-info">
            <i class="fas fa-trash-restore"></i> Restore All
        </a>
        <a href="{{ route('products.delete-all') }}" class="btn btn-sm btn-danger">
            <i class="fas fa-trash"></i> Delete All
        </a>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped">
            <x-trash-table
            :ths="['#' , 'Name' , 'Price' , 'Qty.' , 'Status', 'category Name' , 'Settings']"
            :parents="$products"
            restore="products.restore"
            destory="products.force-delete"
            relation="category"
            :values="['id' , 'name'  , 'price' , 'quantity' , 'status' , 'forign_id']"
            />
        </table>
        {{$products->links()}}
    </div>
    <!-- /.card-body -->
</div>
@endsection
