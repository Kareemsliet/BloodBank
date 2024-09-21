
@extends('web.layout.app')
@section('head')
 @php
   $title="| تسجيل دخول";
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
                            <li class="breadcrumb-item active" aria-current="page">تسجيل الدخول</li>
                        </ol>
                    </nav>
                </div>
                <div class="signin-form">
                    <form method="POST" action="{{route('client.request')}}" >
                        @csrf
                        <div class="logo">
                            <img src="{{asset('web/imgs/logo.png')}}">
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" value="{{old('email')}}" class="form-control"   placeholder="البريد الاكتروني">
                            @error('email')
                            <div style="font-size:16px;color:red">{{$message}}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <input type="password"  name="password" class="form-control" placeholder="كلمة المرور">
                            @error('password')
                            <div style="font-size:16px;color:red">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="row options">
                            <div class="col-md-6 remember">
                                <div class="form-group form-check">
                                    <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">تذكرنى</label>
                                </div>
                            </div>
                            <div class="col-md-6 forgot">
                                <img src="{{asset('web/imgs/complain.png')}}">
                                <a href="{{route('client.forget.password')}}">هل نسيت كلمة المرور</a>
                            </div>
                        </div>
                        <div class="row buttons">
                            <div class="col-md-6 right">
                                <button type="submit">دخول</button>
                            </div>
                            <div class="col-md-6 left">
                                <a href="{{route('client.register')}}">انشاء حساب جديد</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
