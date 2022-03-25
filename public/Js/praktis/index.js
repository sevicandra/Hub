$(document).ready(function(){
    $(":checkbox").change(function(){
        var data = $(this).val();
        if($(this).is(":checked")){
            $("."+data).removeAttr('disabled');
        }else{
            $("."+data).attr('disabled','');
        }
    })
});