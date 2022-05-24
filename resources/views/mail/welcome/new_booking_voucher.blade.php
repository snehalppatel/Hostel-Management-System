<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Booking #{{ $booking->id }} - {{ $booking->status }} Voucher from {{ setting('core::site-name') }}</title>
<style type="text/css">
a:hover { color: #09F !important; text-decoration: underline !important; }
body {
    font-size: 12px;
}
</style>
</head>
<body style="margin: 0px; background-color: #ffffff; background-image: url({{ Theme::url('img/bg-venue.png') }}); background-repeat: repeat;" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0" bgcolor="#ffffff">
<!--100% body table-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            <!--top links-->
            <table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td valign="top" height="20"></td>
                </tr>
                <tr>
                    <td height="60"style="text-align:center;" valign="top">
                        <p style="font-size: 12px; font-family: Georgia, 'Times New Roman', Times, serif; margin: 0px; padding: 0px; color: #333;">You're receiving this booking voucher from
                            <a style="color: #1c5584; text-decoration: underline;" href="{{ route('homepage') }}">{{ setting('core::site-name') }}</a> booking system
                            .
                            <br/>Having trouble reading this email?
                            <a style="color: #1c5584; font-size: 12px; font-family: Georgia, Times New Roman, Times, serif; margin: 0px; padding: 0px; text-decoration: underline;" href="#">View it in your browser.</a>
                        </p>
                        <p style="text-align:center; font-weight: bold;">
                            Status:
                            <font color="{{ (($booking->status == 'UNPAID') ? 'red' : 'green') }}">{{ $booking->status }}</font>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td height="80" valign="top">
                        <h1 style="font-size: 58px; font-family: Georgia, 'Times New Roman', Times, serif; margin: 0px; padding: 0px; color: #1c5584; font-weight: normal;">{{ setting('core::site-name') }}</h1>
                    </td>
                </tr>
            </table>
            <!--/top links-->
            <!--top intro-->
            <table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="620">
                        <table width="620" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <p style="font-size: 14px; font-family: Georgia, 'Times New Roman', Times, serif; margin: 0px; padding: 0px; color: #333; font-style: italic;">

                                        Namaste!<br />
                                        <br />
                                        Thank you for choosing to attend the SOGOG 2021 Conference. We are glad to inform you that, your participation has been confirmed with us and details of which are mentioned below.<br />
                                        <br />
                                        <strong>As per the Tent City rule</strong>, For all guests coming to the tent city, <strong style="color: #cc0000;">a valid photo IDs proof </strong><strong><span style="color: #cc0000; font-family: Verdana; font-size: small; line-height: 20.7999992370605px;">of each and every participant</span></strong><strong style="color: #cc0000;">&nbsp;is must</strong> ( PAN Card is not valid! ). <strong>We reserve the rights to deny admission of any participant coming to the conference without valid photo ID proof.</strong><br />
                                        <br />
                                        Please review this information to ensure your understanding is the same as ours.</font>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!--/top intro-->
            <!--email content-->
            <table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="40"></td>
                </tr>
                <tr>
                    <td style="background-color: #f1f1f1; border-radius: 6px; -moz-border-radius: 6px; -webkit-border-radius: 6px; -khtml-border-radius: 6px;">
                        <table width="100%" border="1" cellspacing="0" cellpadding="20">
                            <tr>
                                <th valign="top">Booking ID</th>
                                <td valign="top">{{ $booking->id }}</td>
                            </tr>
                            <tr>
                                <th valign="top">Package</th>
                                <td valign="top">{{ $booking->package->name }}</td>
                            </tr>                            
                            <tr>
                                <th valign="center">Guest Details</th>
                                <td valign="top">
                                    @foreach($booking->participants as $p => $__participant)   
                                    <p align="left">
                                    <strong>{{ $__participant->name }}</strong><br/>
                                    Participant Type: {{ $__participant->type }}<br/>
                                    @if($__participant->doctory_reg_no !='')
                                    Doctory Reg#: {{ $__participant->doctory_reg_no }}<br/>
                                    @endif
                                    @if($__participant->society !='')
                                    Society: {{ $__participant->society }}<br/>
                                    @endif
                                    @if($__participant->institution_name !='')
                                    Institution Name: {{ $__participant->institution_name }}<br/>
                                    @endif
                                    @if($__participant->college_name !='')
                                    Collage Name#: {{ $__participant->college_name }}<br/>
                                    @endif
                                    @if($__participant->department !='')
                                    Department: {{ $__participant->department }}<br/>
                                    @endif
                                    @if($__participant->college_id_proof !='')
                                    Collage ID: {{ $__participant->college_id_proof }}<br/>
                                    @endif
                                    Age: {{ $__participant->age }}<br/>
                                    Proof Type: {{ $__participant->id_proof_type }}<br/>
                                    Id No.: {{ $__participant->id_proof }}<br/>
                                    Address: {{ $__participant->address }} <br/>
                                    Email: {{ $__participant->email }}<br/>
                                    Mobile: {{ $__participant->mobile }}
                                    </p>
                                    <hr>
                                @endforeach                                    
                                </td>
                            </tr>
                            <tr>
                                <th valign="top">No. of Guests</th>
                                <td valign="top">{{ $booking->participants()->count() }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="40">&nbsp;</td>
                </tr>
            </table>
            <!--/email content-->

            <!--footer-->
            <table style="background-color: #f1f1f1; border-radius: 6px; -moz-border-radius: 6px; -webkit-border-radius: 6px; -khtml-border-radius: 6px;" width="620" border="0" align="center" cellpadding="20" cellspacing="0">
                <tr>
                    <td valign="top">
                        <p style="font-size: 16px; font-family: Georgia, 'Times New Roman', Times, serif; margin-bottom: 10px; margin-top: 0; padding: 0px; color: #1c5584; font-weight: bold; font-style:italic;">Must Read Links</p>

                        <p style="font-size: 12px; font-family: Georgia, 'Times New Roman', Times, serif; margin-bottom: 10px; margin-top: 0; padding: 0px; color: #333;">
                            <a href="{{ route('page','terms-and-conditions') }}">Terms &amp; Conditions</a>
                        </p>
                        <p style="font-size: 12px; font-family: Georgia, 'Times New Roman', Times, serif; margin-bottom: 10px; margin-top: 0; padding: 0px; color: #333;">
                            <a href="{{ route('page','booking-policy') }}">Booking Policies</a>
                        </p>
                    </td>
                    <td valign="top">
                        <p style="font-size: 16px; font-family: Georgia, 'Times New Roman', Times, serif; margin-bottom: 10px; margin-top: 0; padding: 0px; color: #1c5584; font-weight: bold; font-style:italic;">Contact us</p>
                        <p style="font-size: 12px; font-family: Georgia, 'Times New Roman', Times, serif; margin-bottom: 10px; margin-top: 0; padding: 0px; color: #333;">
                            Email: {!! setting('sogog::email') !!}
                            <br>
                            Phone: {!! setting('sogog::mobile_no') !!}                            
                        </p>
                    </td>
                </tr>
            </table>
            <!--/footer-->
        </td>
    </tr>
    <tr>
        <td style="background-color: #ffffff; background-image: url({{ Theme::url('img/bg-venue.png') }}); background-position: center; background-repeat: no-repeat;" height="147">&nbsp;</td>
    </tr>
</table>
<!--/100% body table-->
</body>
</html>
