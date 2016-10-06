@extends('app')

@section('page')
    <section class="home-page login-page">
        <div class="add-vehicle-widget">
            <form class="add-vehicle-form" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <label class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <span>User Name</span>
                    <input type="text" name="email" placeholder="Email"  value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </label>
                <label class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <span>Password</span>
                    <input type="password" name="password" placeholder="Password">
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </label>
                <label class="submit">
                    <input type="submit" class="btn btn btn-primary" name="submit" value="Submit">
                    <a class="btn btn-link" href="{{ url('/password/reset') }}">
                        Forgot Your Password?
                    </a>
                </label>
            </form>
        </div>
    </section>
@endsection
