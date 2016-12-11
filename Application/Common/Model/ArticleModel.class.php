<?php
namespace Common\Model;
use Think\Model;

class ArticleModel extends Model{
	private $_db='';
	public function __construct(){
		$this->_db=M('article');
	}
	public function getArticleById($id){
		if (!$id) {
			return false;
		}
		$ret=$this->_db->where('id="'.$id.'"')->find();
		return $ret;
	}
	public function getArticles($data,$offset,$pagesize){
		$ret=$this->_db->where($data)->order('id desc')->limit($offset,$pagesize)->select();
		return $ret;
	}
	public function getArticleCount($data){
		$ret=$this->_db->where($data)->count();
		return $ret;
	}
	public function addArticle($data){
		$data['create_time']=date("Y-m-d H:i:s");
		$ret=$this->_db->add($data);
		return $ret;
	}
	public function updateArticle($data,$id){
		$data['update_time']=date("Y-m-d H:i:s");
		$ret=$this->_db->where('id=$id')->save($data);
		return $ret;
	}
	
}