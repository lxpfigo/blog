window.onload=function(){window.onresize=function(){getHeight()};getHeight();var e=document.getElementById("logo");var a=e.getContext("2d");e.width=e.height;var b=new Image();b.src= url + "Img/icon.png";b.onload=function(){a.drawImage(this,0,0,e.width,e.height)};loading(2000,function(){var c=document.getElementsByClassName("city")[0];c.className+=" textLogo"});loading(4000,function(){var c=document.getElementById("btn");c.className+=" btnshow"});var d=document.getElementById("btn");d.onclick=function(){var f=document.getElementById("popup");if(f){return false}this.innerHTML='<img class="refresh"  src="'+url+'img/iconfont-refresh.svg" style="width: 1.2rem;margin-right: .5rem;" />数据准备中，请稍后...';var c=getClintOs();switch(c){case 0:gotoDown(androidTest);reset(this);break;case 1:if(appstore){gotoDown(androidFinal);reset(this)}else{popup("ios");reset(this)}break;case 2:if(appstore){gotoDown(iosFinal);reset(this)}else{gotoDown(iosTest);reset(this)}break;case 3:if(appstore){gotoDown(androidFinal);reset(this)}else{popup("android");reset(this)}break;case 4:if(appstore){gotoDown(androidFinal);reset(this)}else{gotoDown(androidTest);reset(this)}break}}};function getHeight(){var a=document.body.clientHeight||document.documentElement.clientHeight;if(a<450){document.getElementsByTagName("html")[0].style.height=600+"px"}}function loading(b,a){setTimeout(a,b)}function chageFontSize(){var b=document.body.clientHeight||document.documentElement.clientHeight;var a=document.getElementsByTagName("html")[0];if(b<540){a.style.fontSize=document.body.clientWidth/10+"px"}else{a.style.fontSize=54+"px"}}function popup(c){var a="浏览器";if(c=="ios"){a="Safari"}var b=document.createElement("div");b.id="popup";b.innerHTML='<span>点击右上角菜单</span><span>"在'+a+'中打开"，打开页面点击"下载"安装</span><img src="'+url+'img/iconfont-arrowsslideup.svg " />';document.body.appendChild(b);document.getElementById("popup").className="pop-move-do"}function reset(a){setTimeout(function(){a.innerHTML='<img src="'+url+'img/iconfont-down.svg" style="width: 1rem;margin-right: .5rem;" />下载'},3000)}function gotoDown(a){var b=new Date().getTime();window.location.href=a+"?t="+b}function getClintOs(){var a=0;var b=window.navigator.userAgent.toLowerCase();if((/iPhone/i).test(b)||(/iPad/i).test(b)||(/iPod/i).test(b)){if((/MicroMessenger/i).test(b)){a=1}else{a=2}}else{if((/Android/i).test(b)){if((/MicroMessenger/i).test(b)){a=3}else{a=4}}}return a};