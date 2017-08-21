define(['common'],function(c){
	$('#form').submit(function(){
		c.Ajax({
			url:$(this).prop('action'),
			type:'post',
			data:$(this).serialize(),
			success:function(data){
				$('#tip').html(data.message);
				if(data.code==0){
					c.reload();
				}
			}
		});
		return false;
	});
});