<div id="menu" class="layui-side layui-bg-black"></div>
@section('sidebar.js')
<script>
    // 导航菜单的间隔像素
    var menuCell = 1;

    layui.use('element', function(){
        var element = layui.element;
        var $ = layui.jquery;

        data = {!! \App\Models\Menu::getMenus(); !!}

        var liStr= "";
        // 遍历生成主菜单
        for( var i = 0; i <data.length; i++){
            // 判断是否存在子菜单
            if(data[i].childMenus!=null&&data[i].childMenus.length>0){
                liStr+="<li class=\"layui-nav-item\"><a class=\"\" href=\"javascript:;\"><i class='layui-icon "+ data[i].icon +"'></i> "+data[i].name+"</a>\n"+
                    "<dl class=\"layui-nav-child\">\n";
                // 遍历获取子菜单
                for( var k = 0; k <data[i].childMenus.length; k++){
                    liStr+=getChildMenu(data[i].childMenus[k],0);
                }
                liStr+="</dl></li>";
            }else{
                liStr+="<li class=\"layui-nav-item\"><a class=\"\" href=\""+data[i].url+"\" data-url=\""+data[i].url+"\"><i class='layui-icon "+ data[i].icon +"'></i> "+data[i].name+"</a></li>";
            }
        }
        $("#menu").html("<ul class=\"layui-nav layui-nav-tree\"  lay-filter=\"test\">\n" +liStr+"</ul>");
        element.init();
    });

    // 递归生成子菜单
    function getChildMenu(subMenu,num) {
        num++;
        var subStr = "";
        if(subMenu.childMenus!=null&&subMenu.childMenus.length>0){
            subStr+="<dd><ul><li class=\"layui-nav-item\" ><a style=\"text-indent: "+num*menuCell+"em\" class=\"\" href=\"javascript:;\"><i class='layui-icon "+ subMenu.icon +"'></i> "+subMenu.name+"</a>" +
                "<dl class=\"layui-nav-child\">\n";
            for( var j = 0; j <subMenu.childMenus.length; j++){
                subStr+=getChildMenu(subMenu.childMenus[j],num);
            }
            subStr+="</dl></li></ul></dd>";
        }else{
            subStr+="<dd><a style=\"text-indent:"+num*menuCell+"em\" href=\""+subMenu.url+"\" data-url=\""+subMenu.url+"\"><i class='layui-icon "+ subMenu.icon +"'></i> "+subMenu.name+"</a></dd>";
        }
        return subStr;
    }

</script>
@endsection
