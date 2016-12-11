var login={
  check:function(){
        var index_url=SCOPE.index_url;
        var email = $('input[name="email"]').val();
        var password = $('input[name="password"]').val();
        var captcha  = $('input[name="captcha"]').val();
        var pattern_email = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
        var pattern_password = /^\w{5,18}$/;
        var pattern_captcha = /^[A-Za-z0-9]{4,4}$/;

        var email_match = (pattern_email.test(email));
        var password_match = (pattern_password.test(password));
        var captcha_match = (pattern_captcha.test(captcha));
        
        /*console.log(email_match,password_match,captcha_match);*/

        if(!email||email_match==false) {
            $(".email").html("邮箱格式不正确！");
            $(".email").fadeIn(500);
            $("#email").addClass("has-error");
            return false; 
        }
        if(!password||password_match==false) {
            $(".password").html("密码不能为空！");
            $(".password").fadeIn(500);
            $("#password").addClass("has-error");
            return false; 
        }
        if(!captcha||captcha_match==false) {
            $(".captcha").html("验证码不正确！");
            $(".captcha").fadeIn(500);
            $("#captcha").addClass("has-error");
            return false; 
        }
        var url="check";
        var data={'email':email,'password':password,'captcha':captcha};
        $.post(url,data,function(result){
                if(result.status==0) {
                   $("#msgAlert .modal-title").html('错误提示');
                    $("#msgAlert .modal-body").html(result.message);
                    $("#msgAlert").modal();
                    $("#captcha_img").attr("src","verify_c"+'?'+Math.floor((Math.random()*10)+1));
                }
                if(result.status==1) {
                   $("#msgAlert .modal-title").html('信息提示');
                    $("#msgAlert .modal-body").html(result.message);
                    $("#msgAlert").modal();
                    $("#confirm").click(function(){
                        location.href=index_url;
                    });
                }  
            },'JSON');

  }
}


$(document).ready(function(){
  $('input[name="email"]').click(function(){
    $("#email").removeClass("has-error");
    $(".email").fadeOut(500);
  });
  
  $('input[name="password"]').click(function(){
    $("#password").removeClass("has-error");
    $(".password").fadeOut(500);
  });

  $('input[name="captcha"]').click(function(){
    $("#captcha").removeClass("has-error");
    $(".captcha").css("display","none");
  });

});

$("#captcha_img").click(function(){
        $(this).attr("src","verify_c"+'?'+Math.floor((Math.random()*100)+1));
    });