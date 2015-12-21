loadFont();
function loadFont()
{
	var html = document.getElementsByTagName("html")[0];
	var clientW = document.body.clientWidth || document.documentElement.clientWidth;
	if (clientW < 768) {
		html.style.fontSize = (clientW/768)*100*1.75 + "px";
	}else {
		html.style.fontSize = 100 + "px";
	}
}
window.onresize = function(){
			loadFont();
}
