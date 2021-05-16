<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>我的博客</title>
    <link rel="stylesheet" href="{{ URL::asset('layui/css/layui.css') }}">
    <script src="{{ URL::asset('layui/layui.js') }}"></script>
</head>
<body>
<div class="layui-layout layui-layout-admin">
    @include('backend.layouts.header')
    @include('backend.layouts.sidebar')
    @yield('content')
    @include('backend.layouts.footer')
</div>
</body>
</html>
@yield('header.js')
@yield('sidebar.js')
