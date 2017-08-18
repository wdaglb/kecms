define(['common'],function(module){
    $("#form").submit(function() {
        var data=$(this).serialize();
        $(this).ajaxSubmit(function() {
            console.log(data);
            module.Ajax({
                data:data,
                type:'post',
                success:function(data){
                    layer.msg(data.message);
                    if(data.code==0){
                        setTimeout(function(){
                            location.href=data.result.url;
                        },1500);
                    }
                }
            });
        });
        return false;
    });
});