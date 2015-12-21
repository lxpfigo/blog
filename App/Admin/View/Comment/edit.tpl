{include file="Public/header.tpl"}
<link rel="stylesheet" href="{$APP}/Public/Admin/Css/page.css" />
<title>管理后台 | 修改评论</title>
</head>
{include file="Public/nav.tpl"}
<div class="container">
	<div class="row row-offcanvas row-offcanvas-right">
		<div class="col-sm-2 col-xs-6 sidebar-offcanvas" id="sidebar">
			<div class="list-group">
				<a class="list-group-item" href="{$APP}/Admin/Comment/index">评论列表</a>
				<a class="list-group-item active" href="{$APP}/Admin/Comment/index">修改评论</a>
			</div>
		</div>
		
		
		<div class="col-sm-10 col-xs-12">
			<ol class="breadcrumb">
			  <li><a href="{$APP}/Admin/Article/index">评论</a></li>
			  <li class="active">修改评论</li>
			</ol>
			
			<form class="form-horizontal" method="post" action="{$APP}/Admin/Comment/doEdit/id/{$data['comment_id']}">
				<div class="form-group">
					<label class="control-label col-sm-2">评论内容</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" value="{$data.comment_info}" name="comment" />
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-5 col-sm-offset-2">
						<input type="submit" class="btn btn-success" value="修改" />
					</div>
				</div>
				
			</form>
		
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