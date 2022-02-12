$(document).ready(function(){ 
  var today = new Date();
  var date = today. getFullYear()+'-'+today.getMonth()+1+'-'+today. getDate();      
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
				$.each(response, function(res, req){
					$('#agenda').append(`<div class="row" style="margin-bottom: 5px"><div class="col-sm-2" style="margin-left: 5px"><img src="img/ico.png" style="height:50px" alt=""> </div> <div class="col-sm-9" style="background-color: #ffffff; border-radius:10px"> <h1>${req.Judul}</h1> <p>Lorem ipsum dolor sit amet.</p> <h2>${req.tanggal}</h2> </div>  </div>`);
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
          $.each(response, function(res, req){
            $('#agenda').append('<div class="row" style="margin-bottom: 5px"><div class="col-sm-2" style="margin-left: 5px"> <img src="img/ico.png" style="height:50px" alt=""> </div> <div class="col-sm-9" style="background-color: #ffffff; border-radius:10px"> <h1>'+req.Judul+'</h1> <p>Lorem ipsum dolor sit amet.</p> <h2>'+req.tanggal+'</h2> </div> </div>');
          })
          },
        });
      }
    })
})