<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>新闻管理系统</title>
</head>
<body>
	<?php include './menu.php';?>
	<div align="center">
	<h3>浏览新闻</h3>
	<table width="900" border="">
		<tr>
			<th>新闻id</th><th>标题</th><th>关键字</th>
			<th>作者</th><th>内容</th><th>发布时间</th><th>操作</th>
		</tr>
		<?php 
		//1.载入配置文件
		require './dbconfig.php';
		//2.连接数据库
		$link=new mysqli(HOST,USER,PASSWORD,DBNAME);
		$link->set_charset(CHARSET);
		//var_dump($link);exit();
		if(!$link){
		    exit('Connect ERROR'.$link->connect_error);
		}
		//3. 执行查询，并返回结果集
		$sql="SELECT * FROM news ORDER BY addtime DESC";
		$res=$link->query($sql);
		if($res && $res->num_rows>0){
		    //$data=array();
		    //4. 解析结果集,并遍历输出
		    while ($row=$res->fetch_assoc()){
		        //$data[]=$row;
		         echo "<tr>";
		         echo "<td>{$row['id']}</td>";
		         echo "<td>{$row['title']}</td>";
		         echo "<td>{$row['keywords']}</td>";
		         echo "<td>{$row['author']}</td>";
		         echo "<td>".date("Y-m-d H:i:s",$row['addtime'])."</td>";
		         echo "<td>{$row['content']}</td>";
		         echo "<td>
		         <a href='javascript:dodel({$row['id']})'>删除</a>
					<a href='edit.php?id={$row['id']}'>修改</a>
		                  </td>";
		         echo "</tr>";
		    }
		    //print_r($data);
		    //5.释放资源
		    $link->close();
		}
		?>
	</table>
	</div>
</body>
<script>
	function dodel(id){
		if(confirm("确定要删除吗？")){
		window.location="action.php?act=del&id="+id;
		}
	}
</script>
</html>
