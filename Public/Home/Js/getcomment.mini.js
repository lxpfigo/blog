$(function(){var b=1;a(b,getcommentUrl,articleId);$("#load-comment").click(function(){b++;a(b,getcommentUrl,articleId)});var d=$("#alter");$("#share").click(function(){if($("#info").val()==""){return false}$("#share").html('<i class="fa fa-spinner fa-pulse"></i>信息发送中，请稍后。。。').attr("disabled","disabled");$.ajax({type:"post",url:sharecommentUrl,data:{info:$("#info").val(),articleId:articleId},dataType:"json",success:function(e){if(e==0){d.addClass("alert-danger").css("display","block").removeClass("alert-success");d.children("strong").html("请将信息填写完整！");$("#share").html("发布").removeAttr("disabled")}else{if(e==1||e==3){d.addClass("alert-danger").css("display","block").removeClass("alert-success");d.children("strong").html("发送失败，请重新发送！");$("#share").html("发布").removeAttr("disabled")}else{d.addClass("alert-success").css("display","block").removeClass("alert-danger");d.children("strong").html("发布成功!");$(".comment ul li").remove();a(b,getcommentUrl,articleId);$("#info").val("");$("#share").html("发布").removeAttr("disabled")}}}})});function a(g,h,f){var e=$("#load-comment");e.html('<i class="fa fa-spinner fa-pulse fa-lg"></i>  数据加载中。。。').attr("disabled","disabled");$.ajax({type:"post",url:h,data:{p:g,articleId:f},dataType:"json",success:function(j){if(j.data.length==0){$("#no-comment").show();$("#load-comment").hide()}if(j.status==1){e.html('<i class="fa fa-refresh"></i> 加载更多').removeAttr("disabled").removeClass("color")}else{e.html('<i class="fa fa-coffee fa-large"></i>  没有更多评论，休息一下吧！').removeClass("color").css("color","#D7D7D7")}var i="";$.each(j.data,function(l,k){var m=c(k.comment_time*1000);i+='<li><img src="'+k.img+'" class="img-responsive img-rounded" /><h5>'+k.nickname+"</h5><span>"+m+'<font style="color:#666699; margin-left: .2rem;font-size:.12rem">'+k.location+"</font></span><p>"+k.comment_info+"</p></li>"});$(".comment ul").append(i)},error:function(i){e.html('<i class="fa fa-refresh"></i> 网络错误，请重试').removeAttr("disabled").removeClass("color")}})}function c(g){var f=new Date(g);var k=f.getFullYear();var l=(f.getMonth()+1)<10?"0"+f.getMonth():f.getMonth();var j=f.getDate()<10?"0"+f.getDate():f.getDate();var i=f.getHours()<10?"0"+f.getHours():f.getHours();var e=f.getMinutes()<10?"0"+f.getMinutes():f.getMinutes();return k+"-"+l+"-"+j+" "+i+":"+e}});