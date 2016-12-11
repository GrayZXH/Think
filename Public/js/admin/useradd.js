var add = {
  check : function() {
  	var email = $("#email").val();
  	var username = $("#username").val();
  	var password = $("#password").val();
  	var phone = $("#phone").val();
  	var level = $("#level").val();
  	var avatar = $("input[name=avatar]:checked").val();
    var captcha  = $("#captcha").val();

    var pattern_email = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    var pattern_username =/^[\u4E00-\u9FA5A-Za-z0-9_]{3,10}$/;
    var pattern_password = /^\w{5,18}$/;
    var pattern_phone = /^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/;
    var pattern_level = /^\d{1,3}$/;
    var pattern_avatar = /^\d{1,2}$/;
    var pattern_captcha = /^[A-Za-z0-9]{4,4}$/;

    var email_match = (pattern_email.test(email));
    var username_match =(pattern_username.test(username));
    var password_match = (pattern_password.test(password));
    var phone_match = (pattern_phone.test(phone));
    var level_match = (pattern_level.test(level));
    var avatar_match = (pattern_avatar.test(avatar));
    var captcha_match = (pattern_captcha.test(captcha));

    if (!email||email_match==false) {
      $("#msgAlert .modal-title").html('错误提示');
      $("#msgAlert .modal-body").html('邮箱填写错误');
      $("#msgAlert").modal();
      return false;
    }
    if (!username||username_match==false) {
      $("#msgAlert .modal-title").html('错误提示');
      $("#msgAlert .modal-body").html('用户名填写错误');
      $("#msgAlert").modal();
      return false;
    }
    if (!password||password_match==false) {
      $("#msgAlert .modal-title").html('错误提示');
      $("#msgAlert .modal-body").html('密码填写错误');
      $("#msgAlert").modal();
      return false;
    }
    if (phone&&phone_match==false) {
      $("#msgAlert .modal-title").html('错误提示');
      $("#msgAlert .modal-body").html('电话填写错误');
      $("#msgAlert").modal();
      return false;
    }
    if (level&&level_match==false) {
      $("#msgAlert .modal-title").html('错误提示');
      $("#msgAlert .modal-body").html('未正确选择权限');
      $("#msgAlert").modal();
      return false;
    }
    if (avatar&&avatar_match==false) {
      $("#msgAlert .modal-title").html('错误提示');
      $("#msgAlert .modal-body").html('未正确选择头像');
      $("#msgAlert").modal();
      return false;
    }
    if(!captcha||captcha_match==false) {
      $("#msgAlert .modal-title").html('错误提示');
      $("#msgAlert .modal-body").html('验证码错误');
      $("#msgAlert").modal();
      return false; 
    }

    /*console.log(email,username,password,phone,level,avatar);*/
    var url="add";
    var data={'email':email,'password':password,'username':username,'phone':phone,'level':level,'avatar':avatar,'captcha':captcha};
    $.post(url,data,function(result){
            if(result.status==0) {
               $("#msgAlert .modal-title").html('错误提示!');
                $("#msgAlert .modal-body").html(result.message);
                $("#msgAlert").modal();
                $("#captcha_img").attr("src","verify_c"+'?'+Math.floor((Math.random()*10)+1));
            }
            if(result.status==1) {
               $("#msgAlert .modal-title").html('信息提示');
                $("#msgAlert .modal-body").html(result.message);
                $("#msgAlert").modal();
                $("#confirm").click(function(){
                    location.reload();
                });
            }  
        },'JSON');




  }
}

$("#captcha_img").click(function(){
        $(this).attr("src","verify_c"+'?'+Math.floor((Math.random()*100)+1));
    });