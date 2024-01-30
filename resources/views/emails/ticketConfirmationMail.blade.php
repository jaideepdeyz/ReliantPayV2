<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<head>
<meta name="viewport" content="width=device-width"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>Reservation Assistance - Ticket Confirmation</title>

</head>

<body style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;"
bgcolor="#f6f6f6">

<table class="body-wrap"
style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;"
bgcolor="#f6f6f6">
<tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;"
    valign="top"></td>
<td class="container" width="600"
    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;"
    valign="top">
    <div class="content"
         style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
        <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope
               itemtype="#"
               style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; margin: 0; border: none;"
               >
            <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                <td class="content-wrap"
                    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;padding: 30px;border: 3px solid #4fc6e1;border-radius: 7px; background-color: #fff;"
                    valign="top">
                    <meta itemprop="name" content="Confirm Email"
                          style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"/>
                    <table width="100%" cellpadding="0" cellspacing="0"
                           style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                        <tr>
                            <td style="text-align: center">
                                <a href="#" style="display: block;margin-bottom: 10px;"> <img src="https://reliant.yellowberry.in/auth/images/adminlogo/admin-logo-light.png" height="80" alt="logo"/></a> <br/>
                            </td>
                        </tr>
                        <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                            <td class="content-block"
                                style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;"
                                valign="top">
                                Dear {{ $mailData['name'] }},

                                <p>Greetings of the Day</p>
                                <p>Kindly find the attached E-ticket for your upcoming travel for the following Passengers:
                                    <ol>
                                        @foreach ($mailData['passengers'] as $passenger)
                                            <li class="text-uppercase">{{ $passenger['full_name'] }} | {{ $passenger['gender'] }} | {{Carbon\Carbon::parse($passenger['dob'])->format('F j, Y')}} </li>
                                        @endforeach
                                    </ol>
                                </p>
                                <p>Kindly acknowledge the receipt of this email by replying "I Received" to this email.</p>

                                <p>We value your business and look forward to serving your travel needs in the future.
                                </p>

                                <p>Please feel free to call us at 844-314-1008 or write to us at <a href="mailto:support@reliantpay.com">support@reliantpay.com</a> if any information is needed.</p>

                                <p>Thanks & Regards,</p>
                                <p>{{ $mailData['agent']}}</p>
                                <p>844-314-1008</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        {{-- <div class="footer"
             style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">
            <table width="100%"
                   style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                    <td class="aligncenter content-block"
                        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;"
                        align="center" valign="top"><a href="#"
                                                       style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0;">Unsubscribe</a>
                    </td>
                </tr>
            </table>
        </div> --}}
    </div>
</td>
<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;"
    valign="top"></td>
</tr>
</table>
</body>
</html>
