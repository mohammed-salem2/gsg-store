@extends('layouts.cms')

@section('title', 'Show Product')

@section('pageTitle', 'product')

@section('activeTitle', 'show')

@section('cssFile')
@endsection

@section('content')
    <div class="card card-primary bg-secondary">
        <div class="card-header">
            <h3 class="card-title">Show</h3>
        </div>
        <section style="background-color: #eee;">
            <div class="container py-5">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body text-center bg-white">
                                <img src="{{ $products->image_url }}"
                                    alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                <h5 class="my-3">{{ $products->name }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body bg-white">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Name</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $products->name }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Category Name</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $products->category->name ?? "Not Found" }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Status</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $products->status }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Price</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">{{ $products->formatted_price }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="card-footer bg-primary">
            <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
        </div>
        <!-- /.card-header -->
    </div>
@endsection
