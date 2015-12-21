{include file="Public/header.tpl"}
<title>管理后台 | 首页</title>
</head>
{include file="Public/nav.tpl"}
<div class="container">
	<div class="row">
		<div class="col-md-2">
			<ul class="list-group">
				<a class="list-group-item active" href="javascript:void(0)">首页</a>
			</ul>
		</div>
		<div class="col-md-10">
			<ol class="breadcrumb">
			  <li><a href="{$APP}/Index/index">首页</a></li>
			  <li class="active">详情</li>
			</ol>
			<div class="row">
				

				<div class="col-sm-6">
					<div class="panel panel-default">
					  <div class="panel-heading">文章统计<span class="badge" style="display: block;float: right;">{$totalArticle}</span></div>
					  <div class="panel-body">
					    <table class="table">
					    	<tr class="success">
					    		<th>#</th><th>今日新增文章</th><th>昨日新增文章</th><th>总文章数</th>
					    	</tr>
					    	<tr>
					    		<td></td><td>{$todayArticle}</td><td>{$yesArticle}</td><td>{$totalArticle}</td>
					    	</tr>
					    </table>
					  </div>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="panel panel-default">
					  <div class="panel-heading">今日评论<span class="badge" style="display: block;float: right;">{$totalComment}</span></div>
					  <div class="panel-body">
					    <table class="table">
					    	<tr class="success">
					    		<th>#</th><th>今日新增评论</th><th>昨日新增评论</th><th>总评论数</th>
					    	<tr>
					    		<td></td><td>{$todayComment}</td><td>{$yesComment}</td><td>{$totalComment}</td>
					    	</tr>					    		
					    	</tr>
					    </table>
					  </div>
					</div>
				</div>
			
				<div class="col-sm-12">
					<div class="panel panel-default">
						<div class="panel-heading">文章点击TOP10</div>

					  		<div class="panel-body">
					  			<div class="table-responsive">
							    <table class="table table-striped">
							    	<tr class="success">
							    		<th>#</th><th>文章标题</th><th>点击数量</th><th>评论数量</th><th>标签</th>
							    	</tr>

									{foreach from=$data item=v key=k}
										<tr>
											<td>{$k+1}</td><td><a target="_blank" href="{$APP}/Home/article/index/id/{$v['article_id']}">{$v.title}</a></td><td>{$v.clicked}</td><td>{$v.totalcomment}</td>
											<td>
												{foreach from=$v['tags'] item=vv}
													<a target="_blank" href="{$APP}/tag/index/id/{$vv.tag_id}" style="margin-right: 15px;">{$vv.describe_info}</a>
												{/foreach}
											</td>
										</tr>
									{/foreach}
							    </table>
							   </div>
							</div>
					</div>					
				</div>
				
				
				
				<div class="col-sm-12">
					<div class="panel panel-default">
						<div class="panel-heading">活跃用户<span class="badge" style="display: block;float: right;">{$totalUser}</span></div>

					  		<div class="panel-body">
					  			<div class="table-responsive">
							    <table class="table table-striped">
							    	<tr class="success">
							    		<th>#</th><th>昵称</th><th>邮箱</th><th>发表评论数量</th><th>IP</th><th>所属区域</th>
							    	</tr>
									{foreach from=$userList item=v key=k}
										<tr>
											<td>{$k+1}</td><td>{$v.nickname}</td><td>{$v.email}</td><td>{$v.nums}</td><td>{$v.IP}</td><td>{$v.location}</td>
										</tr>
									{/foreach}
							    </table>
							   </div>
							</div>
					</div>					
				</div>
				
				
			</div><!--列结束-->
		</div>
	</div>
</div>
{include file="Public/footer.tpl"}
<script src="https://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>