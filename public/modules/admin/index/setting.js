define(['common','tip'],function(c,t){
	var initTabs=function(){
        var index=$('.tabs .tabs-head li.active').index();
        $('.tabs .tabs-body li').hide();
        $('.tabs .tabs-body li:eq('+index+')').show();
	}
	initTabs();

	$('.tabs .tabs-head').on('click','li',function(){
        $('.tabs .tabs-head li').removeClass('active');
        $(this).addClass('active');
        initTabs();
	});
	$('#form').submit(function(){
		var $dom=$(this);
		c.Ajax({
			type:'post',
			data:$dom.serialize(),
			success:function(data){
				t.msg(data.message);
			}
		});
		return false;
	});
});