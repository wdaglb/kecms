define(['tip'],function(s){
	$('#logout').click(function(){
		var url=$(this).attr('href');
		s.confirm('您确定要退出系统吗?',function(){
			location.href=url;
		});
		return false;
	});
});