@extends('dashboard.layout.app')
@section('content')
<ol class="breadcrumb">
    <li><a href="#">الرئيسية</a></li>
    <li><a href="#">مقالات</a></li>
    <li class="active">اضافة</li>
</ol>
<div class="page_content">
    <!--Start status alert-->
    @if (session()->has('message'))
    <div role="alert" class="alert alert-success"> <strong>{{session()->get('message')}}</strong></div>
    @endif
    <div class="form">
        <form  enctype="multipart/form-data" class="form-horizontal" action="{{route('articles.store')}}"  method="post">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="input0" class="col-sm-2 control-label bring_right left_text">عنوان</label>
                <div class="col-sm-10">
                    <input type="text" name="title" value="{{old('title')}}" class="form-control"  placeholder="عنوان">
                    @error('title')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="input0" class="col-sm-2 control-label bring_right left_text">الوصف</label>
                <div class="col-sm-10">
                    <textarea name="description" class="form-control"  placeholder="الوصف">{{old('description')}}</textarea>
                    @error('description')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="input2" class="col-sm-2 control-label bring_right left_text">الاقسام</label>
                <div class="col-sm-10">
                    <select name="cat_id" class="form-control" >
                        @foreach ($categories as $value)
                            <option @if (old('cat_id')==$value->id)
                                @selected(true)
                            @endif value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                    </select>
                    @error('cat_id')
                    <div style="font-size:16px;color:red">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="input0" class="col-sm-2 control-label bring_right left_text">الصورة</label>
                <div class="col-sm-10">
                    <input type="file" value="{{old('image')}}" name="image" class="form-control"  placeholder="اختار صورة" />
                    @error('image')
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
