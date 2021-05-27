@extends('backend.layouts.main')
@section('content')
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body">
                    名称：
                    <div class="layui-inline">
                        <input class="layui-input" name="name" id="name" autocomplete="off">
                    </div>
                    菜单状态：
                    <div class="layui-input-inline">
                        <div class="layui-form">
                            <select name="state" lay-verify="" lay-filter="state" id="state">
                                <option value="">全部</option>
                                <option value="1">正常</option>
                                <option value="0">禁用</option>
                            </select>
                        </div>
                    </div>
                    <button id="reloadBtn" class="layui-btn" data-type="reload">搜索</button>
                </div>
                <div class="layui-card-body">
                    <table class="layui-hide" id="test" lay-filter="test"></table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/html" id="toolbarDemo">
        <div class="layui-btn-container">
            <button class="layui-btn layui-btn-sm" lay-event="delete">批量删除</button>
        </div>
    </script>
    <script type="text/html" id="popForm">
        <div class="layui-fluid">
            <form class="layui-form layui-form-pane popForm" action="">
                <div class="layui-form-item">
                    <label class="layui-form-label">名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" autocomplete="off" placeholder="请输入名称" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">图标</label>
                    <div class="layui-input-block">
                        <input type="text" name="icon" autocomplete="off" placeholder="具体请查看layui图标进行更改"
                               class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">路径</label>
                    <div class="layui-input-block">
                        <input type="text" name="url" autocomplete="off" placeholder="请输入路径" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">比重</label>
                    <div class="layui-input-block">
                        <input type="number" name="weight" autocomplete="off" placeholder="1~100的数字,值越大越靠前显示"
                               class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">是否显示</label>
                    <div class="layui-input-block">
                        <input type="radio" name="state" value="0" title="显示" checked="">
                        <input type="radio" name="state" value="1" title="隐藏">
                    </div>
                </div>
            </form>
        </div>
    </script>
    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    </script>
    <script>
        layui.use(['table', 'jquery', 'form'], function () {
            var $ = layui.$
            var table = layui.table;
            var form = layui.form

            // 表格渲染
            table.render(
                {
                    elem: '#test'
                    , method: 'post'
                    , url: '/admin/menu/index'
                    , toolbar: '#toolbarDemo'
                    , page: { //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
                        layout: ['limit', 'count', 'prev', 'page', 'next', 'skip'] //自定义分页布局
                        //,curr: 5 //设定初始在第 5 页
                        // ,limit:10
                        , groups: 5 //只显示 1 个连续页码
                        , first: false //不显示首页
                        , last: false //不显示尾页
                    }
                    , cellMinWidth: 80 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
                    , cols: [[
                        {type: 'checkbox'}
                        , {
                            field: 'id', title: 'ID', sort: true, align: 'center', templet: function (d) {
                                return '<div style = "text-align:left">' + d.id + '</div>'
                            }
                        }
                        , {
                            field: 'pid', title: '父级ID', align: 'center', templet: function (d) {
                                return '<div style = "text-align:left">' + d.pid + '</div>'
                            }
                        } //width 支持：数字、百分比和不填写。你还可以通过 minWidth 参数局部定义当前单元格的最小宽度，layui 2.2.1 新增
                        , {
                            field: 'name', title: '名称', align: 'center', templet: function (d) {
                                return '<div style = "text-align:left">' + d.name + '</div>'
                            }
                        }
                        , {
                            field: 'icon', title: '图片', align: 'center', templet: function (d) {
                                return '<div style = "text-align:left">' + d.icon + '</div>'
                            }
                        }
                        , {
                            field: 'url', title: '地址', align: 'center', templet: function (d) {
                                return '<div style = "text-align:left">' + d.url + '</div>'
                            }
                        }
                        , {field: 'weight', title: '比重', align: 'center',}
                        , {
                            field: 'state', title: '是否显示', align: 'center', templet: function (d) {
                                return d.state === 0 ? '显示' : '隐藏'
                            }
                        } //单元格内容水平居中
                        , {fixed: 'right', title: '操作', toolbar: '#barDemo', align: 'center', width: 170}
                    ]]
                    , id: 'testReload'
                });

            // 头工具栏事件
            table.on('toolbar(test)', function (obj) {
                var checkStatus = table.checkStatus(obj.config.id);
                var data = checkStatus.data;
                var ids = data.map(({id}) => (id))
                if (obj.event === 'delete') {
                    layer.confirm('确认删除这些菜单吗?', function (index) {
                        $.ajax({
                            url: "{{ url('admin/menu/delete') }}",
                            type: 'post',
                            data: {id: ids},
                            success: function (data) {
                                if (data.state === false) {
                                    layer.msg(data.msg, {icon: 5});//失败的表情
                                    return;
                                } else {
                                    layer.msg(data.msg, {
                                        icon: 6,//成功的表情
                                        time: 1000 //1秒关闭（如果不配置，默认是3秒）
                                    }, function () {
                                        location.reload();
                                    });
                                }
                            },
                        });
                    });
                }
            });

            // 行工具栏事件
            table.on('tool(test)', function (obj) {
                var data = obj.data;
                var content = $('#popForm').html();
                if (obj.event === 'del') {
                    layer.confirm('确认删除吗', function (index) {
                        $.ajax({
                            url: "{{ url('admin/menu/delete') }}",
                            type: 'post',
                            data: {id: data.id},
                            success: function (data) {
                                if (data.state === false) {
                                    layer.msg(data.msg, {icon: 5});//失败的表情
                                    return;
                                } else {
                                    layer.msg(data.msg, {
                                        icon: 6,//成功的表情
                                        time: 1000 //1秒关闭（如果不配置，默认是3秒）
                                    }, function () {
                                        location.reload();
                                    });
                                }
                            },
                        });
                    });
                } else if (obj.event === 'edit') {
                    layer.open({
                        type: 1
                        , title: '编辑'
                        , content: content
                        , shadeClose: true
                        , area: ['500px', '500px']
                        , btn: ['提交', '取消']
                        , success: function () {
                            $(".popForm input[name='name']").val(data.name)
                            $(".popForm input[name='icon']").val(data.icon)
                            $(".popForm input[name='url']").val(data.url)
                            $(".popForm input[name='weight']").val(data.weight)
                            $(".popForm input:radio[name='state'][value='" + data.state + "']").prop("checked", true);
                            form.render()
                        }
                        , btn1: function () {
                            $.ajax({
                                url: "{{ url('admin/menu/update') }}",
                                type: 'post',
                                data: {
                                    id: data.id,
                                    name: $(".popForm input[name='name']").val(),
                                    icon: $(".popForm input[name='icon']").val(),
                                    url: $(".popForm input[name='url']").val(),
                                    weight: $(".popForm input[name='weight']").val(),
                                    state: $(".popForm input:radio[name='state']:checked").val(),
                                },
                                success: function (data) {
                                    if (data.state === false) {
                                        layer.msg(data.msg, {icon: 5});//失败的表情
                                        return;
                                    } else {
                                        layer.msg(data.msg, {
                                            icon: 6,//成功的表情
                                            time: 1000 //1秒关闭（如果不配置，默认是3秒）
                                        }, function () {
                                            location.reload();
                                        });
                                    }
                                },
                            });
                        }
                    }, function (value, index) {
                        obj.update({
                            email: value
                        });
                        // layer.close(index);
                    });
                    layer.close();
                }
            });

            var active = {
                reload: function () {
                    var name = $('#name').val();
                    var state = $("#state option:selected").val();
                    //执行重载
                    table.reload('testReload', {
                        page: {
                            curr: 1 //重新从第 1 页开始
                        }
                        , where: {
                            name: name,
                            state: state
                        }
                    }, 'data');
                }
            }

            $('#reloadBtn').on('click', function () {
                var type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            })
        });
    </script>
@endsection
