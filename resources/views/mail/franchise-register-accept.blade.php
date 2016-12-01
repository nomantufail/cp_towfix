@extends('mail.mail')

@section('page')
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <h1 style="color: #0a4a8e">TowFix Franchise Acceptance </h1>
        <tr>
            <td align="center">
                <p style="line-height: 1.5">Dear <span style="color: #0a4a8e">{{$data}}</span>

                    It is with great pleasure to announce that Team TowFix has accepted your request to join Team
                    TowFix. We provide all the training to get our TowFix team maintenance ready but all you need to do is
                    have good attitude towards it.
                    If you want any assistance regarding our services, franchise or anything feel free to <a href="http://towfix.com.au/?page_id=63">Contact Us</a>
                    Thank you and TowFix team is sincerely looking forward to welcoming you as a part of our team.
                    Regards,
                    Team TowFix.</p>
            </td>
        </tr>
        </td>
        </tr>
    </table>

@endsection