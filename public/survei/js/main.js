$(document).ready(function(){
    $(":radio").change(function(){
        var name = $(this).attr("name");
        var val = $(this).val();
        $('#'+name+'1').attr('src', 'survei/img/ico/very-sad.png');
        $('#'+name+'2').attr('src', 'survei/img/ico/sad.png');
        $('#'+name+'3').attr('src', 'survei/img/ico/normal.png');
        $('#'+name+'4').attr('src', 'survei/img/ico/happy.png');
        $('#'+name+'5').attr('src', 'survei/img/ico/very-happy.png');
        switch (val) {
            case '1':
                var img = 'very-sad';
                break;
            case '2':
                var img = 'sad';
                break;
            case '3':
                var img = 'normal';
                break;
            case '4':
                var img = 'happy';
                break;
            case '5':
                var img = 'very-happy';
                break;
        }
        $('#'+name+val).attr('src','survei/img/ico/'+ img+'-fill.png');
    });
});
