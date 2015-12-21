{include file="Public/header.tpl"}
<link rel="stylesheet" href="{$APP}/Public/Admin/Css/page.css" />
<title>管理后台 | 标签管理</title>
</head>
{include file="Public/nav.tpl"}
<div class="container">
	<div class="row">
		<div class="col-md-2">
			<ul class="list-group">
				<a class="list-group-item active" href="{$APP}/Admin/Tag/index">标签列表</a>
				<a class="list-group-item" href="{$APP}/Admin/Tag/edit">新增标签</a>
			</ul>
		</div>
		<div class="col-md-10">
			<ol class="breadcrumb">
			  <li><a href="{$APP}/Admin/Tag/index">标签管理</a></li>
			  <li class="active">标签列表</li>
			</ol>
		<table class="table table-bordered">
			<tr class="success">
				<th>#</th><th>标签名称</th><th>标签ID</th><th>文章数量</th><th>是否为导航菜单</th><th>操作</th>
			</tr>
			{foreach from=$tags key=k item=v}
				<tr>
					<td>{$k+1}</td>
					<td>{$v.describe_info}</td>
					<td>{$v.tag_id}</td>
					<td>{$v.count}</td>
					<td>{$v.nav}</td>
					<td>
						<div class="dropdown">
							<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
								操作<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								{if $v.nav eq "1"}
									<li><a href="{$APP}/Admin/Tag/nav/id/{$v['tag_id']}"><i class="fa fa-remove" style="color: red;"></i>&nbsp;取消导航</a></li>
									{else}
									<li><a href="{$APP}/Admin/Tag/nav/id/{$v['tag_id']}"><i class="fa fa-check-circle" style="color: blue;"></i>&nbsp;设置为导航栏</a></li>
								{/if}
								<li><a href="{$APP}/Admin/Tag/edit/id/{$v['tag_id']}"><i class="fa fa-edit" style="color: green;"></i>&nbsp;修改</a></li>
							</ul>
						</div>
					</td>
				</tr>
			{/foreach}
		</table>
		</div>
	</div>
</div>
{include file="Public/footer.tpl"}
<script src="https://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
	$(function(){

	});
</script>
</body>
</html>