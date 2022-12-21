<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
    <title>Panel</title>
    <link rel="stylesheet" href="/panel/css/style.css?v={{uniqid()}}">
    <link rel="stylesheet" href="/panel/css/responsive_991.css" media="(max-width:991px)">
    <link rel="stylesheet" href="/panel/css/responsive_768.css" media="(max-width:768px)">
    <link rel="stylesheet" href="/panel/css/font.css">
    <link rel="stylesheet" href="/plugins/toast/jquery.toast.css">
    @yield('styles')
</head>
<body>
@include('Dashboard::Layouts.sideBar')
<div class="content">
    @include('Dashboard::Layouts.header')
    @include('Dashboard::Layouts.breadcrumb')
    <div class="main-content">
        @yield('content')
    </div>
</div>
</body>
@include('Dashboard::Layouts.footer')
</html>