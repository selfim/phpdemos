<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>新闻管理系统</title>
</head>
<body>
	<?php include './menu.php';?>
	<div align="center">
	<h3>搜索分页浏览新闻</h3>
	<!-- --search begin -->
		<form action="splist.php" method="get">
			标题：<input type="text" name="title" size="10" value="<?php if (isset($_GET['title'])){echo trim($_GET['title']);} ?>" />&nbsp;
			关键字：<input type="text" name="keywords" size="10"  value="<?php if (isset($_GET['keywords'])){echo trim($_GET['keywords']);}?>" />&nbsp;
			作者：<input type="text" name="author"  size="10"  value="<?php if (isset($_GET['author'])){echo trim($_GET['author']);}?>" />&nbsp;
			<input type="submit" value="搜索" />&nbsp;&nbsp;&nbsp;
			<input type="button" value="搜索全部" onclick="window.location='splist.php'" />
		</form>
	<!-- --search end -->
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
		//封装搜索信息 放置在一个空数组里
		$serachs=array();
		$urllist = array(); //定义了一个封装搜索条件的url数组，语句放置到url后面做url参数使用
		$where='';
		$url=null;
		//判断搜索信息是否有值 有的话则封装
		if (!empty($_GET['title'])){
		    $serachs[]="title like '%{$_GET['title']}%'";
		    $urllist[]="title={$_GET['title']}";
		}
		if (!empty($_GET['keywords'])){
		    $serachs[]="keywords like '%{$_GET['title']}%'";
		    $urllist[]="keywords={$_GET['keywords']}";
		}
		if (!empty($_GET['author'])){
		    $serachs[]="author like '%{$_GET['title']}%'";
		    $urllist[]="author={$_GET['author']}";
		}
		
		//组装搜索条件
		if (count($serachs)>0){
		    $where = "where ".implode(" and ", $serachs);
		    $url = "&".implode("&",$urllist);
		}
		//****************page begin************************//
		//分页变量
		$page= isset($_GET['page'])?$_GET['page']:1;//
		$pageSize=3;//页大小
		$maxRows=null;//最大数据条
		$maxPages=null;//最大页数
		
		//获取最大数据条数
		$sql="SELECT COUNT(*) FROM news {$where}";
		$res=$link->query($sql);
	    $nums=$res->fetch_row();//取得结果集中一条记录作为索引数组返回
	    $maxRows=$nums[0];
	    
		//计算出最大页数
		$maxPages=ceil($maxRows/$pageSize);
		
		//校验当前页数
		if ($page>$maxPages){
		    $page=$maxPages;
		}
		if ($page<1){
		    $page=1;
		}
		
		
		//拼接分页SQL语句片段
		$limit=" LIMIT ".(($page-1)*$pageSize).",{$pageSize}";
		//****************page end**************************//
		//3. 执行查询，并返回结果集
		$sql="SELECT * FROM news {$where} ORDER BY addtime DESC {$limit}";
		//echo $sql;
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
	<?php
					//输出分页信息，显示上一页和下一页的连接
					echo "<br/><br/>";
					echo "当前{$page}/{$maxPages}页 共计{$maxRows}条";
					echo " <a href='splist.php?page=1{$url}'>首页</a> ";
					echo " <a href='splist.php?page=".($page-1)."{$url}'>上一页</a> ";
					echo " <a href='splist.php?page=".($page+1)."{$url}'>下一页</a> ";
					echo " <a href='splist.php?page={$maxPages}{$url}'>末页</a> ";
				?>
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
