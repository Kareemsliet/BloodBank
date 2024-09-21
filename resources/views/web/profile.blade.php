@extends('web.layout.app')
@section('head')
@php
$title="| الحساب الشخصي";
$className="donation-requests";
@endphp
@endsection
@section('content')
<div class="all-requests">
    <div class="container">
        <div class="path">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('index')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">الاعدادات</li>
                </ol>
            </nav>
        </div>
        <div>
            <div class="requests" id="favourites">
                <div class="head-text">
                    <h2>المفضلة </h2>
                </div>
                <div class="articles">
                    <div class="view">
                        <div class="container">
                            <div class="row">
                                <!-- Set up your HTML -->
                                <div class="row d-flex justify-content-center align-items-center w-100">
                                    @forelse ($articles as $value)
                                    <div class="card col-4">
                                        <div class="photo">
                                            <img src="{{asset('uploads/articles/')}}/{{$value->image}}"
                                                class="card-img-top" alt="...">
                                            <a href="{{route('article',implode('-',explode(' ',$value->title)))}}"
                                                class="click">المزيد</a>
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
                                    @empty
                                    <div class="d-flex justify-content-center  align-items-center"  >
                                        <p class="fs-1">لاتوجد بيانات !</p>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pages">
                    {{$articles->onEachSide(5)->links()}}
                </div>
            </div>
          @livewire('notifications')
        </div>
    </div>
</div>
</div>
@endsection
