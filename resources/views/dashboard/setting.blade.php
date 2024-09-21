
@extends('dashboard.layout.app')
@section('content')
<ol class="breadcrumb">
    <li><a href="#">الرئيسية</a></li>
    <li><a href="#">الاعدادات</a></li>
</ol>
<div class="page_content">
    <!--Start status alert-->
    @if (session()->has('message'))
    <div role="alert" class="alert alert-success"> <strong>{{session()->get('message')}}</strong></div>
    @endif
    <div class="form">
        <form  enctype="multipart/form-data" class="form-horizontal" action="{{$setting?route('setting.update',$setting->id):route('setting.store')}}"  method="post">
            @csrf
            <input type="hidden" name="_method" value="{{$setting?"PUT":"POST"}}" >
            <div class="form-group">
                <label for="input0" class="col-sm-2 control-label bring_right left_text">الاسم</label>
                <div class="col-sm-10">
                    <input type="text" name="name" value="{{$setting?$setting->name:old('name')}}" class="form-control"  placeholder="الاسم">
                    @error('name')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="input0" class="col-sm-2 control-label bring_right left_text">الاسم</label>
                <div class="col-sm-10">
                    <input type="text" name="phone" value="{{$setting?$setting->phone:old('phone')}}" class="form-control"  placeholder="الهاتف">
                    @error('phone')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="input0" class="col-sm-2 control-label bring_right left_text">البريد  الاكتروني</label>
                <div class="col-sm-10">
                    <input type="text" name="email" value="{{$setting?$setting->email:old('email')}}" class="form-control"  placeholder="البريد الاكتروني">
                    @error('email')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="input0" class="col-sm-2 control-label bring_right left_text">العنوان</label>
                <div class="col-sm-10">
                    <input type="text" name="adress" value="{{$setting?$setting->adress:old('adress')}}" class="form-control"  placeholder="العنوان">
                    @error('adress')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="input0" class="col-sm-2 control-label bring_right left_text">رابط الفيس بوك</label>
                <div class="col-sm-10">
                    <input type="text" name="facebook_link" value="{{$setting?$setting->facebook_link?$setting->facebook_link:"":old('facebook_link')}}" class="form-control"  placeholder="فيس بوك">
                    @error('facebook_link')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="input0" class="col-sm-2 control-label bring_right left_text">رابط التويتر</label>
                <div class="col-sm-10">
                    <input type="text" name="twitter_link" value="{{$setting?$setting->twitter_link?$setting->twitter_link:"":old('twitter_link')}}" class="form-control"  placeholder="رابط التويتر" />
                    @error('twitter_link')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="input0" class="col-sm-2 control-label bring_right left_text">رابط اليوتيوب</label>
                <div class="col-sm-10">
                    <input type="text" name="youtube_link" value="{{$setting?$setting->youtube_link?$setting->youtube_link:"":old('youtube_link')}}" class="form-control"  placeholder="رابط اليوتيوب">
                    @error('youtube_link')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="input0" class="col-sm-2 control-label bring_right left_text">الوصف</label>
                <div class="col-sm-10">
                    <textarea name="description" class="form-control"  placeholder="الوصف">{{$setting?$setting->description:old('description')}}</textarea>
                    @error('description')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="input0" class="col-sm-2 control-label bring_right left_text">الصورة</label>
                <div class="col-sm-10">
                    <input type="file" value="{{old('logo')}}" name="logo" class="form-control"  placeholder="اختار صورة" />
                    @error('logo')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group" >
                <div class="col-sm-12 left_text" style="display:flex;justify-content:left;gap:15px">
                    <button type="submit" class="btn btn-danger">{{$setting?"نحديث":"اضافة"}}</button>
                    @if ($setting)
                    <a  onclick="event.preventDefault();document.getElementById('delete-form').submit()" href="{{route('setting.destroy',$setting->id)}}" class="btn btn-default">حذف </a>
                    @endif
                </div>
            </div>
        </form>
        @if ($setting)
        <form action="{{route('setting.destroy',$setting->id)}}"   id="delete-form" method="post">
            @csrf
            @method('DELETE')
        </form>
        @endif
    </div>
</div>
@endsection
