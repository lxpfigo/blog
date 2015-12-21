{include file="Public/header.tpl"}
<link rel="stylesheet" href="{$APP}/Admin/Css/page.css" />
<title>管理后台 | 
	
					{if $data.link_id eq ''}
						新增链接
					{else}修改链接
					{/if}

</title>
</head>
{include file="Public/nav.tpl"}
<div class="container">
	<div class="row">
		<div class="col-md-2">
			<ul class="list-group">
				<a class="list-group-item" href="{$APP}/Admin/Link/index">链接列表</a>
				<a class="list-group-item active" href="{$APP}/Admin/Link/add">
					{if $data.link_id eq ''}
						新增链接
					{else}修改链接
					{/if}
					</a>
			</ul>
		</div>
		<div class="col-md-10">
			<ol class="breadcrumb">
			  <li><a href="{$APP}/Admin/Link/index">链接管理</a></li>
			  <li class="active">					
			  	{if $data.link_id eq ''}
						新增链接
					{else}修改链接
					{/if}
			  </li>
			</ol>
			<form class="form-horizontal" action="{$APP}/Admin/Link/doAdd/id/{$data['link_id']}" method="post">
				<div class="form-group">
					<label class="col-sm-2 control-label">链接标题</label>
					<div class="col-sm-10">
						<input type="text" value="{$data.title}" class="form-control" name="title" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">链接URL</label>
					<div class="col-sm-10">
						<input type="url" value="{$data.url}" class="form-control" name="url" />
					</div>
				</div>		
				<div class="form-group">
					<label class="col-sm-2 control-label">是否可用</label>
					<div class="col-sm-10">
						<select class="form-control" name="istrue">
							{if $data.istrue eq 1}
								<option value="1" selected="selected">是</option>
								<option value="0">否</option>
								{else}
									<option value="1">是 </option>
									<option value="0" selected="selected">否</option>
							{/if}
							
							
						</select>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-3 col-sm-offset-2">
						{if $data.link_id eq ''}
						<input type="submit" value="发布" class="btn btn-success" />
						{else}
						<input type="submit" value="修改" class="btn btn-success" />
						{/if}
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