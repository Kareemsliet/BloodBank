@extends('dashboard.layout.auth')
@section('content')
<form method="POST" action="{{route('update.password')}}" style="display:flex;flex-direction:column;margin:15px 0px;">
    @csrf
    <div class="form-group">
        <label for="input0" class="col-sm-2 control-label bring_right left_text">البريد
            الاكتروني</label>
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
    <div class="form-group ">
        <label for="input0" class="col-sm-2 control-label bring_right left_text">اعادة كلمة
            السر</label>
        <div class="col-sm-10">
            <input type="password" name="confirm_password" value="{{old('confirm_password')}}"
                class="form-control" placeholder="كلمة السر" />
            @error('confirm_password')
            <div style="font-size:16px;color:red">{{$message}}</div>
            @enderror
        </div>
    </div>
    <div class="form-group mt-3">
        <div class="col-sm-12 left_text" style="display:flex;justify-content:left;gap:15px">
            <button type="submit" class="btn btn-danger">إضافة</button>
            <button type="reset" class="btn btn-default">مسح الحقول</button>
        </div>
    </div>
</form>
@endsection
