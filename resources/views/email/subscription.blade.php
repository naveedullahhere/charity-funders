<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>Welcome to {{config('app.name')}}</title>
    <style type="text/css">
        a:hover {text-decoration: underline !important;}
    </style>
</head>
<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
<!-- 100% body table -->
<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8" style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;">
    <tbody>
    <tr>
        <td>
            <table style="background-color: #f2f3f8; max-width:670px; margin:0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tbody>
                <tr>
                    <td style="height:80px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        <a href="{{url('/')}}" title="{{config('app.name')}}" target="_blank">
                            <img width="250" src="{{url('frontend/assets/logo1-1.png')}}" title="{{config('app.name')}}" alt="{{config('app.name')}}">
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="height:20px;">&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width:670px; background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                            <tbody>
                            <tr>
                                <td style="height:40px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="padding:0 35px;">
                                    <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;">Hi {{$subscription['firstName']}} {{$subscription['lastName']}},</h1>
                                    <p style="font-size:15px; color:#455056; margin:8px 0 0; line-height:24px;">Thank you for subscribing to {{config('app.name')}}!</p>
                                    <p style="font-size:15px; color:#455056; margin:8px 0 0; line-height:24px;">Below are the details of your subscription:</p>

                                    <table style="width: 100%; text-align: left; margin-top: 20px;">
                                        <tr>
                                            <th style="font-size:14px; color:#1e1e2d; font-weight:500; padding: 8px 0;">Field</th>
                                            <th style="font-size:14px; color:#1e1e2d; font-weight:500; padding: 8px 0;">Value</th>
                                        </tr>
                                        <tr>
                                            <td style="font-size:14px; color:#455056; padding: 8px 0;">Job Title</td>
                                            <td style="font-size:14px; color:#455056; padding: 8px 0;">{{$subscription['jobTitle']}}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:14px; color:#455056; padding: 8px 0;">Organisation Name</td>
                                            <td style="font-size:14px; color:#455056; padding: 8px 0;">{{$subscription['organisationName']}}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:14px; color:#455056; padding: 8px 0;">Charity Number</td>
                                            <td style="font-size:14px; color:#455056; padding: 8px 0;">{{$subscription['charityNo'] ?? 'N/A'}}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:14px; color:#455056; padding: 8px 0;">Address</td>
                                            <td style="font-size:14px; color:#455056; padding: 8px 0;">{{$subscription['address']}}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:14px; color:#455056; padding: 8px 0;">Town/City</td>
                                            <td style="font-size:14px; color:#455056; padding: 8px 0;">{{$subscription['townOrcity']}}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:14px; color:#455056; padding: 8px 0;">Post Code</td>
                                            <td style="font-size:14px; color:#455056; padding: 8px 0;">{{$subscription['postCode']}}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:14px; color:#455056; padding: 8px 0;">Email Address</td>
                                            <td style="font-size:14px; color:#455056; padding: 8px 0;">{{$subscription['emailAddress']}}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:14px; color:#455056; padding: 8px 0;">Telephone Number</td>
                                            <td style="font-size:14px; color:#455056; padding: 8px 0;">{{$subscription['telephoneNumber']}}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:14px; color:#455056; padding: 8px 0;">Subscription Type</td>
                                            <td style="font-size:14px; color:#455056; padding: 8px 0;">{{$subscription['subscriptionType'] == 'org' ? 'Organisation' : 'Individual'}}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:14px; color:#455056; padding: 8px 0;">Subscription Amount</td>
                                            <td style="font-size:14px; color:#455056; padding: 8px 0;">£{{number_format($subscription['subscriptionAmount'], 2)}}</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:14px; color:#455056; padding: 8px 0;">Payment Method</td>
                                            <td style="font-size:14px; color:#455056; padding: 8px 0;">{{$subscription['paymentMethod'] == 'card' ? 'Credit/Debit Card' : 'Invoice'}}</td>
                                        </tr>
                                    </table>

                                    <p style="font-size:15px; color:#455056; margin:24px 0 0; line-height:24px;">If you have any questions or concerns, feel free to contact us.</p>
                                    <p style="font-size:15px; color:#455056; margin:8px 0 0; line-height:24px;">Thank you for choosing {{config('app.name')}}!</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="height:40px;">&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="height:20px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">© {{config('app.name')}} <a target="_blank" href="{{url('/')}}" style="color: #7b7b7b;"><strong>{{config('app.name')}}</strong></a> </p>
                    </td>
                </tr>
                <tr>
                    <td style="height:80px;">&nbsp;</td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<!--/100% body table-->
</body>
</html>