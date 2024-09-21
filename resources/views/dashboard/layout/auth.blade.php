
<!DOCTYPE html>
<html lang="ar-sa" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ِAdmin|Login</title>
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
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 clearfix">
               @yield('content')
            </div>
        </div>
    </div>
    <script src="{{asset('dashboard/js/modernizr-2.8.3.js')}}"></script>
    <script src="{{asset('dashboard/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('dashboard/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('dashboard/js/app.js')}}"></script>

</body>

</html>
