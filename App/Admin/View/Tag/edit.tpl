{include file="Public/header.tpl"}
<link rel="stylesheet" href="{APP}/Public/Admin/Css/page.css" />
<title>管理后台 | 
				{if $taginfo.tag_id eq ''}
					新增标签
				{else}修改标签
				{/if}
</title>
</head>
{include file="Public/nav.tpl"}
<div class="container">
	<div class="row">
		<div class="col-md-2">
			<ul class="list-group">
				<a class="list-group-item" href="{$APP}/Admin/Tag/index">标签列表</a>
				<a class="list-group-item active" href="{$APP}/Admin/Tag/edit}">
				{if $taginfo.tag_id eq ''}
					新增标签
				{else}修改标签
				{/if}
				</a>
			</ul>
		</div>
		<div class="col-md-10">
			<ol class="breadcrumb">
			  <li><a href="{$APP}/Admin/Article/index">标签管理</a></li>
			  <li class="active">
			  	{if $taginfo.tag_id eq ''}
			  	新增标签
			  	{else}修改标签
			  {/if}
			  </li>
			</ol>
			<form class="form-horizontal" method="post" action="{$APP}/Admin/Tag/doEdit/id/{$taginfo['tag_id']}">
				<div class="form-group">
					<label class="col-sm-2 control-label">标签名称</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" value="{$taginfo.describe_info}" name="describe_info" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">是否为导航栏</label>
					<div class="col-sm-10">
						<select class="form-control" name="nav">
							{if $taginfo.nav eq '1'}
								<option value="0">否</option>
								<option value="1" selected="selected">是</option>
								{else}
									<option value="0" selected="selected">否</option>
									<option value="1">是</option>	
							{/if}
						</select>
					</div>
				</div>	
				<div class="form-group">
					<div class="col-sm-5 col-sm-offset-2">
						<input type="submit" value="提交" class="btn btn-success"/>
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
		var doc = $(document).height();
		var windowH = $(window).height();
		if(doc == windowH){
			$('.mian-footer').css({
				'margin-top':windowH/3*1.5
			});
		}
	});
</script>
</body>
</html>