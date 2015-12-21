{include file="Public/header.tpl"}
<title>搜索结果{$smarty.get.s}</title>
<script>
    var url = "{$APP}";
</script>
</head>
<body>
<script src="{$APP}/Public/Home/Js/font.mini.js" ></script>
{include file = "Public/nav.tpl"}
<div class="container content">
    <div class="row">
        <div class="col-md-8">
            <ul id="lists">
                <li style="height: .4rem;line-height: .4rem;padding: 0 .2rem">
                   <span>“<font style="color: #e67e22">{$smarty.get.s}</font>”&nbsp;搜索结果</span>
                    <span style="float: right;display: inline-block">结果数：&nbsp;<font style="color: #e67e22">{$total}</font></span>
                </li>
                {if $total eq "0" }
                    <li style="text-align: center;margin: .3rem 0;padding: 0;background: none">
                        <img src="{$APP}/Public/Img/error.png" style="max-width: 100%;margin: .3rem auto;display: block">
                        <span>该分类还暂时没有文章，请稍后再来。回到<a href="{$APP}/index/index" style="margin: 0 .1rem;color: #0000cc">首页</a>吧！</span>
                    </li>
                {/if}
                {foreach from=$articleList item=aList}
                    <li id="list">
                        <h3><a href="{$APP}/article/index/id/{$aList.article_id}">{$aList.title}</a></h3>
                        <div class="article-mete">
                            <span><i class="fa fa-clock-o"></i>&nbsp;{$aList.createtime|date_format:"%y-%m-%d %H:%M"}</span>
                            <span><i class="fa fa-eye"></i>&nbsp;{$aList.clicked}</span>
                            <span><i class="fa fa-comments"></i>&nbsp;{$aList.totalcomment}次评论</span>
                        </div>
                        <img src="{$aList.title_img}" />
                        <p>{$aList.description}</p>
                        <a href="{$APP}/article/index/id/{$aList.article_id}" class="btn btn-default my-btn" target="_blank">阅读全文</a>
                        <hr />
                        <footer>
                            <span class="fa fa-tags">&nbsp;&nbsp;</span>
                            {foreach from=$aList.tags item=tags}
                                <a href="javascript:void(0)"> {$tags.describe_info}</a>
                            {/foreach}
                        </footer>
                        {if $aList.is_top eq "1"}
                            <div class="for">
                                <i class="fa fa-star fa-spin"></i>
                            </div>
                        {/if}
                    </li>
                {/foreach}
            </ul>
            {$page}
        </div><!--文章列表结束-->
        {include file = "Public/side.tpl"}<!--引入侧边栏-->
    </div>
</div>
{include file = "Public/footer.tpl"}<!--网站底部-->
{include file = "Public/goToTop.tpl"}<!--回到顶部-->
{include file = "Public/js.tpl"}<!--js-->
</body>
</html>