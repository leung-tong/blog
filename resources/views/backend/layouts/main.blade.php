<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>我的博客</title>
    <link rel="stylesheet" href="{{ URL::asset('layui/css/layui.css') }}">
    <style>
        .layui-body{
            background: #f2f2f2
        }
    </style>
    <script src="{{ URL::asset('layui/layui.js') }}"></script>
</head>
<body>
<div class="layui-layout layui-layout-admin">
    @include('backend.layouts.header')
    @include('backend.layouts.sidebar')

    <div class="layui-body">
        <div class="layui-fluid">

            <div class="layui-card-header">
                <span class="layui-breadcrumb" lay-filter="breadcrumb" style="visibility: visible;">
                  <a href="javascript:;">首页</a><span lay-separator="">/</span>
                  <a href="javascript:;">菜单管理</a><span lay-separator="">/</span>
                  <a><cite>菜单列表</cite></a>
                </span>
            </div>

            @yield('content')
        </div>
    </div>
{{--    @include('backend.layouts.footer')--}}
</div>
</body>
</html>
<script>
    layui.use('jquery',function () {
        var $ = layui.$
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}});
    })
</script>
@yield('header.js')
@yield('sidebar.js')
@yield('js')
