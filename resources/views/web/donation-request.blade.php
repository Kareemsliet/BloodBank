@extends('web.layout.app')
@section('head')
@php
$title="| طلب تبرع";
$className="create";
@endphp
@endsection
@section('content')
<div class="form">
    <div class="container">
        <div class="path">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('index')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">انشاء طلب تبرع</li>
                </ol>
            </nav>
        </div>
        @session('message')
                <div class="alert alert-success mt-3">
                    {{$value}}
                </div>
         @endsession
        <div class="account-form">
            <form method="POST" action="{{route('donation.request')}}" enctype="multipart/form-data">
                @csrf
                <!---name-->
                <div>
                    <input type="text" name="name" class="form-control"
                        value="{{old('name')}}" placeholder="الإسم">
                    @error('name')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>

                <!---age-->
                <div>
                    <input type="age" class="form-control" name="age"
                        value="{{old('age')}}" placeholder="العمر">
                    @error('age')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>

                <!---BloodTypes-->
                <div>
                    <select class="form-control" name="blood_type_id">
                        @foreach ($blood_types as $value)
                        <option @if (old('blood_type_id')==$value->id)
                            @selected(true)
                            @endif value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                    </select>
                    @error('blood_type_id')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>

                <!---States-->
                <div>
                    <select onchange="selectCities(this.value)" class="form-control" name="state_id">
                        <option value="">اختار محافظة</option>
                        @foreach ($states as $value)
                        <option @if (old('state_id')==$value->id)
                            @selected(true)
                            @endif value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                    </select>
                    @error('state_id')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>

                <!---Cities-->
                <div id="cities" style="display:none">
                    <select class="form-control" id="cities-box"  name="city_id">
                        <!---cities-->
                    </select>
                    @error('city_id')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>


                <!---lastdonate-date-->
                <div>
                    <input placeholder="عنوان المستشفي" value="{{old('hospital_adress')}}" name="hospital_adress"
                        id="date" class="form-control" type="text" >
                    @error('hospital_adress')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>


                {{-- <!---lastdonate-date-->
                <div>
                    <a onclick="event.preventDefault;getLocation();"><i class="fa fa-location-dot"></i></a>
                </div> --}}

                <div id="somecomponent" style="width: 500px; height: 400px;"></div>


                <!---phone-->
                <div>
                    <input type="text" class="form-control" name="phone" value="{{old('phone')}}"
                        placeholder="رقم الهاتف">
                    @error('phone')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror

                </div>

                <!---passsowrd-->
                <div>
                    <input type="number" max="10" min="1" name="num_bags" value="{{old('num_bags')}}" class="form-control"
                        placeholder="عدد الاكياس">
                    @error('num_bags')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>

                <textarea  name="description" class="form-control" placeholder="الوصف">{{old('description')}}</textarea>

                @error('description')
                <div style="font-size:16px;color:red">{{$message}}</div>
                @enderror

                <div class="create-btn">
                    <input type="submit" value="إنشاء"></input>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
