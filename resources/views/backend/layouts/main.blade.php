<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>我的博客</title>
    <link rel="stylesheet" href="{{ URL::asset('layui/css/layui.css') }}">
</head>
<body>
<div class="layui-layout layui-layout-admin">
    @include('backend.layouts.header')
    @include('backend.layouts.sidebar')
    @yield('content')
    @include('backend.layouts.footer')
</div>
<script src="{{ URL::asset('layui/layui.js') }}"></script>
<script>
    //JS
    layui.use(['element', 'layer', 'util'], function () {
        var element = layui.element
            , layer = layui.layer
            , util = layui.util
            , $ = layui.$;

        //头部事件
        util.event('lay-header-event', {
            //左侧菜单事件
            menuLeft: function (othis) {
                layer.msg('展开左侧菜单的操作', {icon: 0});
            }
            , menuRight: function () {
                layer.open({
                    type: 1
                    , content: '<div style="padding: 15px;">处理右侧面板的操作</div>'
                    , area: ['260px', '100%']
                    , offset: 'rt' //右上角
                    , anim: 5
                    , shadeClose: true
                });
            }
        });

    });
</script>
</body>
</html>
