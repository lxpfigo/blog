{include file="Public/header.tpl"}
<title>欢迎登陆 | 挨踢人士</title>
<style>
	.alert{
		margin-bottom:15px;
	}
</style>
<script>
	var appName = "{$APP}";
</script>
</head>
  <body>
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4 content">
				<h3 style="text-align: center; padding: 30px 0; color: #e67e22;">欢迎使用“挨踢人士”管理后台</h3>
				<form class="form-horizontal">
					<div class="form-group has-feedback">
						<label class="col-sm-3 control-label">用户名</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="username" id="username" />
							<!--<span class="glyphicon glyphicon-ok form-control-feedback"></span>
							<span class="glyphicon glyphicon-remove form-control-feedback"></span>-->
						</div>
					</div>
					
					<div class="form-group has-feedback">
						<label class="col-sm-3 control-label">密码</label>
						<div class="col-sm-9">
							<input type="password" class="form-control" name="password" id="password" />
							<!--<span class="glyphicon glyphicon-ok form-control-feedback"></span>
							<span class="glyphicon glyphicon-remove form-control-feedback"></span>-->
						</div>
					</div>	
					
					<div class="form-group has-feedback">
						<label class="col-sm-3 col-xs-12 control-label">验证码</label>
						<div class="col-sm-4 col-xs-6">
							<input type="text" class="form-control" name="code" id="code" />
						</div>
						<div class="col-sm-5 col-xs-6">
							<img src="{$APP}/Admin/Login/code" title="点击图片刷新验证码" id="chage-code" style="cursor: pointer"/>
						</div>
					</div>
					
					<div id="alert-info">
						
					</div>

					
					<div class="form-group">
						<div class="col-sm-12">
							<button type="button" class="form-control" id="submit">登录</button>
						</div>
					</div>
					
				</form>
			</div>
		</div>
	</div>


	<script src="https://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{$APP}/Public/Admin/Js/login.js"></script>
  </body>
</html>