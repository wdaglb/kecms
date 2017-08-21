define(['common'],function(c){
	$('#form').submit(function(){
		var $dom=$(this);
		c.Ajax({
			type:'post',
			data:$dom.serialize(),
			success:function(data){
				$dom.before('<div class="am-alert am-alert-danger" data-am-alert><button type="button" class="am-close">&times;</button><p>'+data.message+'</p></div>');
				var $id=$('#form').parent().find('.am-alert:last');
				setTimeout(function(){
					$id.alert('close');
				},3000);
			}
		});
		return false;
	});
});