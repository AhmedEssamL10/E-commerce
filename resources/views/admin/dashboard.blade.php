@extends('admin.layouts.admin')
@section('title', 'Dashboard')
@section('contant')
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>65</h3>
                <p>Unique Visitors</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- mail content -->
    <section class="content">
        <div class="row">

            <div class="col-md-9">
                <div class="card card-primary card-outline">
                    <div class="card-header">

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Subject</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($complaints as $complaint)
                                        <tr id="complaint-row-{{ $complaint->id }}">
                                            <td>
                                                <a href="{{ route('admin.complaints.delete', $complaint->id) }}"
                                                    class="btn btn-default btn-sm delete-complaint"
                                                    data-complaint-id="{{ $complaint->id }}">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </td>
                                            <td class="mailbox-star"><a href="#"><i
                                                        class="fas fa-star text-warning"></i></a></td>
                                            <td class="mailbox-name"><a
                                                    href="read-mail.html">{{ $complaint->user_name }}</a>
                                            </td>
                                            <td class="mailbox-name"><a
                                                    href="read-mail.html">{{ $complaint->user_email }}</a>
                                            </td>
                                            <td class="mailbox-name"><a
                                                    href="read-mail.html">{{ $complaint->user_phone }}</a>
                                            </td>
                                            <td class="mailbox-subject"><b>{{ $complaint->subject }}</b>
                                            </td>

                                            <td class="mailbox-date">{{ $complaint->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    <!-- ./col -->
    </div>

@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-complaint').on('click', function(event) {
                event.preventDefault(); // Prevent default link behavior

                var link = $(this);
                var complaintId = link.data('complaint-id');

                $.ajax({
                    url: link.attr('href'),
                    method: 'GET',
                    data: {
                        complaint_id: complaintId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        // Handle the success response
                        console.log(response);
                        if (link.hasClass('delete-complaint')) {
                            $('#complaint-row-' + complaintId).remove();
                        }

                    },
                    error: function(xhr, status, error) {
                        // Handle the error response
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
