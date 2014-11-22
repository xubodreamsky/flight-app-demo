<?php require __DIR__."/Head.php"; ?>
<h1>首页</h1>
<?php if($uid): ?>
<input id="logout" type="button" value="退出" /> (<?php echo htmlspecialchars($user["name"]); ?>)
<?php else: ?>
<input id="login" type="button" value="登录" />
<?php endif; ?>
<script type="text/javascript">
$("#login").click(function() {
    location.href = "<?php echo Flight::url("front/User:login"); ?>";
});

$("#logout").click(function() {
    var _this = $(this);
    if(_this.data("lock")) {
        return;
    } else {
        _this.data("lock", 1);
    }

    var _data = {};

    $.post("<?php echo Flight::url("front/User:logout"); ?>", _data, function(r) {
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

