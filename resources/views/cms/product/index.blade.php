@extends('layouts.cms')

@section('title', 'Index Product')

@section('pageTitle', 'product')

@section('activeTitle', 'Index')

@section('content')
    <x-alert />
    <div class="card">
        <div class="card-header">
            {{-- <h3 class="card-title">Striped Full Width Table</h3> --}}
            <a href="{{ route('products.create') }}" class="btn btn-sm btn-info">
                Create New Product
            </a>
            <a href="{{ route('products.trash') }}" class="btn btn-sm btn-warning">
                <i class="fas fa-trash"></i> Trash
            </a>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped" id="myTable">
                <x-table :ths="['#', 'Name', 'Price', 'Qty.', 'Status', 'category Name', 'created By', 'Settings']" :parents="$products" edit="products.edit" show="products.show"
                    destory="products.destroy" relation="category" table="product" :values="['id', 'name', 'formatted_price', 'quantity', 'status', 'forign_id']" />
            </table>
            {{ $products->links() }}
        </div>
        <!-- /.card-body -->
    </div>
@endsection


