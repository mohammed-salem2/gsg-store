@extends('layouts.cms')

@section('title', 'Index Role')

@section('pageTitle', 'role')

@section('activeTitle', 'Index Role')

@section('content')
<x-alert  />
    <div class="card">
        <div class="card-header">
            {{-- <h3 class="card-title">Striped Full Width Table</h3> --}}
            <a href="{{ route('roles.create') }}" class="btn btn-sm btn-info">
                Create New Role
            </a>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped">
                <x-table
                :ths="['#' , 'Name', 'Created By','Settings']"
                :parents="$roles"
                edit="roles.edit"
                show="roles.show"
                destory="roles.destroy"
                table="role"
                :values="['id' , 'name']"
                />
            </table>
            {{ $roles->links() }}
        </div>
        <!-- /.card-body -->
    </div>
@endsection
