<?php 
	/**
	 * mysql
	 * @param null $link [description]
	 * @return resource 连接成功，返回连接数据库资源
	 */
	//define('ROOT', dirname(__DIR__));
	function myConn(){
		static $link = null;
		if ($link === null) {
			
			$cfg=require(ROOT.'/lib/config.php');
			$link = new mysqli($cfg['host'],$cfg['user'],$cfg['passwd'],$cfg['db']);
			if ($link->connect_errno) {
				exit('Connect error:'.$link->connect_error);
			}
			$link->set_charset($cfg['charset']);
		}
			return $link;
	}
	//var_dump(myConn());exit;
	/**
	 * 查询函数
	 * @param str $sql 待查询的语句
	 * @return mixed resoure/bool 
	 */
	
	function myQuery($sql){
		$res=myConn()->query($sql);
		if($res){
			myLog($sql);
		}else{
			myLog($sql."\n".getError());
		}
		return $res;

	}

	//$sql="SELECT * FROM cat ";
	//echo "<pre>";print_r(myQuery($sql));exit;
	
	/**
	 * select 查询多行数据
	 * @param str $sql 待执行的sql语句
	 * @return mixed 成功返回二维数组
	 */
	
	function myGetAll($sql){
		$res=myQuery($sql);
		if (!$res) {
			return false;
		}
		$data=array();
		while ($row=$res->fetch_assoc()) {
			$data[]=$row;
		}
		return $data;
	}
	//$sql="SELECT * FROM cat ";
	//echo "<pre>";print_r(myGetAll($sql));exit;
	
	/**
	 *select 取出一行数据
	 * @param str $sql 待查询的sql语句
	 * @return arr/false 查询成功 返回一个一维数组
	 */
	
	function myGetRow($sql){
		$res=myQuery($sql);
		if (!$res) {
			return false;
		}
		return $res->fetch_assoc();

	}

	//$sql="select * from cat where cat_id=1";
    //echo'<pre>';print_r(myGetRow($sql));
    
    /**
     * select 查询返回一个结果
     * @param str $sql 待查询的sql语句
     * @return mixed 成功返回结果，失败返回false
     */
    
    function myGetOne($sql){
    	$res=myQuery($sql);
    	if (!$res) {
    		return false;
    	}
    	$rs=$res->fetch_row();
    	return $rs[0];
    }

    //$sql="select count(*) from art where cat_id=1";
  	//echo myGetOne($sql);
  	
  	/**
  	 *自动拼接insert和update sql语句并且调用myQuery()去执行sql
  	 *
  	 * @param str $table 表名
  	 * @param arr $data 接收到的数据，一位数组
  	 * @param str $act 动作 默认为‘insert’
  	 * @param str $where 默认0，防止update时未写入条件
  	 * @return bool insert或者update执行成功或失败
  	 */
  	function myEx($table,$data,$act='insert' ,$where=0){
  		if ($act=='insert') {
  			$sql="insert into $table (";
  			$sql.=implode(',', array_keys($data)).") values ('";//多了个空格！！！
  			$sql.=implode("','",array_values($data))."')";
  			//$sql=trim($sql);
  			return myQuery($sql);
  		}elseif ($act=='update') {
  			$sql="update $table set ";
  			foreach ($data as $key => $value) {
  				$sql .=$key."='".$value."',";
  			}
  			$sql= rtrim($sql,',')." where ".$where;
  			//echo $sql;
  			return myQuery($sql);

  		}
  	}

  	//$data = array('title'=>'我是一条鱼' , 'content'=>'海里的美人鱼' , 'pubtime'=>12345678);
	//insert into art (title,content,pubtime,author) values ('我是一条鱼','海里的美人鱼','12345678','leo');
	//echo'<pre>';var_dump(myEx('art' , $data));
	
  	/**
  	 * 获取上一步insert操作产生的id
  	 * @return int 产生的id
  	 */
	function getLastId(){
		return myConn()->insert_id;
	}
	//var_dump(getLastId());exit;

	/**
	*获取错误信息函数
	*/
	
	function getError(){
		return myConn()->error;
	}

	/**
	 * 日志记录函数
	 * @param str $str 待记录的字符串
	 * @return int 写入文件
	 */
	function myLog($str){

		$filename=ROOT.'/log/'.date('Ymd').'.txt';
		$log="###################################\n".date('Y/m/d H:i:s')."\n" . $str . "\n" . "###################################\n\n";
		return file_put_contents($filename, $log , FILE_APPEND);
	}

	/**
	*转义字符串使用反斜线
	*@param arr 待转义的数组
	*@return arr 转义后的数组
	*/
	function _addslashes($arr) {
	foreach($arr as $k=>$v) {
		if(is_string($v)) {
			$arr[$k] = addslashes($v);
		}else if(is_array($v)) {
			$arr[$k] = _addslashes($v);
		}
	}

		return $arr;
	}
 ?>