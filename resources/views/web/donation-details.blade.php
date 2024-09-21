@extends('web.layout.app')
@section('head')
 @php
   $title="| حالة تبرع";
   $className="inside-request";
 @endphp
@endsection
@section('content')
 <div class="ask-donation">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index')}}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="donation-requests.html">طلبات التبرع</a></li>
                            <li class="breadcrumb-item active" aria-current="page">طلب التبرع: {{$donation->name}}</li>
                        </ol>
                    </nav>
                </div>
                <div class="details">
                    <div class="person">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>الإسم</p>
                                        </div>
                                        <div class="light">
                                            <p>{{$donation->name}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>فصيلة الدم</p>
                                        </div>
                                        <div class="light">
                                            <p dir="ltr">{{$donation->bloodTypes->name}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>العمر</p>
                                        </div>
                                        <div class="light">
                                            <p>{{$donation->age}}عام</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>عدد الأكياس المطلوبة</p>
                                        </div>
                                        <div class="light">
                                            <p>{{$donation->num_bags}}أكياس</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>المشفى</p>
                                        </div>
                                        <div class="light">
                                            <p>{{$donation->hospital_adress}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="inside">
                                    <div class="info">
                                        <div class="dark">
                                            <p>رقم الجوال</p>
                                        </div>
                                        <div class="light">
                                            <p>{{$donation->phone}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text">
                        <p>
                            {{$donation->description}}
                        </p>
                    </div>
                    <div class="location" id="map" style="height:30vh" ></div>
                </div>
            </div>
        </div>

@endsection

@push('script')
<script>
var map;

function initMap() {
    var chestersLoc = {lat:31.064064, lng:31.3688064},
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
            center: chestersLoc
        });
    var marker = new google.maps.Marker({
            position: chestersLoc,
            map: map
        });
}

var showPosition = function(position) {
    var userLatLng = new google.maps.LatLng(position.coords.latitude,
                              position.coords.longitude);
       var  marker = new google.maps.Marker({
            position: userLatLng,
            title: 'Your Location',
            draggable: true,
            map: map
        });
       map.setCenter(marker.getPosition());
}

navigator.geolocation.getCurrentPosition(showPosition);

  </script>
<script src="{{asset('web/assets/js/locationpicker.jquery.js')}}"></script>
<script src="https://cdn.jsdelivr.net/gh/somanchiu/Keyless-Google-Maps-API@v6.8/mapsJavaScriptAPI.js" async defer></script>
@endpush

