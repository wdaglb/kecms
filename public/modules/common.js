define(['tip'],function(t){
	var model={};

	model.reload=function(){
		var $id=top.$('[name="main"]');
		$id.prop('src',location.href);
	}

	model.formToJson=function(dom){
		var arr=dom.serializeArray();
		var $form={};

		$.each(arr,function(){
			if($form[this.name]){
				if(!$form[this.name].push){
					$form[this.name]=[$form[this.name]];
				}
				$form[this.name].push(this.value || '');
			}else{
				$form[this.name]=this.value || '';
			}
		});
		
		/*for (var item in arr) {
			$form[arr[item].name]=arr[item].value;
		}*/
		return $form;
	}

	/*<
	 * 表单提交
	 * @param  {string} id     表单ID
	 * @param  {string} option 参数
	 */
	model.submit=function(id,config){
		var dom=$('#'+id);
		dom.on('submit',function(){
			var option=config;

			//option.data=dom.serialize();
			option.data=model.formToJson(dom);
			if(config.data!==undefined){
				option.data._token_=config.data;
			}
			if(option.start!==undefined){
				if(option.start(option.data)==false){
					return false;
				}
			}
			var $btn = dom.find('[type="submit"]');
			$btn.button('loading');
			option.complete=function(){
				$btn.button('reset');
			};
			model.Ajax(option);
			return false;
		});
	}

	model.Ajax=function(option){
		var error=option.error;
		if(typeof(option.data)=='object'){
			option.data._token_=token;
		}else{
			option.data=option.data+'&_token_='+token;
		}


        option.contenttype="application/x-www-data-urlencoded;charset=utf-8";
	    option.datatype=option.datatype===undefined ? 'json' : option.datatype;
	    option.timeout=option.timeout===undefined ? 15000 : option.timeout;
	    option.error=function(e){
	    	error(e.status,e.statusText,e.responseText);
	    };
	    $.ajax(option);
	};
	model.include=function(link){
		console.log(window.document.location.pathname);
        //document.write('<link rel="stylesheet" href="' + link + '"/>');
        $('head').append('<link rel="stylesheet" href="' + web_path + link + '"/>');
	};


	return model;
});