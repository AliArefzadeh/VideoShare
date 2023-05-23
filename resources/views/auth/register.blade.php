{{--
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>


--}}


@extends('auth-layout')
@section('class-body','sing-up-page')
@section('content')
    <!--======= log_in_page =======-->
    <div id="log-in" class="site-form log-in-form">

        <div id="log-in-head">
            <h1>ثبت نام</h1>
            <div id="logo"><a href="{{route('index')}}"><img src="{{asset('img/logo.png')}}" alt=""></a></div>
        </div>

        <div class="form-output">
<x-validation-errors> </x-validation-errors>
            <form method="POST" action="{{ route('register.store') }}">
                @csrf
                <div class="form-group label-floating">
                    <label class="control-label">نام</label>
                    <input class="form-control" placeholder="" type="text" name="name">
                </div>

                <div class="form-group label-floating">
                    <label class="control-label">ایمیل</label>
                    <input class="form-control" placeholder="" type="email" name="email">
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">رمز عبور</label>
                    <input class="form-control" placeholder="" type="password" name="password">
                </div>

                <div class="form-group label-floating">
                    <label class="control-label">تأیید رمز عبور</label>
                    <input class="form-control" placeholder="" type="password" name="password_confirmation">
                </div>

                <div class="remember">
                    <div class="checkbox">
                        <label>
                            <input name="remember" type="checkbox">
                            مرا به خاطر بسپار
                        </label>
                    </div>
                </div>
<button type="submit" class="btn btn-lg btn-primary full-width">ثبت نام</button>
                <div class="or"></div>
                <p> شما یک حساب کاربری دارید؟<a href="{{route('login.create')}}"></a></p>

            </form>
        </div>
    </div>
    <!--======= // log_in_page =======-->
@endsection



