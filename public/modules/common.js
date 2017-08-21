define(function(){
	var model={};

	model.reload=function(){
		var $id=top.$('[name="main"]');
		$id.prop('src',location.href);
	}

	model.Ajax=function(option,loading){
		if(loading===undefined || loading==true){
			//$.showPreloader();
		}
		if(typeof(option.data)=='object'){
			option.data._token_=token;
		}else{
			option.data=option.data+'&_token_='+token;
		}
        option.contenttype="application/x-www-data-urlencoded;charset=utf-8";
	    option.datatype=option.datatype===undefined ? 'json' : option.datatype;
	    option.timeout=option.timeout===undefined ? 15000 : option.timeout;
	    $.ajax(option);
	};
	model.include=function(link){
		console.log(window.document.location.pathname);
        //document.write('<link rel="stylesheet" href="' + link + '"/>');
        $('head').append('<link rel="stylesheet" href="' + web_path + link + '"/>');
	};
	return model;
});