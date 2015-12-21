<nav class="nav navbar navbar-inverse navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<a href="{$APP}/Admin/Index/index" class="navbar-brand">管理后台</a>
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		
		
		<div class="collapse navbar-collapse" id="menu">
	      <ul class="nav navbar-nav">
	        <li><a href="{$APP}/Admin/Article/index">文章管理</a></li>
	        <li><a href="{$APP}/Admin/Tag/index">标签管理</a></li>
	        <li><a href="{$APP}/Admin/Comment/index">评论管理</a></li>
	        <li><a href="{$APP}/Admin/User/index">用户管理</a></li>
	        <li><a href="{$APP}/Admin/link/index">链接管理</a></li>
			{*<li><a href="{$APP}/Admin/Wechat/mange">微信</a></li>*}
	      </ul>  
	      
	      <ul class="nav navbar-nav navbar-right">
	      		<li class="hidden-xs"><img src="{$user.img}" style="width: 12%;display: block;float: right;margin-top: 8px;z-index: 999;"/></li>
				<li class="active"><a href="javascript:void(0)">欢迎：{$user.nickname}</a></li>
				<li><a href="{$APP}/Admin/index/logout"><i class="icon-off"></i>&nbsp;注销</a></li>
		  </ul>
		</div>
	</div>
</nav>