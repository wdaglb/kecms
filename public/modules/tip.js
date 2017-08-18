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
		var htm='<div id="tip_'+cen+'" style="position:absolute;top:0;bottom:0;left:0;right:0;background:#000;background:rgba(0,0,0,0.7)"><div id="dia" style="position:fixed;z-index:9999;min-width:400px;background:#fff;border:solid 1px #dddddd;border-radius:5px"><h3 style="border-radius:8px 8px 0 0;padding:5px 10px 5px 10px;background:#F5F5F5;font-weight:bold;">提示</h3><div style="padding:10px;">'+message+'</div><div style="border-top:solid 1px #dddddd;text-align:right;"><a id="quxiao" href="javascript:void(0);" style="font-size:12px;display:inline-block;padding:5px 15px 5px 15px;border:solid 1px #ddd;border-radius:5px;margin:5px">取消</a><a id="queding" href="javascript:void(0);" style="font-size:12px;display:inline-block;padding:5px 15px 5px 15px;border:solid 1px #22CC77;border-radius:5px;margin:5px;background:#22CC77;color:#fff">确定</a></div></div></div>';
		$('html').append(htm);
		var dom=$('#tip_'+cen+' #dia');
		var x=$(window).width()/2-dom.width()/2;
		var y=$(window).height()/2-dom.height()/2;
		dom.css({left:x,top:y});
		$('#tip_'+cen).on('click','#quxiao',function(){
			$('#tip_'+cen).remove();
			if(quxiao!==undefined){
				quxiao();
			}
		});
		
		$('#tip_'+cen).on('click','#queding',function(){
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
	 * @param  {boolean} btn    是否阻塞
	 */
	model.msg=function(message,btn,timer){
		cen++;
		var ids=cen;
		timer = timer===undefined ? 3 : timer;
		var htm='<div id="tip_'+cen+'" style="[[style]]"><div id="dia" style="position:fixed;z-index:9999;min-width:400px;background:#fff;border:solid 1px #dddddd;border-radius:5px"><h3 style="border-radius:8px 8px 0 0;padding:5px 10px 5px 10px;background:#F5F5F5;font-weight:bold;">提示</h3><div style="padding:10px;">'+message+'</div>[[btn]]</div></div>';
		if(btn==true){
			htm=htm.replace('[[style]]','position:absolute;top:0;bottom:0;left:0;right:0;background:#000;background:rgba(0,0,0,0.7)');
		}else{
			htm=htm.replace('[[style]]','');
		}
		htm=htm.replace('[[btn]]','<div style="border-top:solid 1px #dddddd;text-align:right;"><span id="timer" style="font-size:12px;color:red">'+timer+'秒后关闭此提示</span><a id="queding" href="javascript:void(0);" style="font-size:12px;display:inline-block;padding:5px 15px 5px 15px;border:solid 1px #22CC77;border-radius:5px;margin:5px;background:#22CC77;color:#fff">关闭</a></div>');
		$('html').append(htm);
		var dom=$('#tip_'+cen+' #dia');
		var x=$(window).width()/2-dom.width()/2;
		var y=$(window).height()/2-dom.height()/2;
		dom.css({left:x,top:y});
		
		$('#tip_'+cen).on('click','#queding',function(){
			$('#tip_'+cen).remove();
		});
		if(timer>0){
			var d=setInterval(function(){
				timer--;
				if(timer==0){
					$('#tip_'+ids).remove();
					clearInterval(d);
				}else{
					$('#tip_'+ids+' #timer').html(timer+'秒后关闭此提示');
				}
			},1000);
		}

		return cen;
	};
	return model;
});