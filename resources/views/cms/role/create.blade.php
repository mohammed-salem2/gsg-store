@extends('layouts.cms')

@section('title', 'Create Role')

@section('pageTitle', 'role')

@section('activeTitle', 'create')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('cms.role.__form' , [
                'button' => 'Store',
            ])
        </form>
    </div>
@endsection
