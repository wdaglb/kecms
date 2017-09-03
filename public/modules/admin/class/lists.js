define(['common','tip'],function(c,t){
	c.submit('form',{
		type:'post',
		success:function(data){
			t.msg(data.message);
			if(data.code===0){
				setTimeout(function(){
					loadURL(data.result.url);
				},1000);
			}
		},error:function(code,msg){
			t.msg('['+code+']'+msg);
		}
	});


	// readList
	var url=$('#classlist').data('url');
	var dom=$('#classlist').find('#ajaxItem');
	var item=$('#classlist').find('#ajaxItem').html();
	dom.remove();
	var content=$('#classlist');

	var insertItem=function(con,id,classStr,dom){
		$.ajax({
			url:url.replace('[id]',id),
			datatype:'get',
			complete:function(){
				if(dom!==undefined){
					dom.removeClass('am-icon-spinner').removeClass('am-icon-spin');
					if(id!=0){
						dom.addClass('am-icon-minus-square-o');
					}
				}
			},
			success:function(data){
				if(data.code===0){
					$.each(data.result.list,function(){
						var h=item.trim();
						if(this.sub){
							h=h.replace('<!--[plus]-->','<span id="plus" class="am-icon am-icon-fw am-icon-xs am-icon-plus-square-o am-text-success"></span>');
						}else{
							h=h.replace('<!--[plus]-->','<span class="am-icon am-icon-fw am-icon-square-o am-text-success"></span>');
						}
						h=h.replace(/<!--\[id\]-->/g,this.id);
						h=h.replace(/<!--\[title\]-->/g,this.title);
						h=h.replace(/<!--\[px\]-->/g,this.px);
						h=h.replace(/<!--\[class\]-->/g,classStr);

						con.append(h);
					});
				}else{
					t.msg(data.message);
				}
			},error:function(e){
				t.msg(e.status);
			}
		});
	}

	insertItem(content,0,'',$('#loading'));

	// 加载下级栏目
	content.on('click','#plus',function(){
		var dom=$(this);
		var sub=dom.parent().parent().parent();
		//refresh 
		if(dom.hasClass('am-icon-plus-square-o')){
			dom.removeClass('am-icon-plus-square-o').addClass('am-icon-spinner').addClass('am-icon-spin');
			//am-icon-minus-square-o
			insertItem(sub,sub.attr('classid'),'classlist-sub',dom);
		}else{
			dom.removeClass('am-icon-minus-square-o').addClass('am-icon-plus-square-o');
			sub.find('.classlist-sub').remove();
		}
	});
});