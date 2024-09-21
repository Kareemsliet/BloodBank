@extends('web.layout.app')
@section('head')
@php
$title="| تسجيل اشتراك";
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
                    <li class="breadcrumb-item active" aria-current="page">انشاء حساب جديد</li>
                </ol>
            </nav>
        </div>
        <div class="account-form">
            <form method="POST" action="{{route('client.create')}}" enctype="multipart/form-data">
                @csrf
                <!---name-->
                <div>
                    <input type="text" name="name" class="form-control" aria-describedby="emailHelp"
                        value="{{old('name')}}" placeholder="الإسم">
                    @error('name')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>

                <!---email-->
                <div>
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp"
                        value="{{old('email')}}" placeholder="البريد الإلكترونى">
                    @error('email')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>

                <!---birth_date-->
                <div>
                    <input type="text" name="birth_date" placeholder="تاريخ الميلاد" class="form-control"
                        onfocus="(this.type='date')" id="date" value="{{old('birth_date')}}">
                    @error('birth_date')
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
                    <input placeholder="آخر تاريخ تبرع" value="{{old('last_donate_date')}}" name="last_donate_date"
                        id="date" class="form-control" type="text" onfocus="(this.type='date')">
                    @error('last_donate_date')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>



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
                    <input type="password" name="password" value="{{old('password')}}" class="form-control"
                        placeholder="كلمة المرور">
                    @error('password')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>

                <input type="password" name="confirm_password" class="form-control" placeholder="تأكيد كلمة المرور">
                @error('confirm_password')
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
