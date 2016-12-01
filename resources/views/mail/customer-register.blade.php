@extends('mail.mail')

@section('page')
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <h1 style="color: #0a4a8e">Welcome Valued customer </h1>
        <tr>
            <td align="center">
                <p style="line-height: 1.5">Dear <span style="color: #0a4a8e">{{$data}}</span>

                    Team Towfix gladly welcome you at becoming a member of team TowFix. Our customers are
                    valued here; we come to you at your convenience. Feel free to login and request for a service, read a
                    manual, view products that are for sale or chat with franchises for assistance.
                    If you want any assistance regarding our services, franchise or anything feel free to contact us <a href="http://towfix.com.au/?page_id=63">Contact Us</a>
                    Thank you and TowFix team is sincerely looking forward to welcoming you as a part of our team.

                    Regards,
                    Team TowFix.
                </p>
            </td>
        </tr>
        </td>
        </tr>
    </table>

@endsection