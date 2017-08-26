define(function(){
	var model={};
	var cen=0;

	/**
	 * 关闭层
	 * @param  {long} index 层索引
	 */
	model.close=function(index){
		$('html #tip_'+index).remove();
	};
	/**
	 * 询问
	 * @param  {string} message 提示内容
	 * @param  {object} queding 确定回调
	 * @param  {object} quxiao  取消回调
	 */
	model.confirm=function(message,queding,quxiao){
		cen++;
        var htm='<div id="tip_'+cen+'" class="ke-tip"><div id="dia" class="ke-tip-dia"><h3>提示</h3><div class="ke-tip-message">'+message+'</div><ul class="ke-tip-btn-group"><li><span id="canel">取消</span></li><li><span id="ok">确定</span></li></ul></div>';
		$('html').append(htm);
		var dom=$('#tip_'+cen+' #dia');
		var x=$(window).width()/2-dom.width()/2;
		var y=$(window).height()/2-dom.height()/2;
		dom.css({left:x,top:y});
		$('#tip_'+cen).on('click','#canel',function(){
			$('#tip_'+cen).remove();
			if(quxiao!==undefined){
				quxiao();
			}
		});
		
		$('#tip_'+cen).on('click','#ok',function(){
			$('#tip_'+cen).remove();
			if(queding!==undefined){
				queding();
			}
		});

		return cen;
	};
	/**
	 * 消息提示
	 * @param  {string} message 消息内容
	 */
	model.msg=function(message){
		cen++;
		var ids=cen;
		var htm='<div id="tip_'+cen+'" class="ke-tip"><div id="dia" class="ke-tip-dia"><h3>提示</h3><div class="ke-tip-message">'+message+'</div><ul class="ke-tip-btn-group"><li><span id="ok">确定</span></li></ul></div>';

		$('html').append(htm);
		var dom=$('#tip_'+cen+' #dia');
		var x=$(window).width()/2-dom.width()/2;
		var y=$(window).height()/2-dom.height()/2;
		dom.css({left:x,top:y});
		
		$('#tip_'+cen).on('click','#ok',function(){
			$('#tip_'+cen).remove();
		});
		return cen;
	};
	return model;
});