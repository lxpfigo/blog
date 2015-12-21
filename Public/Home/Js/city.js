	window.onload = function()
	{
//			chageFontSize();
			window.onresize = function() {
//				chageFontSize();
				getHeight();			
			}
			getHeight() 
			//加载canvas
			var c = document.getElementById("logo");
			var ctx = c.getContext("2d");
			c.width = c.height;
			var img = new Image();
			img.src = 'img/icon.png';
			img.onload = function()
			{
				ctx.drawImage(this,0, 0, c.width, c.height);
			}			
			//文字飞入
			loading(2000, function()
			{
				var city = document.getElementsByClassName("city")[0];
				city.className += ' textLogo';
			});
			//按键飞入
			loading(4000, function()
			{
				var btn = document.getElementById("btn");
				btn.className += ' btnshow';
			});			
			//处理点击下载
			var btn = document.getElementById("btn");
			btn.onclick = function()
			{
				//如果已经出现一个弹出框，阻止本次点击
				var isPopup = document.getElementById("popup");
				if (isPopup) {
					return false;
				}							
				//按键文字变化
				this.innerHTML = '<img class="refresh"  src="img/iconfont-refresh.svg" style="width: 1.2rem;margin-right: .5rem;" />数据准备中，请稍后...';
				//获取操作系统浏览器版本
				var result = getClintOs();
				switch(result) 
				{
					case 0:
					//非安卓，ios直接指向apk下载地址
						gotoDown(androidTest);	
						reset(this);
					break;
					case 1:
					//ios微信中
						if (appstore) {
							gotoDown(androidFinal);
							reset(this);
						}else {
							popup("ios");	
							reset(this);
						}					
					break;
					case 2:
					//ios非微信中
						if (appstore) {
							gotoDown(iosFinal);
							reset(this);
						}else {
							gotoDown(iosTest);
							reset(this);
						}	
					break;
					case 3:
					//安卓微信中
						if (appstore) {
							gotoDown(androidFinal);
							reset(this);
						}else {
							popup("android");
							reset(this);
						}						
					break;
					case 4:
						if (appstore) {
							gotoDown(androidFinal);
							reset(this);
						}else {
							gotoDown(androidTest);
							reset(this);
						}						
					//安卓非微信中
					break;					
				}
			}			
	}
	
			//判断屏幕长度
			function getHeight() {
				//如果屏幕长度小于450px，默认设置html高度为600px
				var h = document.body.clientHeight || document.documentElement.clientHeight;
				if (h < 450) {
				document.getElementsByTagName("html")[0].style.height = 600 +"px";
				}
			}
			//加载动画方法
			function loading(time, func) 
			{
				setTimeout(func, time);
			}			
			//设置html文字，如果屏幕宽度小于540px设置文字大小为屏幕宽度/10,大于540px 设置文字大小为54px
			function chageFontSize()
			{
				var h = document.body.clientHeight || document.documentElement.clientHeight;
				var html = document.getElementsByTagName("html")[0];
				if (h < 540) {
					html.style.fontSize = document.body.clientWidth / 10 + "px";					
				}else {
					html.style.fontSize = 54 + "px";
				}				
			}	

			//弹出提示框
			
//					<div id="popup">
//						<span>点击右上角菜单</span>
//						<span>"在浏览器中打开"，打开页面点击"下载"安装</span>
//						<img src="img/iconfont-arrowsslideup.svg"  />
//					</div>
			//弹出框
			function popup(type) 
			{
				var brow = "浏览器";
				if (type == "ios") {
					brow ="Safari";
				}
				var pop = document.createElement("div");
				pop.id="popup";
				pop.innerHTML = '<span>点击右上角菜单</span>' +
											 '<span>"在'+ brow +'中打开"，打开页面点击"下载"安装</span>' +
											 '<img src="img/iconfont-arrowsslideup.svg " />';						 
				document.body.appendChild(pop);	
				document.getElementById("popup").className = 'pop-move-do';
			}
			
			//按键文字
			function reset(obj)
			{
				setTimeout(function(){
					obj.innerHTML = '<img src="img/iconfont-down.svg" style="width: 1rem;margin-right: .5rem;" />下载';
				}, 3000);
			}

			//下载链接跳转
			function gotoDown($link)
			{
				//加入时间戳，防止缓存
				var t = new Date().getTime();
				window.location.href = $link + "?t=" + t;
			}			
			//判断系统和是否在微信中打开
			function getClintOs() 
			{
				var result = 0;
				var ua = window.navigator.userAgent.toLowerCase();
				//首先判断是android还是ios 微信中打开返回奇数，非微信中打开偶数
				if ((/iPhone/i).test(ua) || (/iPad/i).test(ua) || (/iPod/i).test(ua)) {
					//ios，继续判断是否在微信中打开
					if ((/MicroMessenger/i).test(ua)) {
						//微信中打开
						result = 1;
					}else {
						//非微信中打开
						result = 2;
					}
				}else if ((/Android/i).test(ua)) {
					//安卓
					if ((/MicroMessenger/i).test(ua)) {
						//微信中打开
						result = 3;
					}else {
						//非微信中打开
						result = 4;
					}
				}
				return result;
			}
			
