@extends('dashboard.layout.app')
@section('content')
<ol class="breadcrumb">
    <li><a href="#">الرئيسية</a></li>
    <li><a href="#">الاشعارات</a></li>
    <li class="active">عرض</li>
    <li class="active">التحكم</li>
</ol>
<div class="page_content">
    @if (session()->has('message'))
    <div role="alert" class="alert alert-success"> <strong>{{session()->get('message')}}</strong></div>
    @endif
    <div class="wrap">
        @if(count($notifications)>0)
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td>عنوان</td>
                <td>الوصف</td>
                <td>التحكم</td>
            </tr>
             @foreach ($notifications as $key=>$value)
             <tr>
                <td>{{$value->title}}</td>
                <td>{{$value->description}}</td>
                <td>
                    <a href="{{route('notifications.destroy',$value->id)}}" class="glyphicon glyphicon-remove" onclick="event.preventDefault();document.getElementById('form{{$value->id}}').submit()" data-toggle="tooltip" data-placement="top" title="حذف" data-original-title="حذف"></a>
                    <form action="{{route('notifications.destroy',$value->id)}}" method="post" id="form{{$value->id}}">
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
            {{$notifications->links()}}
        </nav>
    </div>
</div>

@endsection
