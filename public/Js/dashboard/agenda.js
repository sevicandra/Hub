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
            var hapus = `<div style="padding-right:0" class="col-sm-2"><form method="POST" action="/agenda/${req.id}">${csrf}${methods}<button type="submit" class="btn" style="color: red"><i class="bi bi-journal-x"></i></button></form></div>`
          }else{
            var hapus = ''
          }
          
          var waktu = '<div class="row"><div style="padding-right:0" class="col"><h5 style="color: #4D5299">'+req.waktu+'</h5></div>'+hapus+'</div>'
          var Agenda = '<div><h4 style="text-align: justify">'+req.agenda+'</h4></div>'
          var tempat = '<div class="row"><div style="padding-right:0" class="col-sm-4"><h5>Tempat</h5></div><div style="padding-right:0" class="col-sm-1"><h5>:</h5></div><div style="padding-right:0" class="col-sm-7"><h5>'+req.tempat+'</h5></div></div>'
          if (req.meetingId) {
            var meetingId = '<div class="row"><div style="padding-right:0" class="col-sm-4"><h5>Meeting id</h5></div><div style="padding-right:0" class="col-sm-1"><h5>:</h5></div><div style="padding-right:0" class="col-sm-7"><h5>'+req.meetingId+'</h5></div></div>'
          }else{
            var meetingId = ''
          }
          if (req.meetingPassword) {
            var meetingPassword = '<div class="row"><div style="padding-right:0" class="col-sm-4"><h5>Password</h5></div><div style="padding-right:0" class="col-sm-1"><h5>:</h5></div><div style="padding-right:0" class="col-sm-7"><h5>'+req.meetingPassword+'</h5></div></div>'
          }else{
            var meetingPassword = ''
          }
          if (req.linkRapat) {
            var linkRapat = '<div class="col"><form action="http://'+req.linkRapat+'" target="_blank"><button type="submit" class="btn btn-success">Masuk Room</button></form></div>'
          }else{
            var linkRapat = ''
          }
          if (req.linkAbsensi) {
            var linkAbsensi = '<div class="col"><form action="http://'+req.linkAbsensi+'" target="_blank"><button type="submit" class="btn btn-success">Isi Presensi</button></form></div>'
          }else{
            var linkAbsensi = ''
          }
          $('#agenda').append('<div class="row" style="margin-bottom: 2%"><div class="col-sm-12" style="border-radius:10px; background-color:#E6F5FF;">'+waktu+Agenda+tempat+meetingId+meetingPassword+'<div class="row" style="margin-bottom:10px">'+linkRapat+linkAbsensi+'</div></div></div>');
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
              var hapus = `<div style="padding-right:0" class="col-sm-2"><form method="POST" action="/agenda/${req.id}">${csrf}${methods}<button type="submit" class="btn" style="color: red"><i class="bi bi-journal-x"></i></button></form></div>`
            }else{
              var hapus = ''
            }
            
            var waktu = '<div class="row"><div style="padding-right:0" class="col"><h5 style="color: #4D5299">'+req.waktu+'</h5></div>'+hapus+'</div>'
            var Agenda = '<div><h4 style="text-align: justify">'+req.agenda+'</h4></div>'
            var tempat = '<div class="row"><div style="padding-right:0" class="col-sm-4"><h5>Tempat</h5></div><div style="padding-right:0" class="col-sm-1"><h5>:</h5></div><div style="padding-right:0" class="col-sm-7"><h5>'+req.tempat+'</h5></div></div>'
            if (req.meetingId) {
              var meetingId = '<div class="row"><div style="padding-right:0" class="col-sm-4"><h5>Meeting id</h5></div><div style="padding-right:0" class="col-sm-1"><h5>:</h5></div><div style="padding-right:0" class="col-sm-7"><h5>'+req.meetingId+'</h5></div></div>'
            }else{
              var meetingId = ''
            }
            if (req.meetingPassword) {
              var meetingPassword = '<div class="row"><div style="padding-right:0" class="col-sm-4"><h5>Password</h5></div><div style="padding-right:0" class="col-sm-1"><h5>:</h5></div><div style="padding-right:0" class="col-sm-7"><h5>'+req.meetingPassword+'</h5></div></div>'
            }else{
              var meetingPassword = ''
            }
            if (req.linkRapat) {
              var linkRapat = '<div class="col"><form action=="http://'+req.linkRapat+'" target="_blank"><button type="submit" class="btn btn-success">Masuk Room</button></form></div>'
            }else{
              var linkRapat = ''
            }
            if (req.linkAbsensi) {
              var linkAbsensi = '<div class="col"><form action=="http://'+req.linkAbsensi+'" target="_blank"><button type="submit" class="btn btn-success">Isi Presensi</button></form></div>'
            }else{
              var linkAbsensi = ''
            }
            $('#agenda').append('<div class="row" style="margin-bottom: 2%"><div class="col-sm-12" style="border-radius:10px; background-color:#E6F5FF">'+waktu+Agenda+tempat+meetingId+meetingPassword+'<div class="row" style="margin-bottom:10px">'+linkRapat+linkAbsensi+'</div></div></div>');
          });
          },
        });
      }
    })
})

