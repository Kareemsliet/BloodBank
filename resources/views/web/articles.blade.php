@extends('web.layout.app')
@section('head')
@php
$title="| المقالات";
$className="donation-requests";
$search=isset($_GET['q'])?$_GET['q']:"";
$category=isset($_GET['category'])?$_GET['category']:"";
@endphp
@endsection
@section('content')
<div class="all-requests">
    <div class="container">
        <div class="path">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('index')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">المقالات</li>
                </ol>
            </nav>
        </div>
        <div class="requests">
            <div class="head-text">
                <h2>المقالات</h2>
            </div>
            <div class="content">
                <form class="row filter" method="GET" action="{{route('articles')}}">
                    <div class="col-md-5 blood">
                        <div class="form-group">
                            <div class="inside-select">
                                <select name='category' class="form-control">
                                    <option selected value="">اختر القسم</option>
                                    @foreach ($categories as $value)
                                    <option @if ($category==$value->name)
                                        @selected(true)
                                        @endif value="{{$value->name}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 blood">
                        <div class="form-group">
                            <div class="inside-select">
                                <input type="text" placeholder="مثال: الوقاية من الامراض" name='q' value="{{$search}}"
                                    class="form-control" />
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 rounded-3" style="width:40px">
                        <button style="display:block;padding:5px;border-radius:50%;cursor:grab" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <div class="articles">
                    <div class="view">
                        <div class="container">
                            <div class="row">
                                <!-- Set up your HTML -->
                                <div class="row d-flex justify-content-center w-100 align-items-center">
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
                                    <div class="d-flex justify-content-center  align-items-center">
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
        </div>
    </div>
</div>
</div>
@endsection