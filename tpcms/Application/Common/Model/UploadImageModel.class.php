<?php 
namespace Common\Model;
use Think\Model;
/**
 * 上传图片处理
 */
class UploadImageModel extends Model{
	private $_uploadObj = '';
	private $_uploadImageData ='';

	const UPLOAD ='upload';//需要在根目录下新建这个文件夹否则会报错

	public function __construct(){
		$this->_uploadObj = new \Think\Upload();

		$this->_uploadObj->rootPath = './'.self::UPLOAD.'/';
		$this->_uploadObj->subName = date(Y).'/'.date(m).'/'.date(d);
	}

	public function upload(){
		$res = $this->_uploadObj->upload();
		if($res){
			return '/'.self::UPLOAD.'/'.$res['imgFile']['savepath'].$res['imgFile']['savename'];
		}else{
			return false;
		}

	}

	public function imageUpload(){
		$res = $this->_uploadObj->upload();
		//print_r($res);exit;
		if ($res) {
			return '/'.self::UPLOAD.'/'.$res['file']['savepath'].$res['file']['savename'];
		}else{
			return false;
		}
	}
}