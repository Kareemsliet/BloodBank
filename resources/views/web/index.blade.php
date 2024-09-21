@extends('web.layout.app')
@section('head')
 @php
   $title="";
   $className="";
 @endphp
@endsection

@section('content')
        <div class="intro">
            <div id="slider" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach ($heros as $key=>$value)
                    <li data-target="#slider" data-slide-to="{{$key}}" ></li>
                    @endforeach

                </ol>
                <div class="carousel-inner">
                 @foreach ($heros as $key=>$value)
                    <div class="carousel-item" id="carousel-{{$key}}" style="background-image:url('{{asset('uploads/heros/')}}/{{$value->image}}')">
                        <div class="container info">
                            <div class="col-lg-5">
                                <h3>{{$value->title}}</h3>
                                <p>
                                    {{$value->des}}
                                </p>
                            </div>
                        </div>
                    </div>
                  @endforeach
                </div>
            </div>
        </div>

        <!--about-->
        <div class="about">
            <div class="container">
                <div class="col-lg-6 text-center">
                    <p>
                        <span>{{$setting->name}}</span>
                        <br/>
                        {{$setting->description}}
                    </p>
                </div>
            </div>
        </div>

        <!--articles-->
        <div class="articles">
            <div class="container title">
                <div class="head-text">
                    <h2>المقالات</h2>
                </div>
            </div>
            <div class="view">
                <div class="container">
                    <div class="row">
                        <!-- Set up your HTML -->
                        <div class="owl-carousel articles-carousel">
                           @foreach ($articles as $value)
                           <div class="card">
                            <div class="photo">
                                <img src="{{asset('uploads/articles/')}}/{{$value->image}}" class="card-img-top" alt="...">
                                <a href="{{route('article',implode('-',explode(' ',$value->title)))}}" class="click">المزيد</a>
                            </div>

                            @auth('clients')
                            @livewire('like-button',['article_id'=>$value->id])
                            @endauth

                            <div class="card-body">
                                <h5 class="card-title">{{$value->title}}</h5>
                                <p class="card-text">
                                    {{$value->description}}
                                </p>
                            </div>
                        </div>
                           @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--requests-->
        <livewire:Donations>

        <!--contact-->
        <div class="contact">
            <div class="container">
                <div class="col-md-7">
                    <div class="title">
                        <h3>اتصل بنا</h3>
                    </div>
                    <p class="text">يمكنك الإتصال بنا للإستفسار عن معلومة وسيتم الرد عليكم</p>
                    <div class="row whatsapp">
                        <a href="#">
                            <img src="{{asset('web/imgs/whats.png')}}">
                            <p dir="ltr">+20 {{$setting->phone}}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!--app-->
        <div class="app">
            <div class="container">
                <div class="row">
                    <div class="info col-md-6">
                        <h3>{{$setting->name}}</h3>
                        <p>
                            {{$setting->description}}
                        </p>
                        <div class="download">
                            <h4>متوفر على</h4>
                            <div class="row stores">
                                <div class="col-sm-6">
                                    <a href="#">
                                        <img src="{{asset('web/imgs/google.png')}}">
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="#">
                                        <img src="{{asset('web/imgs/ios.png')}}">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="screens col-md-6">
                        <img src="{{asset('web/imgs/App.png')}}">
                    </div>
                </div>
            </div>
        </div>
@endsection
