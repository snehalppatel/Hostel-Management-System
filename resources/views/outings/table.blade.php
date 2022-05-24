<div class="table-responsive">
    <table class="table" id="outings-table">
        <thead>
        <tr>
            <th>Student Name</th>
        <th>In Date/Time</th>
        <th>Out Date/Time</th>
        <th>Remarks</th>
        @if(isStudent() || isSecurity())
            <th colspan="3">Action</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @if(count($outings) > 0)
        @foreach($outings as $outing)
            <tr>
                <td>{{ $outing->user->full_name }}</td>
            <td>{{ ($outing->in_date !=null)?\Carbon::parse($outing->in_date)->format('d-m-Y'):'-' }} / {{ ($outing->in_time !=null)?\Carbon::parse($outing->in_time)->format('g:i A'):'-' }}</td>
            <td>{{ ($outing->out_date !=null)?\Carbon::parse($outing->out_date)->format('d-m-Y'):'-' }} / {{ ($outing->out_time !=null)?\Carbon::parse($outing->out_time)->format('g:i A'):'-' }}</td>
            <td>{{ $outing->remarks }}</td>
                        @if(isStudent() || isSecurity())
                <td width="120">
                    {!! Form::open(['route' => ['outings.destroy', $outing->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>

                        <a href="{{ route('outings.edit', [$outing->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
                    @endif
            </tr>
        @endforeach
        @else
            <tr>
                <td colspan="5" style="text-align:center;"> No record found!</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
