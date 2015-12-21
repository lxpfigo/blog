{include file="Public/header.tpl"}
<title>{$detail['title']}</title>
<script>
    var getcommentUrl = "{$APP}/Article/getComment";
    var sharecommentUrl = "{$APP}/Article/shareComment";
    var shareWeibo = "{$APP}/Weibo/shareWeibo";
    var articleId = "{$articleId}";
    var qrcodeUrl = "http://our-class.cn{$APP}/article/index/id/";
    var isWeibo = "{$smarty.session.weibo.weibo_id|default:0}";
    var root = "{$APP}";
</script>
</head>
<body>
<script src="{$APP}/Public/Home/Js/font.mini.js" ></script>
{include file = "Public/nav.tpl"}
<div class="container content">
    <div class="row">
        <div class="col-md-8">
            <ul id="lists">

                    <li>
                        <h3><a href="javascript:void(0)" target="_blank" id="title">{$detail['title']}</a></h3>
                        <div class="article-mete">
										<span><i class="fa fa-clock-o"></i>
                                            {$detail['createtime']|date_format:"%y-%m-%d %H:%M"}
										</span>
                            <span><i class="fa fa-eye"></i> {$detail['clicked']}次阅读</span>
                            <span><i class="fa fa-comments"></i> {$nums}次评论</span>
                        </div>
                        <p>
                            {$detail['detailed']|htmlspecialchars_decode}
                        </p>
                        <hr />
                        <footer>
                            <span class="fa fa-tags">&nbsp;&nbsp;</span>
                            {foreach from=$tags item=tagsshow}
                                <a href="#">{$tagsshow.describe_info}</a>
                            {/foreach}
                            <hr style="margin: .2rem;">
                            <div id="alert-share" style="color: #e67e22;">分享：
                                <a href="javascript:void(0)"><img src="{$APP}/Public/Img/weibo.png" style="width: .35rem;margin-top: -.03rem;" alt="分享到新浪微博" id="weibo"/></a>
                                <a class="" href="javascript:void(0)" style="position: relative;"><img src="{$APP}/Public/Img/wechat.jpg" style="width: .28rem;height:.28rem;margin-top: -.01rem;margin-left: -.2rem;" alt="分享到微信朋友圈" id="wechat"/>
                                    <div class="code"></div>
                                </a>
                            </div>
                            {*上一篇下一篇开始*}
                            <div class="next-pre">

                                {if $articlePre.title eq ''}
                                    <a href="javascript:void(0)"><i class="fa fa-ban fa-fw fa-lg"></i>&nbsp;上一篇：没有了</a>
                                    {else}<a href="{$APP}/article/index/id/{$articlePre.article_id}" style="color:#333366;"><i class="fa fa-angle-double-up fa-fw fa-lg"></i>&nbsp;上一篇：{$articlePre.title}</a>
                                {/if}

                                {if $articleNext.title eq ''}
                                    <a href="javascript:void(0)"><i class="fa fa-ban fa-fw fa-lg"></i>&nbsp;下一篇：没有了</a>
                                    {else}<a href="{$APP}/article/index/id/{$articleNext.article_id}"  style="color:#333366;"><i class="fa fa-angle-double-down fa-fw fa-lg"></i>&nbsp;下一篇：{$articleNext.title}</a>
                                {/if}
                            </div>
                            {*上一篇下一篇结束*}
                        </footer>
                    </li>
            </ul>
            <div class="widget"><!--评论开始-->
                <h4>评论
                    <hr />
                </h4>
                <div class="comment">
                    <ul>
                        <li id="no-comment" style="margin-left: -.5rem; display: none;"><span>暂无评论，要不快来抢沙发...</span></li>
                    </ul>
                </div>
                <button class="btn btn-default" id="load-comment" style="width: 2.85rem;"><i class="fa fa-refresh"></i>&nbsp;加载更多...</button>
            </div><!--评论结束-->
            <div class="widget"><!--发表评论开始-->
                <h4>发布评论
                    <hr />
                </h4>
                <div class="share-comment">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="sr-only col-md-4"></label>
                            <div class="col-md-8">
                                {if $smarty.session.weibo.weibo_id|default:0 eq 0}
                                 <textarea class="form-control" rows="3" placeholder="点这里用微博登陆来参与互动吧！" id="info" name="info"/></textarea>
                                {else}<textarea class="form-control" rows="3" placeholder="欢迎您，{$smarty.session.weibo.nickname}说点啥吧" id="info" name="info"/></textarea>
                                {/if}
                            </div>
                        </div>
                        <!--警告框-->
                        <div class="alert alert-dismissible" role="alert" id="alter" style="display: none;">
                            <strong></strong>
                        </div>
                        <!--警告框-->
                        <div class="form-group">
                            <div class="col-md-3">
                                {if $smarty.session.weibo.weibo_id|default:0 eq 0}
                                    <button type="button" class="btn btn-success" id="share" disabled="disabled">发布</button>
                                {else}<button type="button" class="btn btn-success" id="share">发布</button>
                                {/if}
                            </div>
                        </div>
                    </form>
                </div>
            </div><!--发表评论结束-->
        </div><!--文章列表结束-->
        {include file = "Public/side.tpl"}<!--引入侧边栏-->
    </div>
</div>
<div id="qrcode" style="display: none;">
    <h4 style="text-align: center;">打开微信“扫一扫”，打开网页后点击屏幕右上角分享按钮</h4>
    <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
</div>
{include file = "Public/footer.tpl"}<!--网站底部-->
{include file = "Public/goToTop.tpl"}<!--回到顶部-->
{include file = "Public/js.tpl"}<!--js-->
<script src="{$APP}/Public/Home/Js/getcomment.mini.js" ></script>
</body>
</html>