<?php 
namespace Admin\Controller;
use Think\Controller;

class CommentController extends Controller{
	public function index(){

		$title="评论管理";
        $this->assign('title',$title);
		$this->assign('e','active');
		$this->display();
	}
	public function ban(){

		$title="待审评论";
        $this->assign('title',$title);
		$this->assign('e','active');
		$this->display();
	}
	public function trash(){

		$title="已删评论";
        $this->assign('title',$title);
		$this->assign('e','active');
		$this->display();
	}




}
?>