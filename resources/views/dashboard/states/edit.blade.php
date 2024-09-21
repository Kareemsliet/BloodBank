@extends('dashboard.layout.app')
@section('content')
<ol class="breadcrumb">
    <li><a href="#">الرئيسية</a></li>
    <li><a href="#">المحافظات</a></li>
    <li class="active">تعديل</li>
</ol>
<div class="page_content">
    <!--Start status alert-->
    @if (session()->has('message'))
    <div role="alert" class="alert alert-success"> <strong>{{session()->get('message')}}</strong></div>
    @endif
    <div class="form">
        <form class="form-horizontal" action="{{route('states.update',$state->id)}}"  method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="input0" class="col-sm-2 control-label bring_right left_text">اسم المحافظة</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" value="{{$state->name}}"  placeholder="اسم المحافظة">
                    @error('')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="input2" class="col-sm-2 control-label bring_right left_text">كود المحافظة</label>
                <div class="col-sm-10">
                    <input type="text" name="code" class="form-control" value="{{$state->code}}"  placeholder="كود المحافظة" />
                    @error('code')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group" >
                <div class="col-sm-12 left_text" style="display:flex;justify-content:left;gap:15px">
                    <button type="submit" class="btn btn-danger">تحديث</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
