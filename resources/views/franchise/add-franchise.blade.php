@extends('app')
@section('page')
    <section class="home-page login-page">
        @if(\Session::has('success'))
            <h4 class="alert alert-success fade in">
                {{\Session::get('success')}}
            </h4>
        @endif
        <h2 class="main-heading" style="text-align: center">Franchise Registration</h2>
        <div class="add-vehicle-widget">
            <form class="add-vehicle-form" role="form" method="POST" action="{{url('/')}}/franchise/add">
                {{ csrf_field() }}

                <label class="clearfix {{ $errors->has('name') ? ' has-error' : '' }}">
                    <span>Name</span>
                    <input type="text" name="name" placeholder="Franchise Name" value="{{old('name')}}">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </label>
                <label class="half-field {{ $errors->has('phoneNumber') ? ' has-error' : '' }}">
                    <span>Phone Number</span>
                    <input type="text" name="phone_number" placeholder="Phone Number" value="{{old('phone_number')}}">
                    @if ($errors->has('phone_number'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone_number') }}</strong>
                        </span>
                    @endif
                </label>
                <label class="half-field {{ $errors->has('email') ? ' has-error' : '' }}">
                    <span>Email Address</span>
                    <input type="email" name="email" placeholder="Email Address" value="{{old('email')}}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </label>
                <label class="half-field {{ $errors->has('password') ? ' has-error' : '' }}">
                    <span>Password</span>
                    <input type="password" name="password" placeholder="Password">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </label>
                <label class="half-field {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <span>Confirm Password</span>
                    <input type="password" name="password_confirmation" placeholder="Cunform Password">
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </label>
                <label class="clearfix {{ $errors->has('address') ? ' has-error' : '' }}">
                    <span>Address</span>
                    <input type="text" name="address" placeholder="Address" value="{{old('address')}}">
                    @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </label>
                <label class="clearfix {{ $errors->has('address') ? ' has-error' : '' }}">
                    <span>Area</span>
                    <select name="area" id="area">
                        <option value="South Australia">South Australia</option>
                        <option value="Western Australia">Western Australia</option>
                        <option value="Northern Territory">Northern Territory</option>
                        <option value="New South Wales">New South Wales</option>
                        <option value="Victoria">Victoria</option>
                        <option value="Tasmania">Tasmania</option>
                        <option value="QLD">QLD (Queensland)</option>
                    </select>
                    @if ($errors->has('Area'))
                        <span class="help-block">
                            <strong>{{ $errors->first('Area') }}</strong>
                        </span>
                    @endif
                </label>
                <label class="clearfix">
                    <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPCHA_SITE_KEY')}}"></div>
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block">
                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                    @endif
                </label>
                <label class="submit">
                    <input type="submit" class="btn btn btn-primary" name="submit" value="Submit">
                </label>
            </form>
        </div>

    </section>
    <script>
        $("#area").select2({
            allowClear: true,
            placeholder: "Select Area"

        });

    </script>
@endsection
