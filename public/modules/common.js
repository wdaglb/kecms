define(function(){
	var model={};
	model.hideLoad=function(){
		$.hidePreloader();
	}
	model.Ajax=function(option,loading){
		if(loading===undefined || loading==true){
			$.showPreloader();
		}
		if(typeof(option.data)=='object'){
			option.data._token_=token;
		}else{
			option.data=option.data+'&_token_='+token;
		}
	    option.datatype=option.datatype===undefined ? 'json' : option.datatype;
	    option.timeout=option.timeout===undefined ? 15000 : option.timeout;
	    $.ajax(option);
	}
	return model;
});