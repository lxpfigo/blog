{include file="Public/header.tpl"}
<title>404-迷路了</title>
<style>
    .footer-buttom {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        margin: 0;
        padding:0;
    }
</style>
</head>
<body>
<script src="{$APP}/Public/Home/Js/font.mini.js" ></script>
{include file = "Public/nav.tpl"}
<div style="width: 100%;margin: 1rem 0">
    <img id="pic" src="" style="max-width: 100%;display: block;margin: 0 auto">
    <p style="width: 100%;text-align: center;margin-top: .2rem;font-size: .18rem">尼玛，带迷路了！还不点<a href="{$APP}/index/index" style="color: #000099;margin: 0 .08rem">返回</a>!</p>
</div>
{include file = "Public/footer.tpl"}<!--网站底部-->

{include file = "Public/js.tpl"}
<script>
    var i = 1;
    $(function(){
        setInterval(function(){
            if (i == 6) {
                i = 1;
            }
            $('#pic').attr('src','{$APP}/Public/Img/run/'+ i +'.png');
            i++;
        }, 280)
    });
</script>
</body>
</html>