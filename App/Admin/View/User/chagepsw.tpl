{include file="Public/header.tpl"}
<link rel="stylesheet" href="{$APP}/Public/Admin/Css/page.css" />
<title>管理后台 | 修改密码</title>
</head>
{include file="Public/nav.tpl"}
<div class="container">
	<div class="row row-offcanvas row-offcanvas-right">
		<div class="col-sm-2 col-xs-6 sidebar-offcanvas" id="sidebar">
			<div class="list-group">
				<a class="list-group-item " href="{$APP}/Admin/User/index">管理员列表</a>
				<a class="list-group-item active" href="javascript:void(0)">修改密码</a>
			</div>
		</div>
		
		<div class="col-sm-10 col-xs-12">
			<ol class="breadcrumb">
			  <li><a href="{$APP}/Admin/Article/index">用户列表</a></li>
			  <li class="active">修改密码</li>
			</ol>
		<form class="form-horizontal" action="{$APP}/Admin/User/doChangePsw/id/{$id}" method="post">
			<div class="form-group">
				<label class="control-label col-sm-2">密码</label>
				<div class="col-sm-4">
					<input type="text" name="password1" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">重复密码</label>
				<div class="col-sm-4">
					<input type="text" name="password2" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-5 col-sm-offset-2">
					<input type="submit" class="btn btn-default" value="修改" />
				</div>
			</div>
		</form>
		
		</div>
	</div>
</div>
{include file="Public/footer.tpl"}
<script src="https://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>