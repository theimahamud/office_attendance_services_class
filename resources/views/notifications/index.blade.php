@extends('layouts.dashboard')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <!-- Your content header code here -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-secondary">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="card-title">Notification List</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if($notifications->count() <= 0)
                            <div class="text-center">
                                <img src="{{ asset('assets/admin/dist/img/no-result.png') }}" alt="No result">
                                <h3 class="p-6 text-center">
                                    No data found
                                </h3>
                            </div>
                        @else
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 table-responsive">
                                        <table class="table table-bordered table-striped" id="datatables">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Notification</th>
                                                <th>Received At</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($notifications as $index => $notification)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        @if(isset($notification->data['message']) && $notification->data['message'] == 'leave_request_send')
                                                            Leave Request from {{ $notification->data['name'] ?? '' }}
                                                        @elseif(isset($notification->data['message']) && $notification->data['message'] == 'notice_for_all')
                                                            Notice for all
                                                        @endif</td>
                                                    <td>{{ $notification->created_at }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
    @include('layouts.assets.delete-script')
@endsection
