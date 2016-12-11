<?php
namespace Common\Model;
use Think\Model;

/**
* 
*/
class UsersModel extends Model
{
	private $_db='';
	public function __construct(){
		$this->_db=M('users');
	}
	public function getUsersByEmail($email){
		$ret=$this->_db->where('email="'.$email.'"')->find();
		return $ret;
	}
	public function getUsersByUsername($username){
		$ret=$this->_db->where('username="'.$username.'"')->find();
		return $ret;
	}
	public function getUserCount($data){
		$ret=$this->_db->where($data)->count();
		return $ret;
	}
	public function getUsers($data,$offset,$pagesize){
		$ret=$this->_db->where($data)->order('id desc')->limit($offset,$pagesize)->select();
		return $ret;
	}
	public function addUser($data){
		if(!$data || !is_array($data)) {
            return 0;
        }
		$ret=$this->_db->add($data);
		return $ret;
	}
	public function setLogtime($email){
        $data=array('lastlogin_time'=>date("Y-m-d H:i:s"));
		$ret=$this->_db->where('email="'.$email.'"')->save($data);
		return $ret;
	}
	
}