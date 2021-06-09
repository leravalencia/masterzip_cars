@extends('layouts.app')

@section('content')
    <div class="ink-grid">
        <div class="container">
            <div class="xlarge-33 large-40 medium-60 small-100 tiny-100 top-space push-center">
                <h2 class="panel-heading">Reset Password</h2>
                <form class="ink-form" method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="control-group{{ $errors->has('email') ? ' validation error' : '' }}">
                        <label for="email">E-Mail Address</label>
                        <div class="control">
                            <input id="email" type="email" class="form-control" name="email"
                                   value="{{ $email or old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <p class="tip">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="control-group{{ $errors->has('password') ? ' validation error' : '' }}">
                        <label for="password">Password</label>
                        <div class="control">
                            <input id="password" type="password" class="form-control" name="password" required>
                            @if ($errors->has('password'))
                                <p class="tip">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="control-group{{ $errors->has('password_confirmation') ? ' validation error' : '' }}">
                        <label for="password-confirm">Confirm Password</label>
                        <div class="control">
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required>
                            @if ($errors->has('password_confirmation'))
                                <p class="tip">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control col-md-offset-4">
                            <button type="submit" class="ink-button blue">
                                Reset Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
