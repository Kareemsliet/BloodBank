@extends('dashboard.layout.app')
@section('serach')
<div class="sidebar-search">
    <form method="get" enctype="multipart/form-data" action="{{route('articles.index')}}"  class="input-group">
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
    <li><a href="#">مقالات</a></li>
    <li class="active">عرض</li>
</ol>
<div class="page_content">
    @if (session()->has('message'))
    <div role="alert" class="alert alert-success"> <strong>{{session()->get('message')}}</strong></div>
    @endif
    <div class="wrap">
        @if (count($articles)>0)
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td>العنوان</td>
                <td>الوصف</td>
                <td>الصورة</td>
                <td>التحكم</td>
            </tr>
             @foreach ($articles as $key=>$value)
             <tr>
                <td>{{$value->title}}</td>
                <td>{{$value->description}}</td>
                <td><img width="40" height="40" style="border-radius:50%" src="{{asset('uploads/articles/')}}/{{$value->image}}" alt=""></td>
                <td>
                    <a href="{{route('articles.edit',$value->id)}}" class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="تعديل"></a>
                    <a href="{{route('articles.destroy',$value->id)}}" class="glyphicon glyphicon-remove" onclick="event.preventDefault();document.getElementById('form{{$value->id}}').submit()" data-toggle="tooltip" data-placement="top" title="حذف" data-original-title="حذف"></a>
                    <form action="{{route('articles.destroy',$value->id)}}" method="post" id="form{{$value->id}}">
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
            {{$articles->links()}}
        </nav>
    </div>
</div>
@endsection
