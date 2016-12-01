@extends('mail.mail')

@section('page')
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <h1 style="color: #0a4a8e"> Service appointment change By Customer</h1>
        <tr>
            <td align="center">
                <p style="line-height: 1.5">Dear <span style="color: #0a4a8e">{{$data['user']->f_name}}</span>
                    The appointment that customer made on <span style="color: #0a4a8e">{!! \App\Libs\Helpers\Helper::towfixDateFormat($data['date']) !!}</span> <span style="font-size: 12px; color: #0a4a8e">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$data['date'])->toTimeString()}}</span> has changed the appointment. Please visit
                    <a href="http://towfix.com.au/admin/public/service_requests">Services Page</a> to accept or change the appointment.
                    Regards, ?
                    Team TowFix.
                </p>
            </td>
        </tr>
        </td>
        </tr>
    </table>

@endsection