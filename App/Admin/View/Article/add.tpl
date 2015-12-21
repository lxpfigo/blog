{include file="Public/header.tpl"}
<link rel="stylesheet" href="{$APP}/Public/Admin/Css/page.css" />
<title>管理后台 | 
	
					{if $data.article_id eq ''}
						新增文章
					{else}修改文章
					{/if}

</title>
</head>
{include file="Public/nav.tpl"}
<div class="container">
	<div class="row">
		<div class="col-md-2">
			<ul class="list-group">
				<a class="list-group-item" href="{$APP}/Admin/Article/index">文章列表</a>
				<a class="list-group-item active" href="{$APP}/Admin/Article/add">
					{if $data.article_id eq ''}
						新增文章
					{else}修改文章
					{/if}
					</a>
			</ul>
		</div>
		<div class="col-md-10">
			<ol class="breadcrumb">
			  <li><a href="{$APP}/Admin/Article/index">文章管理</a></li>
			  <li class="active">					
			  	{if $data.article_id eq ''}
						新增文章
					{else}修改文章
				{/if}	</li>
			</ol>
			<form class="form-horizontal" action="{$APP}/Admin/Article/doAdd/id/{$data['article_id']}" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sm-2 control-label">文章标题</label>
					<div class="col-sm-10">
						<input type="text" value="{$data.title}" class="form-control" name="title" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">描述</label>
					<div class="col-sm-10">
						<input type="text" value="{$data.description}" class="form-control" name="description" />
					</div>
				</div>		
				
				
				<div class="form-group">
					<label class="col-sm-2 control-label">封面</label>
					<div class="col-sm-5">
						<input type="file" class="form-control" name="title-img" />
					</div>
					{if $data.article_id neq ''}
						<div class="col-sm-5">
							<img src="{$data['title_img']}" style="width: 200px;"/>
						</div>
					{/if}
				</div>

				{if $data.article_id neq ''}
					<div class="form-group">
						<label class="col-sm-2 control-label">标签</label>
						<div class="col-sm-10">
							{foreach from=$tags item=v}
								<label class="checkbox-inline" style="margin-right: 15px;">
									{if in_array($v['tag_id'], $articleTag)}
										<input type="checkbox" id="inlineCheckbox1" name="tag[]" value="{$v.tag_id}" checked="checked"> {$v.describe_info}
									{else}<input type="checkbox" id="inlineCheckbox1" name="tag[]" value="{$v.tag_id}"> {$v.describe_info}
									{/if}
								</label>
							{/foreach}
						</div>
					</div>
					{else}
					<div class="form-group">
						<label class="col-sm-2 control-label">标签</label>
						<div class="col-sm-10">
							{foreach from=$tags item=v}
								<label class="checkbox-inline" style="margin-right: 15px;">
									<input type="checkbox" id="inlineCheckbox1" name="tag[]" value="{$v.tag_id}"> {$v.describe_info}
								</label>
							{/foreach}
						</div>
					</div>
				{/if}


				
				
				<div class="form-group">
					<label class="col-sm-2 control-label">点击量</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="clicked" value="{$data.clicked|default:'100'}" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">是否置顶</label>
					<div class="col-sm-10">
						<select class="form-control" name="is-top">
							{if $data.is_top eq 1}
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
					<label class="col-sm-2 control-label">文章详情</label>
					<div class="col-sm-10">
						<textarea id="detail" name="detail">{$data.detailed|htmlspecialchars_decode}</textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3 col-sm-offset-2">
						{if $data.article_id eq ''}
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
<script src="{$APP}/Public/Ueditor/ueditor.config.js"></script>
<script src="{$APP}/Public/Ueditor/ueditor.all.min.js"></script>
<script>
$(function(){
		var ue = UE.getEditor('detail',{
			autoHeight: true,
		});
})

</script>
</body>
</html>