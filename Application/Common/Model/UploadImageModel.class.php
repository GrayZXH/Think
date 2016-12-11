<?php
namespace Common\Model;
use Think\Model;

/**
 * 上传图片类
 * @author  singwa
 */
class UploadImageModel extends Model {
    private $uploadObj = '';
    private $_uploadImageData = '';

    const UPLOAD = 'uploads';

    public function __construct() {
        $this->uploadObj = new  \Think\Upload();

        $this->uploadObj->rootPath = './'.self::UPLOAD.'/';
        $this->uploadObj->maxSize   = 3145728 ;// 设置附件上传大小
        $this->uploadObj->exts      = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $this->uploadObj->autoSub   = true;
        $this->uploadObj->subName   = array('date','Ymd');
        $this->uploadObj->saveName  = time().'_'.mt_rand();
        }

    public function imageUpload() {
        $res = $this->uploadObj->upload();

        if($res) {
            return __ROOT__ .'/'.self::UPLOAD . '/' . $res['file']['savepath'] . $res['file']['savename'];
        }else{
            return false;
        }
    }
}
