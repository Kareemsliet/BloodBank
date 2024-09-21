@extends('dashboard.layout.app')
@section('content')
<ol class="breadcrumb">
    <li><a href="#">الرئيسية</a></li>
    <li><a href="#">المستخدمين</a></li>
    <li class="active">اضافة</li>
</ol>
<div class="page_content">
    <!--Start status alert-->
    @if (session()->has('message'))
    <div role="alert" class="alert alert-success"> <strong>{{session()->get('message')}}</strong></div>
    @endif
    <div class="form">
        <form enctype="multipart/form-data" class="form-horizontal" action="{{route('users.store')}}" method="post">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="input0" class="col-sm-2 control-label bring_right left_text">الاسم</label>
                <div class="col-sm-10">
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="الاسم">
                    @error('name')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="input0" class="col-sm-2 control-label bring_right left_text">البريد الاكتروني</label>
                <div class="col-sm-10">
                    <input type="email" name="email" value="{{old('email')}}" class="form-control"
                        placeholder="الايميل" />
                    @error('email')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="input0" class="col-sm-2 control-label bring_right left_text">كلمة السر</label>
                <div class="col-sm-10">
                    <input type="password" name="password" value="{{old('password')}}" class="form-control"
                        placeholder="كلمة السر" />
                    @error('password')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="example">
                <input type="checkbox" id="checkall" class="all">
                <label for="selectall1">الصلاحيات</label>
                <div class="" style="display:flex;align-items:center;justify-content: space-around">
                    @foreach ($roles as $value)
                    <div style="margin:5px 0px">
                        <input class="checkboxes" type="checkbox" name="roles[]" value="{{$value->name}}">
                        <label>{{$value->name}}</label>
                    </div>
                    @endforeach
                </div>
                @error('roles')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <div class="col-sm-12 left_text" style="display:flex;justify-content:left;gap:15px">
                    <button type="submit" class="btn btn-danger">إضافة</button>
                    <button type="reset" class="btn btn-default">مسح الحقول</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
