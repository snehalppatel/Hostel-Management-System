<!-- User Id Field -->
@php
    $indatetime = null;
    $outdatetime = null;
    $intime = null;
    $outtime = null;
    if(isset($outing) && $outing->in_date !=null){
        $indatetime = \Carbon::parse($outing->in_date)->format('d-m-Y');
        $intime = \Carbon::parse($outing->in_time)->format('g:i:s');
    }
    if(isset($outing) && $outing->out_date !=null){        
        $outdatetime = \Carbon::parse($outing->out_date)->format('d-m-Y');        
        $outtime = \Carbon::parse($outing->out_time)->format('g:i:s');
    }    
@endphp

@if(isStudent())

<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'In Date/Time:') !!}
    {!! Form::text('in_time', $indatetime . $intime, ['class' => 'form-control', 'id' => 'in_time',  'disabled' => 'disabled' , 'readonly' => 'readonly']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'Out Date/Time:') !!}
    {!! Form::text('out_time', $outdatetime . $outtime, ['class' => 'form-control', 'id' => 'out_time','required']) !!}
</div>
@else



<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'In Date/Time:') !!}
    {!! Form::text('in_time', $indatetime . $intime, ['class' => 'form-control', 'id' => 'in_time', 'required']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'Out Date/Time:') !!}
    {!! Form::text('out_time', $outdatetime . $outtime, ['class' => 'form-control', 'disabled' => 'disabled', 'id' => 'out_time', 'readonly' => 'readonly']) !!}
</div>

@endif


@push('page_scripts')
    <script type="text/javascript">
        $('#in_time').datetimepicker({
            format: 'DD-MM-YYYY HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

@push('page_scripts')
    <script type="text/javascript">
        $('#out_time').datetimepicker({
            format: 'DD-MM-YYYY HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Remarks Field -->
<div class="form-group col-sm-12">
    {!! Form::label('remarks', 'Remarks:') !!}
    {!! Form::textarea('remarks', null, ['class' => 'form-control', 'cols'=>2, 'rows'=>2, 'placeholder'=> 'Please mention the purpose and place']) !!}
</div>