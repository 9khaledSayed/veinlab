@extends('layouts.app')
@section('content')
<div class="signup">
    <div class="kt-login__head">
        <h3 class="kt-login__title">{{ isset($url) ? ucwords($url) : ""}} Sign Up</h3>
        <div class="kt-login__desc">Enter your details to create your account:</div>
    </div>
        @isset($url)
            <form class="kt-form" method="POST" action='{{ url("register/$url") }}' aria-label="{{ __('Register') }}">
        @else
            <form class="kt-form" method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
        @endisset
                @csrf
        <div class="input-group">
            <input
                id="name"
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                name="name"
                value="{{ old('name') }}"
                required
                placeholder="FullName"
                autocomplete="name"
                autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="input-group">
            <input
                id="email"
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                name="email"
                value="{{ old('email') }}"
                placeholder="Email"
                required
                autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="input-group">
            <input
                id="password"
                type="password"
                class="form-control @error('password') is-invalid @enderror"
                name="password"
                placeholder="Password"
                required
                autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="input-group">
            <input
                id="password-confirm"
                type="password"
                class="form-control"
                name="password_confirmation"
                placeholder="Confirm Password"
                required
                autocomplete="new-password">
        </div>
        <div class="row kt-login__extra">
            <div class="col kt-align-left">
                <label class="kt-checkbox">
                    <input type="checkbox" name="agree">I Agree the <a href="#" class="kt-link kt-login__link kt-font-bold">terms and conditions</a>.
                    <span></span>
                </label>
                <span class="form-text text-muted"></span>
            </div>
        </div>
        <div class="kt-login__actions">
            <button type="submit" class="btn btn-brand btn-elevate kt-login__btn-primary">Sign Up</button>&nbsp;&nbsp;
            <a href="{{url("login/$url")}}" class="btn btn-light btn-elevate kt-login__btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
