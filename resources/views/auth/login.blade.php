@extends('layouts.app')
@section('content')
    <div class="kt-login__signin">
        <div class="kt-login__head">
                <h3 class="kt-login__title">{{__('Sign In ' . (isset($url) ?ucwords($url) : "")) }}</h3>
        </div>

        @isset($url)
            <form class="kt-form" method="POST" action='{{ url("login/$url") }}'>
                @else
                    <form class="kt-form" method="POST" action="{{ route('login') }}">
                        @endisset
                        @csrf
                        <div class="input-group">
                            @if($url == 'employee' || $url == 'hospital')
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="{{__('Email')}}"
                                    required
                                    autocomplete="email"
                                    autofocus>
                            @else
                                <input
                                    id="id_no"
                                    type="text"
                                    class="form-control @error('id_no') is-invalid @enderror"
                                    name="id_no"
                                    value="{{ old('id_no') }}"
                                    placeholder="{{__('ID Number')}}"
                                    required
                                    autofocus>
                            @endif
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
                                placeholder="{{__('Password')}}"
                                required
                                autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                        </div>
                        <div class="row kt-login__extra">
                            <div class="col">
                                <label class="kt-checkbox">
                                    <input
                                        type="checkbox"
                                        name="remember"
                                        id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>{{__('Remember me')}}
                                </label>
                            </div>
                            <div class="col kt-align-right">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" id="kt_login_forgot" class="kt-login__link">
                                        {{__('Forget Password ?')}}</a>
                                @endif
                            </div>
                        </div>
                        <div class="kt-login__actions">
                            <button  class="btn btn-brand btn-elevate kt-login__btn-primary">{{__('Sign In')}}</button>
                        </div>
                    </form>
    </div>
@endsection
