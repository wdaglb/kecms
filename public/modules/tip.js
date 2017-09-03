define(function(){
	var model={};

	/**
	 * 关闭层
	 * @param  {long} index 层索引
	 */
	model.close=function(index){
		var dom=$('body #ke-alert-'+index);
		if(dom.hasClass('am-alert')){
			dom.alert('close');
		}else{
			dom.modal('close');
		}
	};
	/**
	 * loading
	 */
	model.load=function(){
		var ids=new Date().getTime();
        var htm='<div id="ke-alert-'+ids+'" class="am-modal am-modal-loading am-modal-no-btn" tabindex="-1"><div class="ke-load"><span class="am-icon-spinner am-icon-pulse am-icon-lg"></span></div>';
		$('body').append(htm);
		var dom=$('#ke-alert-'+ids);
		//var x=$(window).width()/2-dom.find('.ke-load').width()/2;
		//var y=$(window).height()/2-dom.find('.ke-load').height()/2;
		//dom.find('.ke-load').css({left:x+'px',top:y+'px'});

		dom.modal({});
		$('#ke-alert-'+ids).on('closed.modal.amui',function(){
			$(this).remove();
		});


		return ids;
	};
	/**
	 * 询问
	 * @param  {string} message 提示内容
	 * @param  {object} queding 确定回调
	 * @param  {object} quxiao  取消回调
	 */
	model.confirm=function(message,queding,quxiao){
		var ids=new Date().getTime();
        var htm='<div id="ke-alert-'+ids+'" class="am-modal am-modal-confirm" tabindex="-1"><div class="am-modal-dialog"><div class="am-modal-hd">提示</div><div class="am-modal-bd">'+message+'</div><div class="am-modal-footer"><span class="am-modal-btn" data-am-modal-cancel>取消</span><span class="am-modal-btn" data-am-modal-confirm>确定</span></div></div></div>';
		$('body').append(htm);
		$('#ke-alert-'+ids).modal({
			onConfirm:queding,
			onCancel:quxiao
		});
		$('#ke-alert-'+ids).on('closed.modal.amui',function(){
			$(this).remove();
		});

		return ids;
	};
	/**
	 * 消息提示
	 * @param  {string} message 消息内容
	 */
	model.msg=function(message,type){
		type=type===undefined ? 'warning' : type;
		var ids=new Date().getTime();
		var htm='<div id="ke-alert-'+ids+'" class="am-alert am-alert-'+type+' ke-alert" data-am-alert><button type="button" class="am-close">&times;</button><p>'+message+'</p></div>';

		$('body').append(htm);
		var dom=$('#ke-alert-'+ids);
		var x=$(window).width()/2-dom.width()/2;
		dom.css({left:x});

		var tim=setTimeout(function(){
			dom.alert('close');
		},2500);
		dom.on('closed.alert.amui', function() {
			$(this).remove();
			clearTimeout(tim);
		});


		return ids;
	};
	return model;
});