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
	c.submit('form',{
		type:'post',
		success:function(data){
			t.msg(data.message);
		},error:function(code,msg){
			t.msg('['+code+']'+msg);
		}
	});
});