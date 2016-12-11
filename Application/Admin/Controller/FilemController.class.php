<?php 
namespace Admin\Controller;
use Think\Controller;

class FilemController extends Controller{
	public function index(){

		$this->assign('f','active');
		$this->display();
	}




}
?>