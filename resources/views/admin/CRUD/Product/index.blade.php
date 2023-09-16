@extends('admin.layouts.admin')
@section('title', 'Dashboard')
@section('contant')
    @include('admin.layouts.messages')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>En Name</th>
                                        <th>Ar Name</th>
                                        <th>Image</th>
                                        <th>Quantity</th>
                                        <th>Code</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Brand Id</th>
                                        <th>Subcatigory Id</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->en_name }} </td>
                                            <td>{{ $product->ar_name }}</td>
                                            <td> {{ $product->image }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>{{ $product->code }}</td>
                                            <td>{{ $product->price }}</td>
                                            @if ($product->status == 0)
                                                <td> inActive </td>
                                            @else
                                                <td> Active </td>
                                            @endif

                                            <td>{{ $product->brands_id }}</td>
                                            <td>{{ $product->subcatigories_id }}</td>
                                            <td>{{ $product->created_at }}</td>
                                            <td>{{ $product->updated_at }}</td>
                                            <td>

                                                {{-- <div class="row"> --}}
                                                <a href="{{ route('products.delete', $product->id) }}"
                                                    class="btn btn-outline-danger">
                                                    Delete</a>
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                    class="btn btn-outline-warning">
                                                    Edit </a>

                                                {{-- </div> --}}

                                            </td>
                                        </tr>
                                        {{-- <p>{{ $product->en_name }}</p> --}}
                                    @endforeach


                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    </body>

    </html>
@endsection
