@extends('layouts.cms')

@section('title', 'Edit User')

@section('pageTitle', 'user')

@section('activeTitle', 'edit')

@section('content')
 {{-- //هان في الفورم فش ميثود اسمها بوت ي اما جيت او بوست القيمة الافتراضية في حال وضعت قيمة غير الجيت و البوست هي الجيت --}}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('users.update' , $users->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')

            @include('cms.user.__form' , [
                'button' => 'Update',
            ])
        </form>
    </div>
@endsection
