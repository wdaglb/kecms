define(function(){
	var message={
		require:'[form]为必填项',
		min:'[form]应大于[min]个字符',
		max:'[form]应小于[max]个字符',
		int:'[form]应输入数值型内容'
	};
	var rule={
		_require:function(form){
			if(modal.formData[form]===undefined || modal.formData[form].length===0){
				modal.error=message.require.replace('[form]',form);
				return false;
			}
			return true;
		},
		_min:function(form,len){
			if(this._require(form)){
				if(modal.formData[form].length>len){
					modal.error=message.max.replace('[form]',form).replace('[min]',len);
					return false;
				}
			}
			return true;
		},
		_max:function(form,len){
			if(this._require(form)){
				if(modal.formData[form].length>len){
					modal.error=message.max.replace('[form]',form).replace('[max]',len);
					return false;
				}
			}
			return true;
		}
	};
	var modal={
		ruleData:{},
		formData:{},
		error:'',
		rule:function(data){
			this.ruleData=data;
		},
		check:function(data){
			this.formData=data;
			var bool=true;
			$.each(this.ruleData,function(index,item){
				$.each(item,function(){
					if(this.indexOf(':')==-1){
						var s=eval('rule._'+this+'("'+index+'")');
					}else{
						var tmp=this.split(':',2);

						var s=eval('rule._'+tmp[0]+'("'+index+'",'+parseInt(tmp[1])+')');
					}
					if(s===false){
						bool=false;
						return false;
					}
					//call('rule.'+this,data[index]);
				});
				if(bool==false){
					return false;
				}
			});
			return bool;
		},
		getError:function(){
			return this.error;
		}
	};
	return modal;
});