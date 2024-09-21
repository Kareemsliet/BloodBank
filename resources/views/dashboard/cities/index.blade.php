@extends('dashboard.layout.app')
@section('content')
<ol class="breadcrumb">
    <li><a href="#">الرئيسية</a></li>
    <li><a href="#">المدن/المراكز</a></li>
    <li class="active">عرض</li>
</ol>
<div class="page_content">
    @if (session()->has('message'))
    <div role="alert" class="alert alert-success"> <strong>{{session()->get('message')}}</strong></div>
    @endif
    <div class="wrap">
        @if(count($cities)>0)
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td>اسم</td>
                <td>المحافظة</td>
                <td>التحكم</td>
            </tr>
             @foreach ($cities as $key=>$value)
             <tr>
                <td>{{$value->name}}</td>
                <td>{{$value->state->name}}</td>
                <td>
                    <a href="{{route('cities.edit',$value->id)}}" class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="تعديل"></a>
                    <a href="{{route('cities.destroy',$value->id)}}" class="glyphicon glyphicon-remove" onclick="event.preventDefault();document.getElementById('form{{$value->id}}').submit()" data-toggle="tooltip" data-placement="top" title="حذف" data-original-title="حذف"></a>
                    <form action="{{route('cities.destroy',$value->id)}}" method="post" id="form{{$value->id}}">
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
            {{$cities->links()}}
        </nav>
    </div>
</div>
@endsection