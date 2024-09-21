@extends('web.layout.app')
@section('head')
 @php
   $title="| مقالات";
   $className="article-details";
 @endphp
@endsection
@section('content')
<div class="inside-article">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="#">المقالات</a></li>
                            <li class="breadcrumb-item active" aria-current="page">الوقاية من الأمراض</li>
                        </ol>
                    </nav>
                </div>
                <div class="article-image">
                    <img src="{{asset('uploads/articles/')}}/{{$article->image}}">
                </div>
                <div class="article-title col-12">
                    <div class="h-text col-6">
                        <h4>{{$article->title}}</h4>
                    </div>
                    <div class="icon col-6">
                        @auth('clients')
                        @livewire('like-button',['article_id'=>$article->id])
                        @endauth
                    </div>
                </div>

                <!--text-->
                <div class="text">
                    <p>
                        {{$article->description}}
                    </p>
                </div>

                <!--articles-->
                <div class="articles">
                    <div class="title">
                        <div class="head-text">
                            <h2>مقالات ذات صلة</h2>
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
            </div>
        </div>

@endsection
