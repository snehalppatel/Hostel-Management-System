<div class="table-responsive">
    <table class="table" id="leaves-table">
        <thead>
        <tr>

            <th>Student Name</th>
            <th>Roll No.</th>
            <th>Phone</th>
            <th>Email</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Place</th>        
        <th>Reason</th>
        <th>Status</th>    
        <th>Created At</th>        
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @if($leaves->count() > 0)
        @foreach($leaves as $leave)
            <tr>

                <td>{{($leave->user)?$leave->user->full_name:null}}</td>
            <td>{{ $leave->user->roll_number }}</td>
            <td>{{ $leave->user->phone }}</td>
            <td>{{ $leave->user->email }}</td>
            <td>{{ ($leave->start_date !=null)?\Carbon::parse($leave->start_date)->format('d-m-Y'):'' }}</td>
            <td>{{ ($leave->end_date !=null)?\Carbon::parse($leave->end_date)->format('d-m-Y'):'' }}</td>
            <td>{{ $leave->place }}</td>
            <td>{!! $leave->reason !!}</td>
            <td>{!! $leave->status_display !!}</td>            
            <td>{{ $leave->created_at }}</td>                        
                <td width="120">
                    @if(isWarden())
                        <a href="{{ route('leaves.edit', [$leave->id]) }}"
                           class='btn btn-warning btn-xs'>
                            Edit Status
                        </a>                    
                    @else

                    {!! Form::open(['route' => ['leaves.destroy', $leave->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @if(Auth::guard('web')->check())                        
<!--                         <a href="{{ route('leaves.show', [$leave->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a> -->
                        @if(Auth::guard('web')->user()->id == $leave->user_id)

                                @if($leave->status =='Pending')
                                <a href="{{ route('leaves.edit', [$leave->id]) }}"
                                   class='btn btn-default btn-xs'>
                                    <i class="far fa-edit"></i>
                                </a>
                                @endif

                        @endif
                        @endif
                        @if(Auth::guard('web')->user()->id == $leave->user_id)
                            @if($leave->status != 'Approved')
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            @endif
                        @endif
                    </div>
                    {!! Form::close() !!}
                    @endif

                </td>
            </tr>
        @endforeach
        @else
            <tr>
                <td colspan="6" style="text-align:center;"> No record found!</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
