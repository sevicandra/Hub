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
            var tanggal = new Date(req.tanggal).toLocaleDateString('en-US')
            var now = new Date().toLocaleDateString('en-US')
            var csrf = '<input type="hidden" name="_token" value="'+$('meta[name="csrf-token"]').attr('content')+'"></input>'
            var methods = '<input type="hidden" name="_method" value="DELETE">'
            if (now > tanggal) {
              var hapus = ''
            }else{                
              var hapus = `
              <div class="row">
                <div class="col-sm-6" style="padding-right:0">
                  <form class="d-inline" method="POST" action="/agenda/${req.id}">
                    ${csrf}${methods}
                    <button type="submit" class="btn" style="color:red; height:100%; width:100%; border:solid 1px #E3BEC6; background-color:#E3BEC6; color:#ffffff; border-radius: 10px">Hapus Agenda</button>
                  </form>
                </div>
                <div class="col-sm-6 d-inline" style="padding-left:0; height:100%">
                  <div style="border:solid 1px #E3E0A8;background-color:#E3E0A8; color:#ffffff; height:100%; width:100%;border-radius: 10px" class="btn" onclick="updateAgenda('${req.id}')">Update Agenda</div>
                </div>
              </div>`
            } 
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
            var linkRapat = '<div style="width: 50%"><a target="_blank" href="'+req.linkRapat+'"><button class="btn" style="color:#FAFFE5; border:solid 1px #FAFFE5; background-color:#1572A1; height:100%;width:100%; border-radius: 10px">Masuk Room Zoom</button></a></div>'
          }else{
            var linkRapat = ''
          }
          if (req.linkAbsensi) {
            var linkAbsensi = '<div style="width: 50%"><a target="_blank" href="'+req.linkAbsensi+'"><button class="btn" style="color:#FAFFE5; border:solid 1px #FAFFE5; background-color:#1572A1; height:100%;width:100%; border-radius: 10px">Presensi</button></a></div>'
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
              var tanggal = new Date(req.tanggal).toLocaleDateString('en-US')
              var now = new Date().toLocaleDateString('en-US')
              var csrf = '<input type="hidden" name="_token" value="'+$('meta[name="csrf-token"]').attr('content')+'"></input>'
              var methods = '<input type="hidden" name="_method" value="DELETE">'
              if (now > tanggal) {
                var hapus = ''
              }else{                
                var hapus = `
                <div class="row">
                  <div class="col-sm-6" style="padding-right:0">
                    <form class="d-inline" method="POST" action="/agenda/${req.id}">
                      ${csrf}${methods}
                      <button type="submit" class="btn" style="color:red; height:100%; width:100%; border:solid 1px #E3BEC6; background-color:#E3BEC6; color:#ffffff; border-radius: 10px">Hapus Agenda</button>
                    </form>
                  </div>
                  <div class="col-sm-6 d-inline" style="padding-left:0; height:100%">
                    <div style="border:solid 1px #E3E0A8;background-color:#E3E0A8; color:#ffffff; height:100%; width:100%;border-radius: 10px" class="btn" onclick="updateAgenda('${req.id}')">Update Agenda</div>
                  </div>
                </div>`
              } 
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
            var linkRapat = '<div style="width: 50%"><a target="_blank" href="'+req.linkRapat+'"><button class="btn" style="color:#FAFFE5; border:solid 1px #FAFFE5; background-color:#1572A1; height:100%;width:100%; border-radius: 10px">Masuk Room Zoom</button></a></div>'
          }else{
            var linkRapat = ''
          }
          if (req.linkAbsensi) {
            var linkAbsensi = '<div style="width: 50%"><a target="_blank" href="'+req.linkAbsensi+'"><button class="btn" style="color:#FAFFE5; border:solid 1px #FAFFE5; background-color:#1572A1; height:100%;width:100%; border-radius: 10px">Presensi</button></a></div>'
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

function updateAgenda(params) {
  if (params) {
    $.ajax({
      type: "GET", 
      url: "/agenda/"+params,
      dataType: "json",
      success:function (params) {
        console.log(params);
        $("#formUpdateAgenda").attr('action', '/agenda/'+params.id)
        $("#updateAgenda").val(params.agenda)
        $("#updateTanggal").val(params.tanggal)
        $("#updateWaktu").val(params.waktu)
        $("#updateTempat").val(params.tempat)
        $("#updateMeetingId").val(params.meetingId)
        $("#updateMeetingPassword").val(params.meetingPassword)
        $("#updateLinkRapat").val(params.linkRapat)
        $("#updateLinkAbsensi").val(params.linkAbsensi)
        var updateAgenda = new bootstrap.Modal(document.getElementById('updateAgendaModals'), {
          keyboard: false
        })
        updateAgenda.show()
      }
    })
  }
}

