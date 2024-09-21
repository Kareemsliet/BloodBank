@extends('dashboard.layout.app')
@section('serach')
<div class="sidebar-search">
    <form method="get" enctype="multipart/form-data" action="{{route('donations.index')}}"  class="input-group">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-success" type="button">
                <i class="fa fa-search"></i>
            </button>
        </span>
        @php
            $q=isset($_GET['q'])?$_GET['q']:"";
        @endphp
        <input type="text" name="q" value="{{$q}}" class="form-control" placeholder="البحث...">
    </form>
</div>
@endsection
@section('content')
<ol class="breadcrumb">
    <li><a href="#">الرئيسية</a></li>
    <li><a href="#">التبرعات</a></li>
    <li class="active">عرض</li>
    <li class="active">التحكم</li>
</ol>
<div class="page_content">
    @if (session()->has('message'))
    <div role="alert" class="alert alert-success"> <strong>{{session()->get('message')}}</strong></div>
    @endif
    <div class="wrap">
        @if(count($donations)>0)
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td>اسم</td>
                <td>العمر</td>
                <td>فصيلة الدم</td>
                <td>عنوان المستشفي</td>
                <td>المدينة</td>
                <td>عدد الاكياس</td>
                <td>الوصف</td>
                <td>الهاتف</td>
                <td>التحكم</td>
            </tr>
             @foreach ($donations as $key=>$value)
             <tr>
                <td>{{$value->name}}</td>
                <td>{{$value->age}}</td>
                <td>{{$value->bloodTypes->name}}</td>
                <td>{{$value->hospital_adress}}</td>
                <td>{{$value->city->name}}</td>
                <td>{{$value->num_bags}}</td>
                <td>{{$value->description}}</td>
                <td>{{$value->phone}}</td>
                <td>
                    <a href="{{route('donations.destroy',$value->id)}}" class="glyphicon glyphicon-remove" onclick="event.preventDefault();document.getElementById('form{{$value->id}}').submit()" data-toggle="tooltip" data-placement="top" title="حذف" data-original-title="حذف"></a>
                    <form action="{{route('donations.destroy',$value->id)}}" method="post" id="form{{$value->id}}">
                        @csrf
                        @method("DELETE")
                    </form>
                </td>
            </tr>
             @endforeach
        </tbody>
        </table>
    @else
    <div style="width:100%;display:flex;justify-content:center;align-items:center;flex-direction:column">
        <div style="width:50%;">
             <img class="img-responsive" style="width:100%;height:50%" src="{{asset('dashboard/imgs/avatar.png')}}" alt="">
        </div>
        <p>لاتوجد بيانات.حاول مرة تانية!</p>
    </div>
    @endif
        <nav class="text-center">
            {{$donations->links()}}
        </nav>
    </div>
</div>

@endsection