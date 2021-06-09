@extends('layouts.app')

@section('content')
    <div class="ink-grid">
        <div class="container">
            <div class="xlarge-33 large-40 medium-60 small-100 tiny-100 top-space push-center">
                <div class="panel panel-default">
                    <h2 class="panel-heading">Register</h2>
                    <div class="panel-body bottom-space">
                        <form class="ink-form" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
                            <div class="control-group{{ $errors->has('name') ? ' validation error' : '' }}">
                                <label for="name" class="control-label">Name</label>
                                <div class="control">
                                    <input id="name"
                                           type="text"
                                           class="form-control"
                                           name="name"
                                           value="{{ old('name') }}"
                                           autofocus>
                                    @if ($errors->has('name'))
                                        <p class="tip">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group{{ $errors->has('last_name') ? ' validation error' : '' }}">
                                <label for="last_name" class="control-label">Last Name</label>
                                <div class="control">
                                    <input id="last_name"
                                           type="text"
                                           class="form-control"
                                           name="last_name"
                                           value="{{ old('last_name') }}"
                                           autofocus>
                                    @if ($errors->has('last_name'))
                                        <p class="tip">{{ $errors->first('last_name') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group {{ $errors->has('email') ? ' validation error' : '' }}">
                                <label for="email" class="control-label">E-Mail Address</label>
                                <div class="control">
                                    <input id="email"
                                           type="email"
                                           class="form-control"
                                           name="email"
                                           value="{{ old('email') }}"
                                           required>
                                    @if ($errors->has('email'))
                                        <p class="tip">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group{{ $errors->has('password') ? ' validation error' : '' }}">
                                <label for="password" class="control-label">Password</label>
                                <div class="control">
                                    <input id="password"
                                           type="password"
                                           class="form-control"
                                           name="password"
                                           required>
                                    @if ($errors->has('password'))
                                        <p class="tip">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="password-confirm" class="control-label">
                                    Confirm Password
                                </label>
                                <div class="control">
                                    <input id="password-confirm"
                                           name="password_confirmation"
                                           type="password"
                                           class="form-control"
                                           required>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="control push-center">
                                    <button type="submit" class="ink-button blue">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
