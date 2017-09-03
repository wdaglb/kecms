define(['common','tip'],function(c,t){
    $('[id="delete"]').on('click',function(){
        var id=$(this).data('id');
        var url=$(this).data('url');
        t.confirm('你确定要删除这个记录吗?',function(){
            c.Ajax({
                url:url,
                type:'post',
                data:{id:id},
                success:function(data){
                    t.msg(data.message);
                    if(data.code==0){
                        setTimeout(function(){
                            location.href=location.href;
                        },1000);
                    }
                },error:function(e){
                    t.msg(e.status);
                }
            });
        });
        return false;
    });
});