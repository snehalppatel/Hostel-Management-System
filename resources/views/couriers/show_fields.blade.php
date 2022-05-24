<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $courier->name }}</p>
</div>

<!-- Roll Number Field -->
<div class="col-sm-12">
    {!! Form::label('roll_number', 'Roll Number:') !!}
    <p>{{ $courier->roll_number }}</p>
</div>

<!-- Date Field -->
<div class="col-sm-12">
    {!! Form::label('date', 'Date:') !!}
    <p>{{ $courier->date }}</p>
</div>

<!-- Security Id Field -->
<div class="col-sm-12">
    {!! Form::label('security_id', 'Security Id:') !!}
    <p>{{ $courier->security_id }}</p>
</div>

<!-- Hostel Name Field -->
<div class="col-sm-12">
    {!! Form::label('hostel_name', 'Hostel Name:') !!}
    <p>{{ $courier->hostel_name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $courier->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $courier->updated_at }}</p>
</div>

