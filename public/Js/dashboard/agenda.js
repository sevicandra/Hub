$(document).ready(function(){ 
  var today = new Date();
  var date = today. getFullYear()+'-'+(today.getMonth()+1)+'-'+today. getDate();
  if(date){
    $.ajax({
		  type: "POST", 
			url: "/asd",
			dataType: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
              dates:date,
            },
			success: function(response){ 
				$.each(response[0], function(res, req){
          if (req.user_id === response['user']) {
            var csrf = '<input type="hidden" name="_token" value="'+$('meta[name="csrf-token"]').attr('content')+'"></input>'
            var methods = '<input type="hidden" name="_method" value="DELETE">'
            var hapus = `<div class="row"><div><form method="POST" action="/agenda/${req.id}">${csrf}${methods}<button type="submit" class="btn" style="color:red; width:100%; border:solid 1px #E3BEC6; background-color:#E3BEC6; color:#ffffff; border-radius: 10px">Hapus Agenda</i></button></form></div></div>`
          }else{
            var hapus = ''
          }

          var waktu = '<div class="p-2">'+req.waktu+'</div>'
          var Agenda = '<div class="p-2">'+req.agenda+'</div>'
          var tempat = '<div class="row"><div class="d-flex"><div class="p-2">Lokasi :</div><div class="p-2">'+req.tempat+'</div></div></div>'
          if (req.meetingId && req.meetingPassword) {
            var meetingRoom = '<div class="row"><div class="d-flex" style="text-align: center"><div style="width: 50%">Meeting Id</div><div style="width: 50%">Password</div></div></div><div class="row"><div class="d-flex" style="text-align: center"><div style="width: 50%">'+req.meetingId+'</div><div style="width: 50%">'+req.meetingPassword+'</div></div></div>'
          }else{
            var meetingRoom = ''
          }
          if (req.linkRapat) {
            var linkRapat = '<div style="width: 50%"><form target="_blank" action="'+req.linkRapat+'" style="width:100%; height:100%"><button class="btn" style="color:#FAFFE5; border:solid 1px #FAFFE5; background-color:#1572A1; height:100%;width:100%; border-radius: 10px">Masuk Room Zoom</button></form></div>'
          }else{
            var linkRapat = ''
          }
          if (req.linkAbsensi) {
            var linkAbsensi = '<div style="width: 50%"><form target="_blank" action="'+req.linkAbsensi+'" style="width:100%; height:100%"><button class="btn" style="color:#FAFFE5; border:solid 1px #FAFFE5; background-color:#1572A1; height:100%;width:100%; border-radius: 10px">Presensi</button></form></div>'
          }else{
            var linkAbsensi = ''
          }
          ''
          $('#agenda').append('<div style="background-color:#9AD0EC; color: #ffffff; border-radius:10px;margin-top:10px"><div class="row"><div class="d-flex">'+waktu+'<div class="vr"></div>'+Agenda+'</div></div>'+tempat+meetingRoom+'<div class="row"><div class="d-flex">'+linkRapat+linkAbsensi+'</div></div>'+hapus+'</div>');
        });
			},
		});
  }
  $('#tanggalagenda').change(function(){
    var date = $(this).val();
    if(date){
      $.ajax({
        type: "POST", 
        url: "/asd",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
        data: {dates:date},
        success: function(response){
          $('#agenda').empty();
          $.each(response[0], function(res, req){
            if (req.user_id === response['user']) {
              var csrf = '<input type="hidden" name="_token" value="'+$('meta[name="csrf-token"]').attr('content')+'"></input>'
              var methods = '<input type="hidden" name="_method" value="DELETE">'
              var hapus = `<div class="row"><div><form method="POST" action="/agenda/${req.id}">${csrf}${methods}<button type="submit" class="btn" style="color:red; width:100%; border:solid 1px #E3BEC6; background-color:#E3BEC6; color:#ffffff; border-radius: 10px">Hapus Agenda</i></button></form></div></div>`
            }else{
              var hapus = ''
            }
            
            var waktu = '<div class="p-2">'+req.waktu+'</div>'
          var Agenda = '<div class="p-2">'+req.agenda+'</div>'
          var tempat = '<div class="row"><div class="d-flex"><div class="p-2">Lokasi :</div><div class="p-2">'+req.tempat+'</div></div></div>'
          if (req.meetingId && req.meetingPassword) {
            var meetingRoom = '<div class="row"><div class="d-flex" style="text-align: center"><div style="width: 50%">Meeting Id</div><div style="width: 50%">Password</div></div></div><div class="row"><div class="d-flex" style="text-align: center"><div style="width: 50%">'+req.meetingId+'</div><div style="width: 50%">'+req.meetingPassword+'</div></div></div>'
          }else{
            var meetingRoom = ''
          }
          if (req.linkRapat) {
            var linkRapat = '<div style="width: 50%"><form target="_blank" action="'+req.linkRapat+'" style="width:100%; height:100%"><button class="btn" style="color:#FAFFE5; border:solid 1px #FAFFE5; background-color:#1572A1; height:100%;width:100%; border-radius: 10px">Masuk Room Zoom</button></form></div>'
          }else{
            var linkRapat = ''
          }
          if (req.linkAbsensi) {
            var linkAbsensi = '<div style="width: 50%"><form target="_blank" action="'+req.linkAbsensi+'" style="width:100%; height:100%"><button class="btn" style="color:#FAFFE5; border:solid 1px #FAFFE5; background-color:#1572A1; height:100%;width:100%; border-radius: 10px">Presensi</button></form></div>'
          }else{
            var linkAbsensi = ''
          }
          ''
          $('#agenda').append('<div style="background-color:#9AD0EC; color: #ffffff; border-radius:10px;margin-top:10px"><div class="row"><div class="d-flex">'+waktu+'<div class="vr"></div>'+Agenda+'</div></div>'+tempat+meetingRoom+'<div class="row"><div class="d-flex">'+linkRapat+linkAbsensi+'</div></div>'+hapus+'</div>');
          });
          },
        });
      }
    })
})

