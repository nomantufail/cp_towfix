@extends('mail.mail')

@section('page')
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <h1 style="color: #0a4a8e">Service appointment change</h1>
        <tr>
            <td align="center">
                <p style="line-height: 1.5">Dear <span style="color: #0a4a8e">{{ $data['name'] }}</span>

                    You made an appointment for a service on <span style="color: #0a4a8e">{!! \App\Libs\Helpers\Helper::towfixDateFormat($data['date']) !!}</span> <span style="font-size: 12px;color: #0a4a8e">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$data['date'])->toTimeString()}}</span> , we are sorry to inform you that the franchise
                    you made an appointment for a service will not be available at that time. We know that you are valuable
                    to us thus the franchise has proposed a new time and date for service, please visit the <a href="http://towfix.com.au/admin/public/service_requests">Services Page</a> to accept the proposal or to propose a new appointment. You can always change the
                    appointment for we come at your convenience.
                    If you want any assistance regarding our services, franchise or anything feel free to <a href="http://towfix.com.au/?page_id=63">Contact Us</a>
                    Thank you and TowFix team is sincerely looking forward to welcoming you for the service.

                    Regards,
                    Team TowFix.
                </p>
            </td>
        </tr>
        </td>
        </tr>
    </table>

@endsection