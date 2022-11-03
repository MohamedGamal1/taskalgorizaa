@extends('dashboard.layouts.dashboard')

@section('title', 'Products')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Product</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        @include('dashboard.products._form')
                    </form>
                </div>
                <!-- /.card -->


            </div>
            <!--/.col (left) -->
        </div>
    </div>


@endsection
