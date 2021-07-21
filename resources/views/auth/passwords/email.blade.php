@extends('layouts.app')

@section('content')
    <div class="kt-login__signin">
        <div class="kt-login__head">
            <h3 class="kt-login__title">{{__('Reset Password') }}</h3>
        </div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form class="kt-form" method="POST" action='{{ route('password.email') }}'>
            @csrf
            <div class="input-group">
                <input
                        id="email"
                        type="text"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email"
                        placeholder="{{__('E-Mail Address')}}"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="kt-login__actions">
                <button  class="btn btn-brand btn-elevate kt-login__btn-primary">{{__('Sign In')}}</button>
            </div>
        </form>
    </div>

@endsection
