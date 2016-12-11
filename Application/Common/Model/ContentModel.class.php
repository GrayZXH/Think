<?php 
namespace Common\Model;
use Think\Model;

class ContentModel extends Model{
	private $_db='';
	public function __construct(){
		$this->_db=M('content');
	}
	public function addContent($content,$id){
		$dat['content']=$content;
		$dat['article_id']=$id;
		$dat['create_time']=date("Y-m-d H:i:s");
		return $this->_db->add($dat);

	}
	public function updateContent($data,$id){
		$data['update_time']=date("Y-m-d H:i:s");
		return $this->_db->where('article_id=$id')->save($data);
	}
	public function getArticleContentById($id){
	if (!$id) {
		return false;
	}
	$ret=$this->_db->where('article_id="'.$id.'"')->find();
	return $ret;
	}
}

