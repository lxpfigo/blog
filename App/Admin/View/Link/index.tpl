{include file="Public/header.tpl"}
<link rel="stylesheet" href="{$APP}/Public/Admin/Css/page.css" />
<title>管理后台 | 链接管理</title>
</head>
{include file="Public/nav.tpl"}
<div class="container">
	<div class="row row-offcanvas row-offcanvas-right">
		<div class="col-sm-2" id="sidebar">
			<div class="list-group">
				<a class="list-group-item active" href="{$APP}/Admin/Link/index">收藏网址列表</a>
				<a class="list-group-item" href="{$APP}/Admin/Link/add">新增链接</a>
			</div>
		</div>
		
		
		<div class="col-sm-10 col-xs-12">
			<ol class="breadcrumb">
			  <li><a href="{$APP}/Admin/Link/index">收藏网址列表</a></li>
			  <li class="active">列表</li>
			</ol>
		<table class="table table-striped">
			<tr class="success">
				<th>#</th><th>标题</th><th>URL</th><th>发布时间</th><th>是否可用</th><th>操作</th>
			</tr>
			{foreach from=$data item=v key=k}
				<tr>
					<td>{$k+1}</td>
					<td>{$v.title}</td>
					<td>{$v.url}</td>
					<td>{$v.time|date_format:"%y-%m-%d %H:%M"}</td>
					<td>
						{if $v.istrue eq 1}
							是
							{else}否
						{/if}
					</td>
					
					<td>
						<div class="dropdown">
							<button class="btn btn-info dropdown-toggle" data-toggle="dropdown">
								操作&nbsp;<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								{if $v.istrue eq 0}
									<li><a href="{$APP}/Admin/Link/isTrue/id/{$v['link_id']}"><i class="fa fa-star" style="color: blue;"></i>&nbsp;设置为可用</a></li>
									{else}<li><a href="{$APP}/Admin/Link/isTrue/id/{$v['link_id']}"><i class="fa fa-star-o" style="color: red;"></i>&nbsp;设置为不可用</a></li>
								{/if}
								<li><a href="{$APP}/Admin/Link/del/id/{$v['link_id']}" class="del"><i class="fa fa-trash" style="color: red;"></i>&nbsp;删除</a></li>
								<li><a href="{$APP}/Admin/Link/add/id/{$v['link_id']}"><i class="fa fa-pencil-square-o" style="color: green;"></i>&nbsp;修改</a></li>
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
		$('.del').click(function(e){
			$first = $(this).parents('tr').children('td:eq(1)').text();
//			e.preventDefault();
			var r = confirm("是否确定要删除“"+ $first +"”?删除后该信息将无法恢复");
			if(!r){
				return false;
			}
			
		})
	});
</script>
</body>
</html>