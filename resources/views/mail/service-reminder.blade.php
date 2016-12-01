@extends('mail.mail')

@section('page')
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <h1 style="color: #0a4a8e">TowFix Service Reminder </h1>
        <tr>
            <td align="center">
                <p style="line-height: 1.5">Dear <span style="color: #0a4a8e">{{$data['user']->f_name}}</span>
                    Recognizing your very busy schedule, Towfix team is sending you this note as a reminder that your
                    vehicles service is due on <span style="color: #0a4a8e">{!! \App\Libs\Helpers\Helper::towfixDateFormat($data['date']) !!}</span> <span style="font-size: 12px; color: #0a4a8e">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$data['date'])->toTimeString()}}</span>. Please book a service <a href="http://towfix.com.au/admin/public/service_request/create">Request a Service</a> at your convenience
                    at any of our franchises. We would love to have you here at TowFix.?
                    If you want any assistance regarding our services, franchise or anything feel free to <a href="http://towfix.com.au/?page_id=63">Contact Us</a>

                    Thank you and TowFix team is sincerely looking forward to having you at any of our franchises.
                    Regards,
                    Team TowFix.</p>
            </td>
        </tr>
        </td>
        </tr>
    </table>

@endsection