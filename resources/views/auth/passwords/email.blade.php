@extends('layouts.app')

@section('content')
    <div class="ink-grid">
        <div class="container">
            <div class="xlarge-33 large-40 medium-60 small-100 tiny-100 top-space push-center">
                <div class="panel panel-default">
                    <h2 class="panel-heading">Reset Password</h2>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif

                        <form class="ink-form" method="POST" action="{{ route('password.email') }}">
                            {{ csrf_field() }}

                            <div class="control-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">E-Mail Address</label>

                                <div class="control">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <p class="tip">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </p>
                                    @endif
                                </div>
                            </div>

                            <div class="control-group">
                                <div class="control">
                                    <button type="submit" class="ink-button blue">
                                        Send Password Reset Link
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
