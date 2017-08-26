define(['tip'],function(s){
	$('#logout').click(function(){
		var url=$(this).attr('href');
		s.confirm('您确定要退出系统吗?',function(){
			location.href=url;
		});
		return false;
	});

	$('.sidebar .sidebar-head').on('click','a',function(){
		if(!$(this).prop('target')){
			var $id=$(this).find('.fa');
			var $ids=$(this).parent().find('.sidebar-sub');
			if($ids.is(':hidden')){
                $id.removeClass('fa-angle-down');
                $id.addClass('fa-angle-right');
			}else{
                $id.removeClass('fa-angle-right');
                $id.addClass('fa-angle-down');
			}
			$ids.slideToggle();
		}
	});
});