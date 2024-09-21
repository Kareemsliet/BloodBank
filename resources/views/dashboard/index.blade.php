@extends('dashboard.layout.app')
@section('content')
<ol class="breadcrumb">
    <li><a href="{{route('admin.index')}}">الرئيسية</a></li>
</ol>
<div class="page_content">
    <div class="page_content">
        <div style="width:100%;display:flex;align-items:center;gap:7px">
            @foreach ($sections as $value)
            <div style="width:25%;height:100px;border:1px solid gray;border-radius:5px;display:flex;flex-direction: column-reverse;justify-content:space-between;align-items:center;padding:4px;box-shadow:2px 2px 2px gray">
                <span>
                    {{$value['name']}}
                </span>
                <span>
                    {{$value['count']}}
                </span>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
