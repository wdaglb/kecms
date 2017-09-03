define(['common','tip'],function(c,t){
    $('#form').submit(function(){
        var $dom=$(this);
        c.Ajax({
            type:'post',
            data:$dom.serialize(),
            success:function(data){
                if(data.code===0){
                    t.msg(data.message,'success');
                }else{
                    t.msg(data.message);
                }
            }
        });
        return false;
    });
});