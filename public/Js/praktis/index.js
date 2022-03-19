$(document).ready(function(){
    $(":radio").change(function(){
        var data = $(this).val();
        if($(this).is(":checked")){
            $("."+data).removeAttr('disabled');
        }else{
            $("."+data).attr('disabled','');
        }
    })
});