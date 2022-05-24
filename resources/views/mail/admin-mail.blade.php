@extends('sogog::mail.layouts.email-master')

@section('content')



<h1 style="text-align: center;">PAYMENT STATUS - <span style="color: green">{{ $booking->status}}</span></h1>
<h3 style="text-align: center;">BOOKING DETAILS </h3>
<table class="purchase" style="padding: 0px;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
  <tr>
    <td>
      <h3 style="color: blue;">Date: {{ carbon($booking->created_at)->format('d-m-Y')}}
        <Br><Br><Br>
        Booking ID: {{$booking->bookingid}}
      </h3></td>


    <td  style="text-align: right;">
        {!! QrCode::size(150)->generate($booking->qrCodeData()); !!}
    </td>
  </tr>
<!--   <tr>
    <td>
      <h3 class="align-left">Date: {{ carbon($booking->created_at)->format('d-m-Y')}}</h3></td>
  </tr> -->
  <tr>
    <td colspan="2">
        <div class="table-responsive">
        @foreach($participants as $key => $get_participant)          
        <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0">
            <thead class="viewbooking tablecolor">
              <tr>
                <th class="purchase_heading" align="left" colspan="2" >
                  <p class="f-fallback" style="font-size: 16px;font-weight: bold">Participant -{{ $key+1 }} </p></th>
              </tr>
            </thead>
            <tbody class="viewbooking tablecolor">
                  <tr>
                    <th class="purchase_heading_table" align="left">Name</th>
                    <td class="purchase_item_table" align="left">{{ $get_participant->name }}</td>
                  </tr>
                  <tr>
                    <th class="purchase_heading_table" align="left">Participant ID</th>
                    <td class="purchase_item_table" align="left">{{ $get_participant->participantid }}</td>
                  </tr>                  
                  <tr>
                    <th class="purchase_heading_table" align="left">Type</th>
                    <td class="purchase_item_table" align="left">{{ $get_participant->type }}</td>
                  </tr>
                  <tr>
                    <th class="purchase_heading_table" align="left">Gender</th>
                    <td class="purchase_item_table" align="left">{{ $get_participant->gender }}</td>
                  </tr>                                                                                
                  <tr>
                    <th class="purchase_heading_table" align="left">Age</th>
                    <td class="purchase_item_table" align="left">{{ $get_participant->age }} Years</td>
                  </tr>                                                                                
                  <tr>
                    <th class="purchase_heading_table" align="left">Mobile</th>
                    <td class="purchase_item_table" align="left">{{ $get_participant->mobile }}</td>
                  </tr>                                                                                
                  <tr>
                    <th class="purchase_heading_table" align="left">Email</th>
                    <td class="purchase_item_table" align="left">{{ $get_participant->email }}</td>
                  </tr>     
                  @if($get_participant->type == 'Delegate')
                  <tr>
                    <th class="purchase_heading_table" align="left">Membership Number</th>
                    <td class="purchase_item_table" align="left">{{ $get_participant->doctory_reg_no }}</td>
                  </tr>                                                                                       
                  <tr>
                    <th class="purchase_heading_table" align="left">Society</th>
                    <td class="purchase_item_table" align="left">{{ $get_participant->society }}</td>
                  </tr>                                                                                       
                  <tr>
                    <th class="purchase_heading_table" align="left">Institute Name</th>
                    <td class="purchase_item_table" align="left">{{ $get_participant->institution_name }}</td>
                  </tr>                                                                                       
                  @endif
                  @if($get_participant->type == 'Student')
                  <tr>
                    <th class="purchase_heading_table" align="left">College Name</th>
                    <td class="purchase_item_table" align="left">{{ $get_participant->college_name }}</td>
                  </tr>
                  <tr>
                    <th class="purchase_heading_table" align="left">Department</th>
                    <td class="purchase_item_table" align="left">{{ $get_participant->department }}</td>
                  </tr>
                  @endif
                  <tr>
                    <th class="purchase_heading_table" align="left">Photo ID</th>
                    <td class="purchase_item_table" align="left">{{ $get_participant->id_proof_type }}</td>
                  </tr>                                                                                       
                  <tr>
                    <th class="purchase_heading_table" align="left">Photo ID Number</th>
                    <td class="purchase_item_table" align="left">{{ $get_participant->id_proof }}</td>
                  </tr>                                                                                       
                  <tr>
                    <th class="purchase_heading_table" align="left">Address</th>
                    <td class="purchase_item_table" align="left">{{ $get_participant->address }}</td>
                  </tr>
              </tbody>           
          </table>
        @endforeach  
        </div>
      <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td width="80%" class="purchase_footer" valign="middle" colspan="3">
            <p class="f-fallback purchase_total purchase_total--label">No of Persons</p>
          </td>
          <td width="20%" class="purchase_footer" valign="middle">
            <p class="f-fallback purchase_total">{{ count($participants)}}</p>
          </td>
        </tr>        
        <tr>
          <td width="80%" class="purchase_footer" valign="middle" colspan="3">
            <p class="f-fallback purchase_total purchase_total--label">Sub Total</p>
          </td>
          <td width="20%" class="purchase_footer" valign="middle">
            <p class="f-fallback purchase_total">{{currency($booking->total_price)}}</p>
          </td>
        </tr>
        <tr>
          <td width="80%" class="purchase_footer" valign="middle" colspan="3">
            <p class="f-fallback purchase_total purchase_total--label">GST @18%</p>
          </td>
          <td width="20%" class="purchase_footer" valign="middle">
            <p class="f-fallback purchase_total">{{currency($booking->tax_amount)}}</p>
          </td>
        </tr>
        <tr>
          <td width="80%" class="purchase_footer" valign="middle" colspan="3">
            <p class="f-fallback purchase_total purchase_total--label">Total Amount</p>
          </td>
          <td width="20%" class="purchase_footer" valign="middle">
            <p class="f-fallback purchase_total">{{ $booking->finalAmount() }}</p>
          </td>
        </tr>                
      </table>
    </td>
  </tr>
</table>
<!-- Action -->

<!-- Sub copy -->
@stop