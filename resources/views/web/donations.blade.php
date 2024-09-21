@extends('web.layout.app')
@section('head')
@php
$title="| التبرعات";
$className="donation-requests";
$state=isset($_GET['state'])?$_GET['state']:"";
$blood_type=isset($_GET['blood_type'])?$_GET['blood_type']:"";
@endphp
@endsection
@section('content')
<div class="all-requests">
    <div class="container">
        <div class="path">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">طلبات التبرع</li>
                </ol>
            </nav>
        </div>
        <div class="requests">
            <div class="head-text">
                <h2>طلبات التبرع</h2>
            </div>
            <div class="content">
                <form class="row filter" method="GET" action="{{route('donations')}}">
                    <div class="col-md-5 blood">
                        <div class="form-group">
                            <div class="inside-select">
                                <select name='blood_type' class="form-control">
                                    <option selected value="">اختر فصيلة الدم</option>
                                    @foreach ($blood_types as $value)
                                    <option @if ($blood_type==$value->name)
                                        @selected(true)
                                     @endif value="{{$value->name}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 city">
                        <div class="form-group">
                            <div class="inside-select">
                                <select class="form-control" name='state'>
                                    <option selected value="">اختر اامحافظة</option>
                                    @foreach ($states as $value)
                                    <option @if ($state==$value->name)
                                        @selected(true)
                                     @endif value="{{$value->name}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 rounded-3" style="width:40px">
                        <button style="display:block;padding:5px;border-radius:50%;cursor:grab" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <div class="patients">
                    @forelse ($donations as $value)
                    <div class="details">
                        <div class="blood-type">
                            <h2 dir="ltr">{{$value->bloodTypes->name}}</h2>
                        </div>
                        <ul>
                            <li><span>اسم الحالة:</span>{{$value->name}}</li>
                            <li><span>مستشفى:</span>{{$value->hospital_adress}}</li>
                            <li><span>المدينة:</span>{{$value->city->name}}</li>
                        </ul>
                        <a href="{{route('donation',$value->id)}}">التفاصيل</a>
                    </div>
                    @empty
                    <div class="d-flex justify-content-center align-items-center">
                        <p class="fs-1">لاتوجد بيانات !</p>
                    </div>
                    @endforelse
                </div>
                <div class="pages">
                    {{$donations->onEachSide(5)->links()}}
                </div>
                <div class="pages">
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
