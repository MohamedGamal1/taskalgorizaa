@extends('dashboard.layouts.dashboard')

@section('title','Categories Page')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="#">Categories Page </a></li>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Categories</h3>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3 text-center">
                <a href="{{route('dashboard.categories.create')}}"
                   class="btn btn-lg btn-outline-primary">Create Category</a>
            </div>
        </div>
        <x-alert type="success"/>
        <x-alert type="info"/>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="categories" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th></th>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Parent Category</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if(isset($categories) && count($categories) > 0 )
                    @foreach($categories as $category)
                        <tr>

                            <td><img src="{{asset('storage/'.$category->image)}}" alt="" height="50" width="50"></td>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td> {{$category->parent_name}}</td>
                            <td> {{$category->status}}</td>
                            <td>{{$category->created_at}}</td>
                            <td>
                                <div class="text-center mx-2">
                                    <a href="{{route('dashboard.categories.edit',$category->id)}}"
                                       class="btn btn-sm btn-outline-success">Edit</a>
                                </div>
                                <div class="text-center mx-2">
                                    <form action="{{route('dashboard.categories.destroy',$category->id)}}"
                                          method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>

                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <th></th>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Parent ID</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th></th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
@push('scripts')
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <script>
        $(function () {
            $("#categories").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#categories_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush

