@extends('dashboard.layouts.dashboard')

@section('title','Categories Page')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="{{route('dashboard.categories.create')}}">Create Category </a></li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Category</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('dashboard.categories.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @include('dashboard.categories._form',[
                            'button_label' => 'Create '
                        ])

                    </form>
                </div>
                <!-- /.card -->


            </div>
            <!--/.col (left) -->
        </div>
    </div>


@endsection
