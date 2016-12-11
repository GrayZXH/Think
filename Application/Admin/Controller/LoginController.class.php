<?php 
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller
{
	public function index(){
		$this->display();
	}
	public function check(){
		$email=trans($_POST['email']);
    	$password=trans($_POST['password']);
        $captcha =trans($_POST['captcha']);

        $email_match = preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $email);
        $password_match = preg_match('/^\w{5,30}$/', $password);
        $captcha_match = preg_match('/^[A-Za-z0-9]{4,4}$/', $captcha);


        if (!($captcha)||$captcha_match==0) {
            return show(0,'验证码错误');
        }
        if (!($email)||$email_match==0) {
            return show(0,'邮箱填写错误');
        }
    	if (!($password)||$password_match==0) {
    		return show(0,'未填写密码');
    	}

        $ret=check_verify($captcha, $id = '1');
        if (!$ret) {
            return show(0,'验证码错误');
        }

    	$result=D('Users')->getUsersByEmail($email);

    	if ($result==null) {
    		return show(0,'该用户不存在',$result);
    	}
    	if ($result['password']!=$password) {
    		return show(0,'密码错误啦！',$result);
    	}
        if ($result['email']==$email&&$result['password']==$password) {
            session('user',$result);
            D('Users')->setLogtime($email);//设置最新登录时间
            return show(1,'登录成功',$result);
        }
    }
	public function verify_c(){
        return captcha('1');
    }
    public function logout(){
        session(null);

        
        $this->redirect('/Admin/Login/index');
    }



}
 ?>