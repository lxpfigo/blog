			<div class="col-md-4"><!--侧边栏开始-->

					<div class="widget"><!--搜索开始-->
						<h4>搜索
							<hr />
						</h4>
						<form action="{$APP}/search/" method="get" class="form-horizontal">
						<div class="input-group">
		                    <input name="s" type="text" class="form-control" placeholder="关键字">
		                		<span class="input-group-btn">
		                    	<button class="btn btn-default" type="submit" id="search">
		                    		<i class=" fa fa-search"></i>
		                    	</button>
		                		</span>
	                	</div>
						</form>
					</div><!--搜索结束-->

				<div class="widget"><!--标签开始-->
					<h4>热门标签
						<hr />
					</h4>
					<div class="tag">
							{foreach from=$tag item=tagshow}
								<a href="{$APP}/tag/index/id/{$tagshow.tag_id}/">{$tagshow.describe_info}</a>
							{/foreach}
					</div>
				</div><!--标签结束-->



				<div class="widget"><!--热门文章开始-->
					<h4>热门文章
						<hr />
					</h4>
					<ul class="hot">
							{foreach from=$hot item="hotshow"}
								<li><a href="{$APP}/article/index/id/{$hotshow.article_id}">{$hotshow.title}<span>({$hotshow.clicked})</span></a></li>
							{/foreach}


					</ul>
				</div><!--热门文章结束-->
				<div class="widget"><!--关于我-->
					<h4>关于我
						<hr />
					</h4>
					<ul class="me">
						<li>
							<i class="fa fa-wechat"></i>
							<a href="javascript:void(0)">
								&nbsp;&nbsp;微信
							</a>
							<ul>
								<li>
									<img src="{$APP}/Public/UserIcon/weichat.png" class="img-responsive"/>
								</li>
							</ul>
						</li>
						<li>
							<i class="fa fa-weibo"></i>
							<a href="http://weibo.com/lxpfigo" target="_blank">
								&nbsp;&nbsp;微博@lxpfigo
							</a>
						</li>
					</ul>
				</div><!--关于我结束-->
				
				<div class="widget"><!--收藏开始-->
					<h4>收藏
						<hr />
					</h4>
					<div class="link">
						{foreach from=$linkInfo item="linkInfoshow"}
							<a href="{$linkInfoshow.url}" target="_blank">{$linkInfoshow.title}</a>
						{/foreach}

					</div>
				</div><!--收藏结束-->				
			</div><!--侧边栏结束-->