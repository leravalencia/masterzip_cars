@extends('layouts.app')

@section('content')
    <div class="ink-grid">
        <div class="container">
            <div class="xlarge-33 large-40 medium-60 small-100 tiny-100 top-space push-center">
                <h1 class="align-center">Login</h1>
                <div class="panel-body">
                    <form class="ink-form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="control-group{{ $errors->has('email') ? ' validation error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            <div class="control">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}" autofocus>
                                @if ($errors->has('email'))
                                    <p class="tip">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="control-group{{ $errors->has('password') ? ' validation error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="control">
                                <input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <p class="tip">{{ $errors->first('password') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="control-group">
                            <input type="checkbox"
                                   class="mt_6px"
                                   name="remember"
                                   {{ old('remember') ? 'checked' : '' }}
                                   id="remember">
                            <label for="remember">Remember Me</label>
                        </div>

                        <div class="control-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="ink-button blue">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

