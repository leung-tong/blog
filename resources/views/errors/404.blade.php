<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
页面未找到 <span id="time">3</span> 秒后跳转首页
</body>
</html>
<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>

<script>
    $(function () {
        var interval = setInterval(function () {
            var num = $("#time").text();
            if (num > 0){
                $("#time").text(num - 1)
            }else{
                clearInterval(interval);
                window.location.href='{{ url('admin/index') }}'
            }

        }, 1000)

    })
</script>
