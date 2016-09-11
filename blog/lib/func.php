<?php 
	/**
	 * 封装提示函数
	 */
	
	function succ($res){
		$result='succ';
		include(ROOT.'/view/admin/info.html');
		exit;
	}
	function error($res){
		$result='fail';
		include(ROOT.'/view/admin/info.html');
		exit;
	}
	/**
	 * 获取来访者ip地址
	 */
	function getRelIp(){
		static $realIp=NULL;
		if ($realIp!==NULL) {
			return $realIp;
		}
		if (getenv('REMOTE_ADDR')) {
			$realIp =getenv('REMOTE_ADDR');
		}elseif (getenv('HTTP_X_FORWARDED_FOR')) {
			$realIp =getenv('HTTP_X_FORWARDED_FOR');
		}else{
			$realIp =getenv('HTTP_CLIENT_IP');
		}
		return $realIp;
	}
	/**
	*分页代码
	*@param int $num 文章总数
	*@param int $curr 当前显示的页码数 $curr-2 $curr-1 $curr $curr+1 $curr+2
	*@param int $cnt 每页显示的条数
	*/
	function getPages($num,$curr,$cnt){
		//最大页码数
		$max= ceil($num/$cnt);
		//最左侧页码
		$left=max(1,$curr-2);
		//最右侧页码
		$right=min($left+4,$max);

		$left=max(1,$right-4);

		$pages=array();
		for ($i=$left;$i<=$right;$i++) { 
			$_GET['page']=$i;
			//$pages[$i] = 'page='.$i;
			$pages[$i] =http_build_query($_GET);
		}
		return $pages;
	}

	//print_r(getPages(100,5,10));
	/**
	 * 生成随机字符串
	 * @param  integer $num 生成的随机字符串长度
	 * @return str 生成的随机字符串
	 */
	function randStr($num=6){
		$str=str_shuffle('ABCDEFGHJKMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789');
		$str=substr($str,0,$num);
		return $str;
	}
	//echo randStr();

	/**
	 * 按照日期创建目录
	 * @return [type] [description]
	 */
	function createDir(){
		$path='./upload'.'/'.date('Y/m/d');

		$rdir=ROOT.$path;
	
		if (is_dir($rdir)||mkdir($rdir,0777,true)) {
			return $path;
		}else{
			return false;
		}
	}
	/**
	*获取文件后缀
	*@param str $filename 文件名
	*@return str 文件后缀名
	*/

	function getExt($filename){
		return strrchr($filename,'.');
	}

	/**
	*
	*/
	function mThumb($oimg,$sw=200,$sh=200){
		$simg=dirname($oimg).'/'.randStr().'.png';
		$opath=ROOT.$oimg;
		$spath=ROOT.$simg;
		//创建小画布
	$spic = imagecreatetruecolor($sw, $sh);

	//创建白色
	$white = imagecolorallocate($spic, 255, 255, 255);
	imagefill($spic, 0, 0, $white);

	//获取大图信息
	list($bw , $bh ,$btype) = getimagesize($opath);
	//1 = GIF，2 = JPG，3 = PNG，4 = SWF，5 = PSD，6 = BMP，
	//7 = TIFF(intel byte order)，8 = TIFF(motorola byte order)，9 = JPC，10 = JP2，
	//11 = JPX，12 = JB2，13 = SWC，14 = IFF，15 = WBMP，16 = XBM
	$map = array(
		1=>'imagecreatefromgif',
		2=>'imagecreatefromjpeg',
		3=>'imagecreatefrompng',
		15=>'imagecreatefromwbmp'
	);
	if(!isset($map[$btype])) {
		return false;
	}
	$opic = $map[$btype]($opath);//大图资源
	//imagecreatefromjpeg(filename)

	//计算缩略比
	$rate = min($sw/$bw , $sh/$bh);
	$zw = $bw * $rate;//最终返回的小图宽
	$zh = $bh * $rate;//最终返回的缩略小图高

	//imagecopyresampled(dst_image, src_image, dst_x, dst_y, 
		//src_x, src_y, dst_w, dst_h, src_w, src_h)
	//echo $rate ,  '<br>' , $zw , '<br>' , $zh ;exit();
	//imagecopyresampled($spic, $opic, 0, 0, 0, 0, $zw, $zh, $bw, $bh);

	imagecopyresampled($spic, $opic, ($sw-$zw)/2, ($sh-$zh)/2, 0, 0, $zw, $zh, $bw, $bh);

	imagepng($spic , $spath);

	imagedestroy($spic);
	imagedestroy($opic);

	return $simg;
	}

	/**
	*检测用户是否有权限登陆
	*/
	function acc(){
		return isset($_COOKIE['name']);
	}

	/**
	* 加密用户名
	* @param str $name 用户登陆时输入的用户名
	* @return str md5(用户名+salt)=>md5码
	*/

	function cCode($name) {
		$salt = require ROOT . '/lib/config.php';
		return md5($name.$salt['salt']);
	}
 ?>