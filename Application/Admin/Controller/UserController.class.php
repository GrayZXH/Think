<?php 
namespace Admin\Controller;
use Think\Controller;

class UserController extends Controller{
	public function index(){

		$data['level'] = array('lt',10);
		$count = D('Users')->getUserCount($data);
		$Page = new \Think\Page($count,3);
		$show = $Page->show();
		$offset = $Page->firstRow;
		$pagesize = $Page->listRows;
		$list = D('Users')->getUsers($data,$offset,$pagesize);
		
		$this->assign('list',$list);
		$this->assign('show',$show);
		$this->assign('count',$count);

		$this->assign('title',"管理员列表");
		$this->assign('g','active');
		$this->display();
	}

	public function add(){
		
		if (IS_AJAX) {
			$email=trans($_POST['email']);
	    	$password=trans($_POST['password']);
	    	$username=trans($_POST['username']);
	    	$phone=trans($_POST['phone']);
	    	$level=trans($_POST['level']);
	    	$avatar=trans($_POST['avatar']);
	        $captcha =trans($_POST['captcha']);

				$email_match=preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $email);
			    $username_match=preg_match('/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{3,10}$/u', $username);
			    $password_match=preg_match('/^\w{5,18}$/', $password);
			    $phone_match=preg_match('/^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/', $phone);
			    $level_match=preg_match('/^\d{1,3}$/', $level);
			    $avatar_match=preg_match('/^\d{1,2}$/', $avatar);
			    $captcha_match=preg_match('/^[A-Za-z0-9]{4,4}$/', $captcha);
		    

		    if (!($captcha)||$captcha_match==false) {
		    	return show(0,'验证码填写错误');
		    }

		    $ret=check_verify($captcha, $id = '');
	        if ($ret==false) {
	            return show(0,'验证码错误');
	        }
		    if (!($email)||$email_match==false) {
		    	return show(0,'邮箱填写错误');
		    }
		    if (!($password)||$password_match==false) {
		    	return show(0,'密码填写错误');
		    }
		    if (!($username)||$username_match==false) {
		    	return show(0,'用户名填写错误');
		    }
		    if ($phone&&$phone_match==false) {
		    	return show(0,'手机号填写错误');
		    }
		    if ($level&&$level_match==false) {
		    	return show(0,'用户权限选择错误');
		    }
		    if ($avatar&&$avatar_match==false) {
		    	return show(0,'头像选择错误');
		    }
		    $ret_email=D('Users')->getUsersByEmail($email);
		    $ret_username=D('Users')->getUsersByUsername($username);

		    /*print_r($ret_email);*/

		    if ($ret_email) {
		    	return show(0,'邮箱已注册！');
		    }
		    if ($ret_username) {
		    	return show(0,'用户名已注册！');
		    }

		    /*print_r($_POST);*/
		    /*$data=array($email,$password,$username,$phone,$level,$avatar,$captcha);*/
		    $data['username']=$username;
		    $data['password']=getMD5($password);
		    $data['email']=$email;
		    $data['phone']=$phone;
		    $data['create_time']=date("Y-m-d H:i:s");
		    $data['avatar']=$avatar;
		    $data['level']=$level;

		    $ret=D('Users')->addUser($data);
		    if ($ret) {
		    	return show(1,'添加成功');
		    }else{
		    	return show(0,'添加失败');
		    }



		}



		$this->assign('title',"添加管理员");
		$this->assign('g','active');
		$this->display();
	}
	public function users(){

		
		$this->assign('title',"用户列表");
		$this->assign('g','active');
		$this->display();
	}
	public function forbid(){
		$this->assign('title',"受限用户");
		$this->assign('g','active');
		$this->display();
	}
	public function deleted(){
		$this->assign('title',"已删用户");
		$this->assign('g','active');
		$this->display();
	}
	public function edit(){
		
		$this->assign('title',"编辑用户");
		$this->assign('g','active');
		$this->display();
	}

	public function verify_c(){
        return captcha();
    }


}
?>