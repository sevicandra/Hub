$(document).ready(function(){
    $(":radio").change(function(){
        var name = $(this).attr("name");
        var val = $(this).val();
        for (let index = 1; index <= 10; index++) {
            $('#'+name.split("[")[0]+'-'+val.split('.')[1]+'-'+index+'-ico').attr('src', 'best employee/img/ico/'+index+'.svg')
        }
        $('#'+name.split("[")[0]+'-'+val.split('.')[1]+'-'+val.split('.')[0]+'-ico').attr('src','best employee/img/ico/'+val.split('.')[0]+'-fill.svg');
    });
});


