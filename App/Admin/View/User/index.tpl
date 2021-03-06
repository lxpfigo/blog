{include file="Public/header.tpl"}
<link rel="stylesheet" href="{APP}/Public/Admin/Css/page.css" />
<title>管理后台 | 用户管理</title>
</head>
{include file="Public/nav.tpl"}
<div class="container">
	<div class="row row-offcanvas row-offcanvas-right"  >
		<div class="col-sm-2" id="sidebar" >
			<div class="list-group">
				<a class="list-group-item active" href="{$APP}/Admin/User/index">管理员列表</a>
				<a class="list-group-item" href="{$APP}/Admin/User/userComment">评论用户列表</a>
			</div>
		</div>
		
		
		<div class="col-sm-10 col-xs-12"">
			<ol class="breadcrumb">
			  <li><a href="{$APP}/Admin/Article/index">用户列表</a></li>
			  <li class="active">管理员用户列表</li>
			</ol>
		<table class="table table-striped">
			<tr class="success"><th>#</th><th>头像</th><th>登录名</th><th>昵称</th><th>加入时间</th><th>是否可用</th><th>操作</th></tr>
			<volist name="userList" id="v" key="k">
			{foreach from=$userList key=k item=v}
				<tr>
					<td>{$k+1}</td>
					<td style="vertical-align: middle;"><img src="{$v.img}" style="width: 40px;"></td>
					<td>{$v.username}</td>
					<td>{$v.nickname}</td>
					<td>{$v.joinData|date_format:"%y-%m-%d %H:%M"}</td>
					<td>
						{if $v.is_admin eq 1}
							是
							{else}否
						{/if}
					</td>
					
					<td>
						<div class="dropdown">
							<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
								操作<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								{if $v.is_admin eq 1}
									<li><a href="{$APP}/Admin/User/isTrue/id/{$v['user_id']}"><i class="fa fa-times" style="color: red;"></i>&nbsp;设为不可用</a></li>
									{else}<li><a href="{$APP}/Admin/User/isTrue/id/{$v['user_id']}"><i class="fa fa-check-circle" style="color: blue;"></i>&nbsp;设为可用</a></li>
								{/if}
								<li><a href="{$APP}/Admin/User/edit/id/{$v['user_id']}"><i class="fa fa-pencil-square-o" style="color: green;"></i>&nbsp;修改</a></li>
								<li><a href="{$APP}/Admin/User/chagePsw/id/{$v['user_id']}"><i class="fa fa-key" style="color: blue;"></i>&nbsp;修改密码</a></li>
							</ul>
					</td>
				</tr>
			{/foreach}
		</table>
		</div>
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