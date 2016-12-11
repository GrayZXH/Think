$(document).ready(function(){
	//返回顶部
  $(window).scroll(function(){
  	if ($(window).scrollTop()>50) {
  		$("#backToTop").fadeIn(500);
  	}else{
  		$("#backToTop").fadeOut(500);
  	}
  });
  $("#backToTop").click(function(){
  	$("body,html").animate({scrollTop:0},200);
  });

});