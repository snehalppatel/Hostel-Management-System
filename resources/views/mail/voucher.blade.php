@extends('sogog::mail.layouts.email-master')

@section('content')

<h1>Hi {{$participant->full_name}},</h1>
  <p>
    Namaste!<br />
    <br />
    Thank you for choosing to attend the SOGOG 2021 Conference. We are glad to inform you that, your participation has been confirmed with us and details of which are mentioned below.<br />
    <br />
    <strong>As per the Tent City rule</strong>, For all guests coming to the tent city, <strong style="color: #cc0000;">a valid photo IDs proof </strong><strong><span style="color: #cc0000; font-family: Verdana; font-size: small; line-height: 20.7999992370605px;">of each and every participant</span></strong><strong style="color: #cc0000;">&nbsp;is must</strong> ( PAN Card is not valid! ). <strong>We reserve the rights to deny admission of any participant coming to the conference without valid photo ID proof.</strong><br />
    <br />
    Please review this information to ensure your understanding is the same as ours.
  </p>

<table class="purchase" style="padding: 0px;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
  <tr>
    <td>
      <h3 style="color: blue;">Date: {{ $booking->created_at->format('d-m-Y') }}
        <Br><Br><Br>
        Booking ID: {{$booking->bookingid}}
        <br>
        Participant ID: {{$participant->participantid}}        
      </h3></td>

    <td  style="text-align: right;">
        {!! QrCode::size(150)->generate($booking->qrCodeData()); !!}
    </td>
  </tr>

<!--   <tr>
    <td>
      <h3 style="color: blue;">Booking ID: {{$booking->id}}</h3></td>
    <td>
      <h3 class="align-right">Date: {{ carbon($booking->created_at)->format('d-m-Y')}}</h3></td>
  </tr> -->
  <tr>
    <td colspan="2">
      <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <th class="purchase_heading" align="left">
            <p class="f-fallback">Name</p>
          </th>
          <th class="purchase_heading" align="left">
            <p class="f-fallback">Type</p>
          </th>
          <th class="purchase_heading" align="left">
            <p class="f-fallback">Age</p>
          </th>          
          <th class="purchase_heading" align="right">
            <p class="f-fallback">Amount</p>
          </th>
        </tr>
        @foreach($participants as $get_participant)
        <tr>
          <td width="45%" class="purchase_item"><span class="f-fallback">{{$get_participant->full_name}}</span></td>          
          <td width="25%" class="purchase_item"><span class="f-fallback">{{$get_participant->type}}</span></td>                     
          <td width="10%" class="purchase_item"><span class="f-fallback">{{$get_participant->age}}</span></td>
          <td class="align-right" width="20%" class="purchase_item"><span class="f-fallback">{{currency($get_participant->cost)}}</span></td>
        </tr>
        @endforeach
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
            <p class="f-fallback purchase_total purchase_total--label">Convenient Charge</p>
          </td>
          <td width="20%" class="purchase_footer" valign="middle" align="right">
            <p class="f-fallback purchase_total">{{currency($booking->getConvenientAmount())}}</p>
          </td>
        </tr>
        <tr>
          <td width="80%" class="purchase_footer" valign="middle" colspan="3">
            <p class="f-fallback purchase_total purchase_total--label">Total Amount</p>
          </td>
          <td width="20%" class="purchase_footer" valign="middle">
            <p class="f-fallback purchase_total">{{ currency($booking->taxableAmount()) }}</p>
          </td>
        </tr>                
      </table>
    </td>
  </tr>
</table>
<!-- Action -->

<!-- Sub copy -->
@stop
