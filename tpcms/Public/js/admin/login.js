/**
 * 前端登录业务类
 * @author Leo
 */
 var login ={
 	check:function(){
 		//alert(1);
 		//	获取登录页面中的用户名和密码
 		var username =$('input[name="username"]').val();
 		//alert(username);
 		var password =$('input[name="password"]').val();
 		//alert(password);
 		
 		if (!username) {
 			dialog.error('用户名不能为空');
 		}
 		if (!password) {
 			dialog.error('密码不能为空');
 		}
		
 		var url="/index.php?m=admin&c=login&a=check";
 		var data={'username':username,'password':password};
 		//执行异步请求 $.post
 		$.post(url,data,function(result){
 			if (result.status== 0) {
 				return dialog.error(result.message);
 			}
 			if (result.status== 1) {
 				return dialog.success(result.message,'index.php?m=admin&c=index');
 			}
 		},'JSON');//JSON
 	}
 }