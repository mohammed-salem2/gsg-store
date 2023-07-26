@extends('layouts.cms')

@section('title', 'Create Product')

@section('pageTitle', 'product')

@section('activeTitle', 'create')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('cms.product.__form' , [
                'button' => 'Store',
            ])
        </form>
    </div>
@endsection
