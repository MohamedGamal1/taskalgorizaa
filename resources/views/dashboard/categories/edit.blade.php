@extends('dashboard.layouts.dashboard')

@section('title','Categories Page')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="{{route('dashboard.categories.create')}}">Update Category </a></li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Category</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('dashboard.categories.update',$category->id)}}" method="post"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('dashboard.categories._form',[
                             'button_label' => 'Update '
                         ])
                    </form>
                </div>
                <!-- /.card -->


            </div>
            <!--/.col (left) -->
        </div>
    </div>


@endsection
