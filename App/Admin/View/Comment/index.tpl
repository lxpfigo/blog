{include file="Public/header.tpl"}
<link rel="stylesheet" href="{$APP}/Admin/Css/page.css" />
<title>管理后台 | 评论管理</title>
</head>
{include file="Public/nav.tpl"}
<div class="container">
	<div class="row row-offcanvas row-offcanvas-right">
		<div class="col-sm-2 col-xs-12 sidebar-offcanvas" id="sidebar">
			<div class="list-group">
				<a class="list-group-item active" href="{$APP}/Admin/Comment/index">评论列表</a>
			</div>
		</div>
		
		
		<div class="col-sm-10 col-xs-12">
			<ol class="breadcrumb">
			  <li><a href="{$APP}/Admin/Article/index">评论</a></li>
			  <li class="active">评论列表</li>
			</ol>
		<table class="table table-striped">
			<tr class="success">
				<th>#</th><th>内容</th><th>发布时间</th><th>昵称</th><th>所属文章</th></th><th>操作</th>
			</tr>
			{foreach from=$data item=v key=k}
				<tr>
					<td>{$k + $ps}</td>
					<td>{$v.comment_info}</td>
					<td>{$v.comment_time|date_format:"%y-%m-%d %H:%M"}</td>
					<td>{$v.nickname}</td>
					<td><a href="{$APP}/Home/Article/index/id/{$v['article_id']}" target="_blank">{$v.title}</a></td>
					<td>
						<div class="dropdown">
							<button class="btn btn-info dropdown-toggle" data-toggle="dropdown">
								操作&nbsp;<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a href="{$APP}/Admin/Comment/del/id/{$v['comment_id']}" class="del"><i class="fa fa-trash" style="color: red;"></i>&nbsp;删除</a></li>
								<li><a href="{$APP}/Admin/Comment/edit/id/{$v['comment_id']}"><i class="fa fa-pencil-square-o" style="color: green;"></i>&nbsp;修改</a></li>
							</ul>
						</div>
					</td>	
				</tr>
			{/foreach}
		</table>
		{$show}
		
		</div>
	</div>
</div>
{include file="Public/footer.tpl"}
<script src="https://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
	$(function(){
		$('.del').click(function(e){
			var first = $(this).parents('tr').children('td:eq(1)').text();
//			e.preventDefault();
			var r = confirm("是否确定要删除“"+ first +"”?删除后该信息将无法恢复");
			if(!r){
				return false;
			}
			
		})
	});
</script>
</body>
</html>