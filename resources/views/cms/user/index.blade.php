@extends('layouts.cms')

@section('title', 'Index User')

@section('pageTitle', 'User')

@section('activeTitle', 'Index User')

@section('content')
<x-alert  />
    <div class="card">
        <div class="card-header">
            {{-- <h3 class="card-title">Striped Full Width Table</h3> --}}
            <a href="{{ route('users.create') }}" class="btn btn-sm btn-info">
                Create New Category
            </a>
            {{-- <a href="{{ route('users.trash') }}" class="btn btn-sm btn-warning">
                <i class="fas fa-trash"></i> Trash
            </a> --}}
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped">
                <x-table
                :ths="['#' , 'Name' , 'Email' , 'Created By' , 'Settings']"
                :parents="$users"
                edit="users.edit"
                show="users.show"
                destory="users.destroy"
                :values="['id' , 'name' , 'email']"
                table="user"
                />
            </table>
            {{ $users->links() }}
        </div>
        <!-- /.card-body -->
    </div>
@endsection
