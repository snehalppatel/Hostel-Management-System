<!-- User Id Field -->
@if(isWarden())
<input type="hidden" name="update_status" value="1">
    <div class="form-group col-sm-6">
        {!! Form::label('status', 'Update Status:') !!}<Br>
    <label><input type="radio" name="status" value="Pending" {{($leave->status == 'Pending')?'checked':null}} > Pending</label>&nbsp;&nbsp;&nbsp;<Br>
    <label><input type="radio" name="status" value="Approved" {{($leave->status == 'Approved')?'checked':null}}> Approved</label>&nbsp;&nbsp;&nbsp;<Br>
    <label><input type="radio" name="status" value="Rejected" {{($leave->status == 'Rejected')?'checked':null}}> Rejected</label>&nbsp;&nbsp;&nbsp;               
    </div>

@else

    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">


<!-- Start Date Field -->

<div class="form-group col-sm-6">
    {!! Form::label('start_date', 'Start Date:') !!}
    {!! Form::text('start_date', \Carbon::parse($leave->start_date)->format('d-m-Y'), ['class' => 'form-control','id'=>'start_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#start_date').datetimepicker({
            format: 'DD-MM-YYYY',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- End Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end_date', 'End Date:') !!}
    {!! Form::text('end_date', \Carbon::parse($leave->end_date)->format('d-m-Y'), ['class' => 'form-control','id'=>'end_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#end_date').datetimepicker({
            format: 'DD-MM-YYYY',
            useCurrent: true,
            sideBySide: true,
        })
    </script>
@endpush

<!-- Reason Field -->
<div class="form-group col-sm-12">
    {!! Form::label('reason', 'Reason:') !!}
    {!! Form::textarea('reason', null, ['class' => 'form-control', 'cols'=>2, 'rows'=>2]) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('place', 'Place:') !!}
    {!! Form::text('place', null, ['class' => 'form-control', 'placeholder'=>'name of place/location']) !!}
</div>
@endif

