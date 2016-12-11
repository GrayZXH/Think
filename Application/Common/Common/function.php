<?php 
	function show($status,$message,$data= array()){
		$result=array(
			'status'=>$status,//0代表错误，1代表正确
			'message'=>$message,
			'data'=>$data
			);
		exit(json_encode($result));
	}
	function trans($data){
		  $data = trim($data);//去除空格
		  $data = stripslashes($data);//去除用户输入数据中的反斜杠 (\)
		  $data = strip_tags($data);//strip_tags() 函数剥去字符串中的 HTML、XML 以及 PHP 的标签。
		  $data = htmlspecialchars($data);//为HTML转义代码
		  return $data;
	}
	function captcha($id){
        $Verify = new \Think\Verify();
        $Verify->codeSet  = '23467abcdefhjkmnpqrstuvwxyzACEFGHJKLMNPQRTUVWXY';
        $Verify->expire   = 60;
        $Verify->imageW   = 130;
        $Verify->imageH   = 35;
        $Verify->fontSize = 18;
        $Verify->length   = 4;
        $Verify->useCurve = false;
        $Verify->bg       = array(255,255,255);
        $Verify->entry($id);
    }
    function check_verify($code, $id = ''){
	    $verify = new \Think\Verify();
	    return $verify->check($code, $id);
	}
	function getMD5($password){
		return md5($password . C('MD5_PRE'));
	}

	function getLevel($level){
			switch ($level) {
				case '1':
					return '<span style="color: #CC0000" title="超级管理员">Admin</span>';
					break;
				case '2':
					return '<span style="color: #00CC66" title="管理员">Admin</span>';
					break;
				case '3':
					return '<span style="color: #000000" title="Guest">Guest</span>';
					break;
				case '11':
					return '<span style="color: #000000" title="User">Guest</span>';
					break;
				case '21':
					return '<span style="color: #000000" title="VIP">Guest</span>';
					break;
				
				default:
					return '未定义';
					break;
			}
	}
	function getStatus($status){
			switch ($status) {
				case '1':
					return '<i style="color: #00CC66" class="fa fa-circle-o" title="正常"></i>';
					break;
				case '2':
					return '<i style="color: red" class="fa fa-ban" title="受限"></i>';
					break;
				case '3':
					return '<i style="color: #000000" class="fa fa-trash-o" title="已删"></i>';
					break;
				
				default:
					return '未定义';
					break;
			}
	}
 ?>