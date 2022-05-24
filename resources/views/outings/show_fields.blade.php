<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $outing->user_id }}</p>
</div>

<!-- In Time Field -->
<div class="col-sm-12">
    {!! Form::label('in_time', 'In Time:') !!}
    <p>{{ $outing->in_time }}</p>
</div>

<!-- Out Time Field -->
<div class="col-sm-12">
    {!! Form::label('out_time', 'Out Time:') !!}
    <p>{{ $outing->out_time }}</p>
</div>

<!-- Remarks Field -->
<div class="col-sm-12">
    {!! Form::label('remarks', 'Remarks:') !!}
    <p>{{ $outing->remarks }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $outing->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $outing->updated_at }}</p>
</div>

