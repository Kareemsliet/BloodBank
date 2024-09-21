@php
$notifications=null;
if(auth('clients')->check()){
$notifications=auth('clients')->user()->clientNotifications()->where('read_at',null)->get();
}
@endphp
<!doctype html>
<html lang="en" dir="rtl">
@yield('head')

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css"
        integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">


    {{--
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    --}}

    <!--google fonts css-->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <!--font awesome css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="icon" href="{{asset('web/imgs/Icon.png')}}">

    <!--owl-carousel css-->
    <link rel="stylesheet" href="{{asset('web/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/assets/css/owl.theme.default.min.css')}}">

    <!--style css-->
    <link rel="stylesheet" href="{{asset('web/assets/css/style.css')}}">

    {{--
    <link rel="stylesheet" href="{{asset('web/assets/css/style-ltr.css')}}"> --}}

    <title>بنك الدم {{$title?$title:""}}</title>
</head>

<body class="{{$className?$className:''}}">
    <!--upper-bar-->
    <div class="upper-bar">
        <div class="container">
            <div class="row ">
                <div class="col-lg-4">
                    <div class="info" dir="ltr">
                        <div class="phone">
                            <i class="fas fa-phone-alt"></i>
                            <p>{{$setting->phone}}</p>
                        </div>
                        <div class="e-mail">
                            <i class="far fa-envelope"></i>
                            <p>{{$setting->email}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="social">
                        <div class="icons">
                            @if ($setting->facebook_link)
                            <a href="{{$setting->facebook_link}}" class="facebook"><i class="fab fa-facebook-f"></i></a>
                            @endif
                            @if ($setting->twitter_link)
                            <a href="{{$setting->twitter_link}}" class="twitter"><i class="fab fa-twitter"></i></a>
                            @endif
                            @if ($setting->yotube_link)
                            <a href="{{$setting->yotube_link}}" class="whatsapp"><i class="fab fa-youtube"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    @auth('clients')
                    <div class="member">
                        <p class="welcome">مرحباً بك</p>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle"
                                style="text-decoration-line:none;display:flex;align-items:flex-start;justify-content:flex-start"
                                type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{auth('clients')->user()->name}}
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('index')}}">
                                    <i class="fas fa-home"></i>
                                    الرئيسية
                                </a>
                                <a class="dropdown-item d-felx justify-content-between"
                                    href="{{route('client.profile')}}">
                                    <span>
                                        <i class="far fa-user"></i>
                                        معلوماتى
                                    </span>
                                    @if (count($notifications)>0)
                                    <i class="badge badge-warning ">{{count($notifications)}}</span></i>
                                    @endif
                                </a>
                                <a class="dropdown-item" href="{{route('client.setting')}}">
                                    <i class="far fa-bell"></i>
                                    اعدادات الاشعارات
                                </a>
                                <a class="dropdown-item" href="{{route('client.profile').'#favourites'}}">
                                    <i class="far fa-heart"></i>
                                    المفضلة
                                </a>
                                <a class="dropdown-item" href="{{route('contact-us')}}">
                                    <i class="fas fa-phone-alt"></i>
                                    ابلاغ
                                </a>
                                <a class="dropdown-item" href="{{route('client.logout')}}"
                                    onclick="event.preventDefault();document.getElementById('logout').submit()">
                                    <i class="fas fa-sign-out-alt"></i>
                                    تسجيل الخروج
                                </a>
                                <form action="{{route('client.logout')}}" id="logout" method="post">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="info" dir="ltr">
                        <div class="phone">
                            <i class="fas fa-phone-alt"></i>
                            <p>{{$setting->phone}}</p>
                        </div>
                        <div class="e-mail">
                            <i class="far fa-envelope"></i>
                            <p>{{$setting->email}}</p>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
    </div>

    <!--nav-->
    <div class="nav-bar">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{asset('storage/setting/')}}/{{$setting->logo}}" class="d-inline-block align-top" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('index')}}">الرئيسية</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('articles')}}">المقالات</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('donations')}}">طلبات التبرع</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('about')}}">من نحن</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('contact-us')}}">اتصل بنا</a>
                        </li>
                    </ul>

                    @auth('clients')
                    <a href="{{route('donation.create')}}" class="donate">
                        <img src="{{asset('web/imgs/transfusion.svg')}}">
                        <p>طلب تبرع</p>
                    </a>
                    @else
                    <a href="{{route('client.login')}}" class="signin">الدخول</a>
                    <a href="{{route('client.register')}}" class="create-new">إنشاء حساب جديد</a>
                    @endauth
                </div>
            </div>
        </nav>
    </div>

    @yield('content')

    <!--footer-->
    <div class="footer">
        <div class="inside-footer">
            <div class="container">
                <div class="row">
                    <div class="details col-md-4">
                        <img src="{{asset('storage/setting/')}}/{{$setting->logo}}">
                        <h4>{{$setting->name}}</h4>
                        <p>
                            {{$setting->description}}
                        </p>
                    </div>
                    <div class="pages col-md-4">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action" id="list-home-list"
                                href="{{route('index')}}" role="tab" aria-controls="home">الرئيسية</a>
                            <a class="list-group-item list-group-item-action" id="list-profile-list"
                                href="{{route('about')}}" role="tab" aria-controls="profile">عن بنك الدم</a>
                            <a class="list-group-item list-group-item-action" id="list-messages-list"
                                href="{{route('articles')}}" role="tab" aria-controls="messages">المقالات</a>
                            <a class="list-group-item list-group-item-action" id="list-settings-list"
                                href="{{route('donations')}}" role="tab" aria-controls="settings">طلبات التبرع</a>
                            <a class="list-group-item list-group-item-action" id="list-settings-list"
                                href="{{route('contact-us')}}" role="tab" aria-controls="settings">اتصل بنا</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="other">
            <div class="container">
                <div class="row">
                    <div class="social col-md-4">
                        <div class="icons">
                            @if ($setting->facebook_link)
                            <a href="{{$setting->facebook_link}}" class="facebook"><i class="fab fa-facebook-f"></i></a>
                            @endif
                            @if ($setting->twitter_link)
                            <a href="{{$setting->twitter_link}}" class="twitter"><i class="fab fa-twitter"></i></a>
                            @endif
                            @if ($setting->yotube_link)
                            <a href="{{$setting->yotube_link}}" class="whatsapp"><i class="fab fa-youtube"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="rights col-md-8">
                        <p>جميع الحقوق محفوظة لـ <span>{{$setting->name}}</span> &copy; 2025</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('web/assets/js/jquery-3.5.1.min.js')}}"></script>

    <script src="{{asset('web/assets/js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('web/assets/js/bootstrap.bundle.min-4.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>

    <script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"
        integrity="sha384-a9xOd0rz8w0J8zqj1qJic7GPFfyMfoiuDjC9rqXlVOcGO/dmRqzMn34gZYDTel8k" crossorigin="anonymous">
    </script>

    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script> --}}

    <script src="{{asset('web/assets/js/owl.carousel.min.js')}}"></script>

    <script src="{{asset('web/assets/js/main.js')}}"></script>

    <script src="{{asset('web/assets/js/ajax.js')}}"></script>

    @stack('script')

</body>

</html>
