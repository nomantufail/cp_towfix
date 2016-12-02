@extends('mail.mail')

@section('page')
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <h1 style="color: #0a4a8e">TowFix Franchise Request </h1>
        <tr>
            <td align="center">
                <p style="line-height: 1.5">Dear <span style="color: #0a4a8e">{{$data}}</span>,
                    Thank you for requesting at Towfix to become a franchise. Your request has been forwarded to
                    TowFix admin, as soon as your request is approved, you will receive an email of confirmation.
                    If you want any assistance regarding our services, franchise or anything feel free to <a href="http://towfix.com.au/?page_id=63">Contact Us</a>
                    Thank you and TowFix team is sincerely looking forward to having you having you as a part of our team.


                    Regards,
                    Team TowFix. </p>
            </td>
        </tr>
        </td>
        </tr>
    </table>

@endsection