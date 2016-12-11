<?php
namespace Admin\Controller;
use Think\Controller;

class IndexController extends Controller {
    public function index(){
    	$username=session('user.username');
    	$title="管理控制台";
    	$keywords="关键字";
    	$description="描述";
        $time=NOW_TIME;
        $this->assign('time',$time);
		$this->assign('title',$title);
		$this->assign('keywords',$keywords);
		$this->assign('description',$description);
		$this->assign('username',$username);
        $this->assign('a','active');
    	$this->display();
        /*print_r(session());*/
    }
}