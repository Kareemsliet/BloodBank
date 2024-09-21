<!DOCTYPE html>
<html lang="ar-sa" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Admin Dashboard</title>
    <link rel="stylesheet" href="{{asset('dashboard/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/css/bootstrap-theme.min.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/css/main.min.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/css/main.css')}}">
</head>

<body>
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="left">
                <!-- Single button -->
                <div class="btn-group navbar-top-links">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="glyphicon glyphicon-user"></i>
                        اسم المستخدم
                        <span class="glyphicon glyphicon-list"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <span class="user-profile">
                                <img src="{{asset('dashboard/imgs/avatar1.jpg')}}" alt="avatar" class="img-responsive">
                            </span>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('change.password')}}">تغير كلمة المرور</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('logout')}}"
                                onclick="event.preventDefault();document.getElementById('logout').submit()"><i
                                    class="glyphicon glyphicon-log-out"></i> تسجيل الخروج</a></li>
                        <form action="{{route('logout')}}" id="logout" method="post">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <div class="right">
                    <a href="{{route('admin.index')}}" class="navbar-brand">بنك الدم</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container wrapper clearfix">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 clearfix">
                <div class="sidebar clearfix">
                    <aside>
                        @yield('serach')
                        <div class="list-group clearfix">
                            <span class="list-group-item active">
                                القائمة الرئيسية
                            </span>
                            <a href="{{route('admin.index')}}" class="list-group-item">
                                الصفحة الرئيسية
                            </a>

                            <div class="dropdown">
                                <span class="list-group-item">
                                    المحافظات
                                </span>
                                <div class="dropdown-content">
                                    @if (auth()->user()->hasPermissionTo("اضافة محافظات"))
                                    <a href="{{route('states.create')}}" class="list-group-item">
                                        <i class="glyphicon glyphicon-pencil"></i>اضافة
                                    </a>
                                    @endif
                                    <a href="{{route('states.index')}}" class="list-group-item">
                                        <i class="glyphicon glyphicon-tag"></i>عرض
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <span class="list-group-item">
                                    المدن
                                </span>
                                <div class="dropdown-content">
                                    @if (auth()->user()->hasPermissionTo("اضافة مدن"))
                                    <a href="{{route('cities.create')}}" class="list-group-item">
                                        <i class="glyphicon glyphicon-pencil"></i>اضافة
                                    </a>
                                    @endif
                                    <a href="{{route('cities.index')}}" class="list-group-item">
                                        <i class="glyphicon glyphicon-tag"></i>عرض
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <span class="list-group-item">
                                    الاقسام
                                </span>
                                <div class="dropdown-content">
                                    @if (auth()->user()->hasPermissionTo("اضافة قسم"))
                                    <a href="{{route('categories.create')}}" class="list-group-item">
                                        <i class="glyphicon glyphicon-pencil"></i>اضافة
                                    </a>
                                    @endif
                                    <a href="{{route('categories.index')}}" class="list-group-item">
                                        <i class="glyphicon glyphicon-tag"></i>عرض
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <span class="list-group-item">
                                    </i>المقالات
                                </span>
                                <div class="dropdown-content">
                                    @if (auth()->user()->hasPermissionTo("اضافة مقالات"))
                                    <a href="{{route('articles.create')}}" class="list-group-item">
                                        <i class="glyphicon glyphicon-pencil"></i>اضافة
                                    </a>
                                    @endif
                                    <a href="{{route('articles.index')}}" class="list-group-item">
                                        <i class="glyphicon glyphicon-tag"></i>عرض
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <span class="list-group-item">
                                    فصائل الدم
                                </span>
                                <div class="dropdown-content">
                                    @if (auth()->user()->hasPermissionTo("اضافة فصيلة دم"))
                                    <a href="{{route('blood-types.create')}}" class="list-group-item">
                                        <i class="glyphicon glyphicon-pencil"></i>اضافة
                                    </a>
                                    @endif
                                    <a href="{{route('blood-types.index')}}" class="list-group-item">
                                        <i class="glyphicon glyphicon-tag"></i>عرض
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <span class="list-group-item">
                                    العملاء
                                </span>
                                @if (auth()->user()->hasPermissionTo("العملاء"))

                                <div class="dropdown-content">
                                    <a href="{{route('clients.index')}}" class="list-group-item">
                                        <i class="glyphicon glyphicon-tag"></i>عرض
                                    </a>
                                </div>
                                @endif

                            </div>
                            <div class="dropdown">
                                <span class="list-group-item">
                                    حالات التبرع
                                </span>
                                <div class="dropdown-content">
                                    <a href="{{route('donations.index')}}" class="list-group-item">
                                        <i class="glyphicon glyphicon-tag"></i>عرض
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <span class="list-group-item">
                                    الاتصالات
                                </span>
                                @if (auth()->user()->hasPermissionTo("الابلاغات"))

                                <div class="dropdown-content">
                                    <a href="{{route('contacts.index')}}" class="list-group-item">
                                        <i class="glyphicon glyphicon-tag"></i>عرض
                                    </a>
                                </div>
                                @endif
                            </div>
                            <div class="dropdown">
                                <span class="list-group-item">
                                    الاعدادات
                                </span>
                                <div class="dropdown-content">
                                    <a href="{{route('setting.index')}}" class="list-group-item">
                                        <i class="glyphicon glyphicon-tag"></i>عرض
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <span class="list-group-item">
                                    الصلاحيات
                                </span>
                                <div class="dropdown-content">
                                    @if (auth()->user()->hasPermissionTo("اضافة صلاحية"))
                                    <a href="{{route('roles.create')}}" class="list-group-item">
                                        <i class="glyphicon glyphicon-edit"></i>اضافة
                                    </a>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo("تعديل صلاحية"))
                                    <a href="{{route('roles.index')}}" class="list-group-item">
                                        <i class="glyphicon glyphicon-edit"></i>عرض
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <div class="dropdown">
                                <span class="list-group-item">
                                    المستخدمين
                                </span>
                                <div class="dropdown-content">
                                    @if (auth()->user()->hasPermissionTo("اضافة مستخدم"))
                                    <a href="{{route('users.create')}}" class="list-group-item">
                                        <i class="glyphicon glyphicon-edit"></i>اضافة
                                    </a>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo("المستخدمين"))
                                    <a href="{{route('users.index')}}" class="list-group-item">
                                        <i class="glyphicon glyphicon-tag"></i>عرض
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <div class="dropdown">
                                <span class="list-group-item">
                                    الاشعارات
                                </span>
                                @if (auth()->user()->hasPermissionTo("الاشعارات"))
                                <div class="dropdown-content">
                                    <a href="{{route('notifications.index')}}" class="list-group-item">
                                        <i class="glyphicon glyphicon-tag"></i>عرض
                                    </a>

                                </div>
                                @endif
                            </div>

                        </div>
                        <footer>
                            <p>جميع الحقوق محفوظة - 2024 &copy; </p>
                        </footer>
                    </aside>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 clearfix">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{asset('dashboard/js/modernizr-2.8.3.js')}}"></script>
    <script src="{{asset('dashboard/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('dashboard/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('dashboard/js/app.js')}}"></script>
    <script>
        $("#checkall").click(function (){
     if ($("#checkall").is(':checked')){
        $(".checkboxes").each(function (){
           $(this).prop("checked", true);
           });
        }else{
           $(".checkboxes").each(function (){
                $(this).prop("checked", false);
           });
        }
 });
    </script>
</body>

</html>
