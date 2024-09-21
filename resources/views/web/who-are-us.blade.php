@extends('web.layout.app')
@section('head')
 @php
   $title="| من نحن";
   $className="who-are-us";
 @endphp
@endsection
@section('content')
  <!--inside-article-->
        <div class="about-us">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">من نحن</li>
                        </ol>
                    </nav>
                </div>
                <div class="details">
                    <div class="logo">
                        <img src="{{asset('storage/setting/')}}/{{$setting->logo}}">
                    </div>
                    <div class="text">
                        {{$setting->description}}
                    </div>
                </div>
            </div>
        </div>

@endsection
