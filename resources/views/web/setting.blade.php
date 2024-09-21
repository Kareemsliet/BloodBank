@extends('web.layout.app')
@section('head')
@php
$title="| الاعدادات";
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
        @livewire('settings')
    </div>
</div>
</div>
@endsection
