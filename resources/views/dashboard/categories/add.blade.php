@extends('dashboard.layout.app')
@section('content')
<ol class="breadcrumb">
    <li><a href="#">الرئيسية</a></li>
    <li><a href="#">الاقسام</a></li>
    <li class="active">اضافة</li>
</ol>
<div class="page_content">
    <!--Start status alert-->
    @if (session()->has('message'))
    <div role="alert" class="alert alert-success"> <strong>{{session()->get('message')}}</strong></div>
    @endif
    <div class="form">
        <form class="form-horizontal" action="{{route('categories.store')}}"  method="post">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="input0" class="col-sm-2 control-label bring_right left_text">اسم  القسم</label>
                <div class="col-sm-10">
                    <input type="text" name="name" value="{{old('name')}}" class="form-control"  placeholder="اسم  القسم">
                    @error('name')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group" >
                <div class="col-sm-12 left_text" style="display:flex;justify-content:left;gap:15px">
                    <button type="submit" class="btn btn-danger">إضافة</button>
                    <button type="reset" class="btn btn-default">مسح الحقول</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
