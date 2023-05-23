@extends('auth-layout')
@section('content')
    <div id="log-in" class="site-form log-in-form">

        <div id="log-in-head">
            <h1>تاییدیه ایمیل</h1>
            <div id="logo"><a href="{{route('index')}}"><img src="img/logo.png" alt=""></a></div>
        </div>

        <div class="mb-4 text-sm text-grey600" style="padding:10px">
            با تشکر از شما ثبت نام شما, ایمیل تاییدیه برای شما ارسال شده است, جهت استفاده از تمامی امکانات سایت نیاز است که ایمیل خود رو تایید نمایید
        </div>

        <div class="form-output">
            <x-validation-errors></x-validation-errors>
            <form action="{{route('verification.send')}}" method="post">
                @csrf
                <button type="submit" class="btn btn-lg btn-primary full-width">ارسال دوباره ایمیل</button>
            </form>
        </div>

    </div>
@endsection






















{{--
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Resend Verification Email') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
--}}
