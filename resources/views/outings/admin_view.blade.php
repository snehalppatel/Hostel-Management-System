@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Outings</h1>
                </div>

            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
<div class="table-responsive">
    <table class="table" id="outings-table">
        <thead>
        <tr>
            <th>User</th>
        <th>In Time</th>
        <th>Out Time</th>
        <th>Remarks</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($outings as $outing)
            <tr>
                <td>{{ $outing->user->full_name }}</td>
            <td>{{ \Carbon::parse($outing->in_time)->format('g:i A') }}</td>
            <td>{{ \Carbon::parse($outing->out_time)->format('g:i A') }}</td>
            <td>{{ $outing->remarks }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['outings.destroy', $outing->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>

                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

