<nav class="mynav navbar navbar-default navbar-static-top">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="navbar-header">
					<button id="nav" type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#menu">
						<span class="icon-bar span-hide"></span>
						<span id='soc' class="icon-bar"><span class="icon-bar"></span></span>
						<span class="icon-bar span-hide"></span>
					</button>
					<a href="{$APP}/" class="navbar-brand" id="color">挨踢人生</a>
				</div>
				<div class="navbar-collapse collapse" id="menu">
					<ul class="nav navbar-nav navbar-right">
							{if $id|default:"0" eq "0"}
								<li><a class="a-active" href="{$APP}/">主页</a></li>
								{else} <li><a href="{$APP}/">主页</a></li>
							{/if}
							{foreach from=$nav item=navshow}
								{if $navshow.tag_id eq $id|default:"0"}
									<li><a class="a-active" href="{$APP}/tag/index/id/{$navshow.tag_id}/">{$navshow.describe_info}</a></li>
									{else}<li><a href="{$APP}/tag/index/id/{$navshow.tag_id}/">{$navshow.describe_info}</a></li>
								{/if}

							{/foreach}
					</ul>
				</div>
			</div>
		</div>
	</div>
</nav>