@extends('dashboard.layout.app')
@section('serach')
<div class="sidebar-search">
    <form method="get" enctype="multipart/form-data" action="{{route('users.index')}}"  class="input-group">
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
    <li><a href="#">المستخدمين</a></li>
    <li class="active">عرض</li>
</ol>
<div class="page_content">
    @if (session()->has('message'))
    <div role="alert" class="alert alert-success"> <strong>{{session()->get('message')}}</strong></div>
    @endif
    <div class="wrap">
        @if (count($users)>0)
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td>الاسم</td>
                <td>الايميل</td>
                <td>التحكم</td>
            </tr>
             @foreach ($users as $key=>$value)
             <tr>
                <td>{{$value->name}}</td>
                <td>{{$value->email}}</td>
                
                <td>
                    <a href="{{route('users.edit',$value->id)}}" class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="تعديل"></a>
                    <a href="{{route('users.destroy',$value->id)}}" class="glyphicon glyphicon-remove" onclick="event.preventDefault();document.getElementById('form{{$value->id}}').submit()" data-toggle="tooltip" data-placement="top" title="حذف" data-original-title="حذف"></a>
                    <form action="{{route('users.destroy',$value->id)}}" method="post" id="form{{$value->id}}">
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
            {{$users->links()}}
        </nav>
    </div>
</div>
@endsection
