@extends('web.layout.app')
@section('head')
 @php
   $title="| تواصل معنا";
   $className="contact-us";
 @endphp
@endsection
@section('content')
<div class="contact-now">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">تواصل معنا</li>
                        </ol>
                    </nav>
                </div>
                @session('message')
                <div class="alert alert-success mt-3">
                    {{$value}}
                </div>
                @endsession
                <div class="row methods">
                    <div class="col-md-6">
                        <div class="call">
                            <div class="title">
                                <h4>اتصل بنا</h4>
                            </div>
                            <div class="content">
                                <div class="logo">
                                    <img src="{{asset('storage/setting/')}}/{{$setting->logo}}">
                                </div>
                                <div class="details">
                                    <ul>
                                        <li><span>الجوال:</span>{{$setting->phone}}</li>
                                        <li><span>البريد الإلكترونى:</span>{{$setting->email}}</li>
                                    </ul>
                                </div>
                                <div class="social">
                                    <h4>تواصل معنا</h4>
                                    <div class="icons" dir="ltr">
                                        @if ($setting->facebook_link)
                                        <div class="out-icon">
                                            <a href="{{$setting->facebook_link}}" class="facebook">
                                                <img src="{{asset('web/imgs/001-facebook.svg')}}">
                                            </a>
                                        </div>
                                        @endif
                                        @if ($setting->twitter_link)
                                        <a href="{{$setting->twitter_link}}"  class="twitter">
                                            <img src="{{asset('web/imgs/002-twitter.svg')}}">
                                        </a>
                                        @endif
                                        @if ($setting->yotube_link)
                                        <a href="{{$setting->yotube_link}}" class="whatsapp">
                                            <img src="{{asset('web/imgs/003-youtube.svg')}}">
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-form">
                            <div class="title">
                                <h4>تواصل معنا</h4>
                            </div>
                            <div class="fields">
                                <form method="POST" enctype="multipart/form-data" action="{{route('contact.request')}}">
                                    @csrf
                                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="البريد الإلكترونى" value="{{old('email')}}" name="email">
                                    @error('email')
                                    <div style="font-size:16px;color:red">{{$message}}</div>
                                    @enderror
                                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="الجوال" value="{{old('phone')}}" name="phone">
                                    @error('phone')
                                    <div style="font-size:16px;color:red">{{$message}}</div>
                                    @enderror
                                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="عنوان الرسالة" value="{{old('title')}}" name="title">
                                    @error('title')
                                    <div style="font-size:16px;color:red">{{$message}}</div>
                                    @enderror
                                    <textarea placeholder="نص الرسالة" name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" >{{old('description')}}</textarea>
                                    @error('description')
                                    <div style="font-size:16px;color:red">{{$message}}</div>
                                    @enderror
                                    <button type="submit">ارسال</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
