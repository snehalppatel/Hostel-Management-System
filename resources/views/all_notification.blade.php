

    @extends('hostel_theme.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Notifications</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Details</th>
                                <th>Created Date</th>
                                <th>Read Date</th>
                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notification_data as $key => $notification)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>

                                                {{ isset($notification->data['message']) ? $notification->data['message'] : '' }}        
                                    </td>
                                    <td> {{ $notification->created_at }} </td>
                                    <td> {{ $notification->read_at }} </td>
                                    <td>
                                        @if ($notification->read_at == null)    
                                            <a data-id="{{$notification->id}}" title="Mark as Read" href="{{route('user.notification.markread', $notification->id)}}"> <i class="fa fa-check"></i> </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->   

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

