<?php require __DIR__."/Head.php"; ?>
<h1>登录</h1>
<table>
    <tr><td>邮箱：</td><td><input id="email" type="text" value="zs@163.com" /></td></tr>
    <tr><td>密码：</td><td><input id="password" type="password" value="123456" /></td></tr>
    <tr><td></td><td>
        <input id="submit" type="button" value="登录" />
        <input type="button" value="返回" onclick="history.go(-1)" />
    </td></tr>
</table>
<script type="text/javascript">
$("#submit").click(function() {
    var _this = $(this);
    if(_this.data("lock")) {
        return;
    } else {
        _this.data("lock", 1);
    }

    _data = {};
    _data.email = $("#email").val();
    _data.password = $("#password").val();

    $.post(location.href, _data, function(r) {
        alert(r.msg);
        if(r.status) {
            location.reload();
        } else {
            _this.data("lock", 0);
        }
    }, "json");
});
</script>
<?php require __DIR__."/Foot.php"; ?>

