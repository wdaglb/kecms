define(function(){
	var model={};
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
	}
	return model;
});