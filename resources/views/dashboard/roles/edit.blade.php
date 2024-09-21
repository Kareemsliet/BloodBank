@extends('dashboard.layout.app')
@section('content')
<ol class="breadcrumb">
    <li><a href="#">الرئيسية</a></li>
    <li><a href="#">الاقسام</a></li>
    <li class="active">تعديل</li>
</ol>
<div class="page_content">
    <!--Start status alert-->
    @if (session()->has('message'))
    <div role="alert" class="alert alert-success"> <strong>{{session()->get('message')}}</strong></div>
    @endif
    <div class="form">
        <form class="form-horizontal" action="{{route('roles.update',$role->id)}}"  method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="input0" class="col-sm-2 control-label bring_right left_text">اسم القسم</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" value="{{$role->name}}"  placeholder="اسم القسم">
                    @error('name')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="example">
                <div>
                    <input type="checkbox"  id="checkall" class="all" value="1">
                    <label for="selectall1">اختار الكل</label>
                </div>
                <div class="" >
                    @foreach ($permissions as $value)
                    <div  style="margin:5px 0px">
                        <input @if ($role->hasPermissionTo($value))
                        checked
                    @endif class="checkboxes" type="checkbox" name="permissions[]" value="{{$value->id}}">
                        <label >{{$value->name}}</label>
                    </div>
                    @endforeach
                </div>
                @error('permissions')
                <div style="font-size:16px;color:red">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group" style="margin:10px 0px" >
                <div class="col-sm-12 left_text" style="display:flex;justify-content:left;gap:15px">
                    <button type="submit" class="btn btn-danger">تحديث</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
