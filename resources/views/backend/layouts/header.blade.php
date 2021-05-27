<div class="layui-header">
    <div class="layui-logo layui-hide-xs layui-bg-black">layout demo</div>
    <!-- 头部区域（可配合layui 已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
        <!-- 移动端显示 -->
        <li class="layui-nav-item layui-show-xs-inline-block layui-hide-sm" lay-header-event="menuLeft">
            <i class="layui-icon layui-icon-spread-left"></i>
        </li>

        <li class="layui-nav-item layui-hide-xs"><a href="">nav 1</a></li>
        <li class="layui-nav-item layui-hide-xs"><a href="">nav 2</a></li>
        <li class="layui-nav-item layui-hide-xs"><a href="">nav 3</a></li>
        <li class="layui-nav-item">
            <a href="javascript:;">nav groups</a>
            <dl class="layui-nav-child">
                <dd><a href="">menu 11</a></dd>
                <dd><a href="">menu 22</a></dd>
                <dd><a href="">menu 33</a></dd>
            </dl>
        </li>
    </ul>

    <ul class="layui-nav layui-layout-right">
        <li class="layui-nav-item layui-hide layui-show-md-inline-block">
            <a href="javascript:;">
                <img src="{{ Auth::user()->img }}"
                     class="layui-nav-img">
                {{ Auth::user()->username }}
            </a>
            <dl class="layui-nav-child">
                <dd><a href="">个人信息</a></dd>
                <dd><a href="{{ url('/admin/logout') }}">退出登录</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item" lay-header-event="menuRight" lay-unselect>
            <a href="javascript:;">
                <i class="layui-icon layui-icon-more-vertical"></i>
            </a>
        </li>
    </ul>
</div>
@section('header.js')
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
@endsection
