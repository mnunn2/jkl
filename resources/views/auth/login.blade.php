@extends('layouts.app')

@section('content')

    <form class="login" method="POST" action="{{ route('login') }}">
        @csrf
        <h1 class="login-title">Login</h1>

        <input id="email" type="email" name="email" class="login-input" placeholder="Email Address" required autofocus>

        @if ($errors->has('email'))
            <span > <strong>{{ $errors->first('email') }}</strong> </span>
        @endif

        <input id="password" type="password" class="login-input" name="password" placeholder="Password" required>

        @if ($errors->has('password'))
            <span > <strong>{{ $errors->first('password') }}</strong> </span>
        @endif

        <button type="submit" class="login-button" > {{ __('Login') }} </button>

        <p class="login-lost">
            <a  href="{{ route('password.request') }}"> {{ __('Forgot Your Password?') }} </a>
        </p>
        <p class="login-lost">
            <label for="remember"> {{ __('Remember Me') }} </label>
            <input  type="checkbox" name="remember" id="remember">
        </p>

    </form>
@endsection
