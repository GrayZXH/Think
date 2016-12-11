var add = {
    check : function() {
		var content  = UE.getEditor('editorspace').getPlainTxt();/*获得UE编辑器内带格式的纯文本内容*/
		var con 	 = UE.getEditor('editorspace').hasContents();
		var title    = $("#title").val();
		var descript = $("#descript").val();
		var thum	 = $("#file_upload_image").val();
		var stitle   = $("#stitle").val();
		var keyword  = $("#keyword").val();
		var classmate= $("#classmate").val();
		var status   = $("#status").val();
		var captcha  = $("#captcha").val();
		var id		 = $("#article_id").val();
		
		var pattern_captcha = /^[A-Za-z0-9]{4,4}$/;
		var captcha_match = (pattern_captcha.test(captcha));
		
	      if (!title) {
			$("#msgAlert .modal-title").html('错误提示');
			$("#msgAlert .modal-body").html('标题不能为空');
			$("#msgAlert").modal();
			return false;
	      }
	      if (!descript) {
	      	$("#msgAlert .modal-title").html('错误提示');
			$("#msgAlert .modal-body").html('描述不能为空');
			$("#msgAlert").modal();
			return false;
	      }
	      if (con==false) {
			$("#msgAlert .modal-title").html('错误提示');
	      	$("#msgAlert .modal-body").html('文章内容不能为空');
	      	$("#msgAlert").modal();
	      	return false;
	      }
	      if (!thum) {
	      	$("#msgAlert .modal-title").html('错误提示');
			$("#msgAlert .modal-body").html('缩略图不能为空');
			$("#msgAlert").modal();
			return false;
	      }
	      if (!keyword) {
	      	$("#msgAlert .modal-title").html('错误提示');
			$("#msgAlert .modal-body").html('关键字不能为空');
			$("#msgAlert").modal();
			return false;
	      }
	      if (!classmate) {
	      	$("#msgAlert .modal-title").html('错误提示');
			$("#msgAlert .modal-body").html('文章分类不能为空');
			$("#msgAlert").modal();
			return false;
	      }
	      if (!status) {
	      	$("#msgAlert .modal-title").html('错误提示');
			$("#msgAlert .modal-body").html('文章状态不能为空');
			$("#msgAlert").modal();
			return false;
	      }
	      if (captcha_match==false) {
	      	$("#msgAlert .modal-title").html('错误提示');
			$("#msgAlert .modal-body").html('未填写验证码');
			$("#msgAlert").modal();
			return false;
	      }

	      var data={'id':id,'title':title,'stitle':stitle,'descript':descript,'keyword':keyword,'content':content,'thum':thum,'classmate':classmate,'status':status,'captcha':captcha};
	      var url='add';
	      $.post(url,data,function(result){
	      	if (result.status==0) {
	      		$("#msgAlert .modal-title").html('错误提示');
				$("#msgAlert .modal-body").html(result.message);
				$("#msgAlert").modal();
				$("#captcha_img").attr("src","verify_c"+'?'+Math.floor((Math.random()*100)+1));

	      	}
	      	if (result.status==1) {
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
