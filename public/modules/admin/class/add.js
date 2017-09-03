define(['common','tip','validate','admin/class/com'],function(c,t,vali){
	c.submit('form',{
		type:'post',
		datatype:'json',
		start:function(data){
			vali.rule({
				'title':['require','max:20'],
				'module':['require']
			});
			if(!vali.check(data)){
				t.msg(vali.getError());
				return false;
			}
			return true;
		},
		success:function(data){
			t.msg(data.message);
			if(data.code===0){
				setTimeout(function(){
					location.href=data.result.url;
				},1000);
			}
		},error:function(code,msg){
			t.msg('['+code+']'+msg);
		}
	});
});