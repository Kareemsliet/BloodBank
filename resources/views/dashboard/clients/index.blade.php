@extends('dashboard.layout.app')
@section('serach')
<div class="sidebar-search">
    <form method="get" enctype="multipart/form-data" action="{{route('clients.index')}}"  class="input-group">
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
    <li><a href="#">العملاء</a></li>
    <li class="active">عرض</li>
</ol>
<div class="page_content">
    @if (session()->has('message'))
    <div role="alert" class="alert alert-success"> <strong>{{session()->get('message')}}</strong></div>
    @endif
    <div class="wrap">
        @if(count($clients)>0)
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td>اسم</td>
                <td>البريد الاكتروني</td>
                <td>فصيلة الدم</td>
                <td>المدينة</td>
                <td>الهاتف</td>
                <td>التحكم</td>
            </tr>
             @foreach ($clients as $key=>$value)
             <tr>
                <td>{{$value->name}}</td>
                <td>{{$value->email}}</td>
                <td>{{$value->blood_type->name}}</td>
                <td>{{$value->city->name}}</td>
                <td>{{$value->phone}}</td>
                <td>
                    <a href="{{route('clients.destroy',$value->id)}}" class="glyphicon glyphicon-remove" onclick="event.preventDefault();document.getElementById('form{{$value->id}}').submit()" data-toggle="tooltip" data-placement="top" title="حذف" data-original-title="حذف"></a>
                    <form action="{{route('clients.destroy',$value->id)}}" method="post" id="form{{$value->id}}">
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
            {{$clients->links()}}
        </nav>
    </div>
</div>

@endsection
