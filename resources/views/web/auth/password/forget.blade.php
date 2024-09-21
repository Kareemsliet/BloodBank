@extends('web.layout.app')
@section('head')
@php
$title="| تغيير كلمة المرور";
$className="signin-account";
@endphp
@endsection
@section('content')
<div class="form">
    <div class="container">
        <div class="path">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('index')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">تغيير كلمة المرور</li>
                </ol>
            </nav>
        </div>
        <div class="signin-form">
            <form method="POST" action="{{route('client.request.phone')}}">
                @csrf
                <div class="logo">
                    <img src="{{asset('web/imgs/logo.png')}}">
                </div>
                <div class="form-group">
                    <input type="text" name="email" value="{{old('email')}}" class="form-control"
                        placeholder="البريد الاكتروني">
                    @error('email')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>

                @session("status")
                <div class="form-group">
                    <div style="font-size:16px;color:green">{{$value}}</div>
                </div>
                @endsession

                <div class="row buttons d-flex justify-content-center">
                    <div class="col-md-6">
                        <button type="submit">ارسال</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
