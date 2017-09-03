define(['tip'],function(t){
	var modal={};
	var par=$('#select-class');
	var url=$('#select-class').data('url');
	var readList=function(dom,id){
		$.ajax({
			url:url.replace('[id]',id),
			datatype:'get',
			success:function(data){
				if(data.code===0){
					$.each(data.result.list,function(){
						if(this.sub){
							var h='&nbsp;<a id="sub-click" href="javascript:void(0);"><i class="am-icon am-icon-hand-o-right"></i></a>&nbsp;';
						}else{
							var h='';
						}
						modal.classid=this.classid;
						dom.append('<li data-id="'+this.id+'" data-name="'+this.title+'"><p class="am-margin-xs">'+h+this.title+'<a id="select-click" class="am-fr"><i class="am-icon am-icon-check-square-o"></i></a></p></li>');
					});
				}
			}
		});
	};
	$('#select-class').on('opened.modal.amui',function(){
		var dom=$(this).find('.am-modal-bd .classlist');
		dom.empty();
		readList(dom,0);

	});

	$('#select-class').on('click','#back',function(){
		var dom=par.find('.am-modal-bd .classlist');
		dom.empty();
		$.ajax({
			url:url.replace('[id]',modal.classid)+'&first=1',
			datatype:'json',
			success:function(data){
				if(data.code==0){
					readList(dom,data.result.data.classid);
				}
			},error:function(e){
				t.msg(e.status);
			}
		});

	});

	// 下级栏目
	$('#select-class').on('click','#sub-click',function(){
		var dom=$('#select-class .am-modal-bd .classlist');
		dom.empty();
		var id=$(this).parent().parent().data('id');
		readList(dom,id);
	});

	// 选定栏目
	$('#select-class').on('click','#select-click',function(){
		var dom=$(this).parent().parent();
		$('#classid').val(dom.data('id'));
		$('#classname').val(dom.data('name'));
		$('#select-class').modal('close');
	});
});