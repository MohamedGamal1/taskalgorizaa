@extends('dashboard.layouts.dashboard')

@section('title','Products Page')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="#">Products Page </a></li>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Products</h3>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3 text-center">
                <a href="{{route('dashboard.products.create')}}"
                   class="btn btn-lg btn-outline-primary">Create Product</a>
            </div>
        </div>
        <x-alert type="success"/>
        <x-alert type="info"/>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="products" class="table table-bordered table-striped">
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
                @if(isset($products) && count($products) > 0 )
                    @foreach($products as $product)
                        <tr>

                            <td><img src="{{asset('storage/'.$product->image)}}" alt="" height="50" width="50"></td>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td> {{$product->category ? $product->category->name :  " "}}</td>
                            <td> {{$product->status}}</td>
                            <td>{{$product->created_at}}</td>
                            <td>
                                <div class="text-center mx-2">
                                    <a href="{{route('dashboard.products.edit',$product->id)}}"
                                       class="btn btn-sm btn-outline-success">Edit</a>
                                </div>
                                <div class="text-center mx-2">
                                    <form action="{{route('dashboard.products.destroy',$product->id)}}"
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
                    <th>Category</th>
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
            $("#products").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#products_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush

