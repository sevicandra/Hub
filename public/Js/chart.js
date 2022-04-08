// PNBP PKN
$(document).ready(function(){
    $.ajax({
        type:'POST',
        url:'/PNBPPKN',
        dataType:'json',
        data:{jenis:'PKN'},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            const capaian =[null,null,null,null,null,null,null,null,null,null,null,null]
            $.each(response, function(res, req) {
                switch (req.bulan) {
                    case '1':
                        capaian[0] = parseInt(req.capaian)
                        break;
                    case '2':
                        capaian[1] = parseInt(req.capaian)
                        break;
                    case '3':
                        capaian[2] = parseInt(req.capaian)
                        break;
                    case '4':
                        capaian[3] = parseInt(req.capaian)
                        break;
                    case '5':
                        capaian[4] = parseInt(req.capaian)
                        break;
                    case '6':
                        capaian[5] = parseInt(req.capaian)
                        break;
                    case '7':
                        capaian[6] = parseInt(req.capaian)
                        break;
                    case '8':
                        capaian[7] = parseInt(req.capaian)
                        break;
                    case '9':
                        capaian[8] = parseInt(req.capaian)
                        break;
                    case '10':
                        capaian[9] = parseInt(req.capaian)
                        break;
                    case '11':
                        capaian[10] = parseInt(req.capaian)
                        break;
                    case '12':
                        capaian[11] = parseInt(req.capaian)
                        break;
                }
            })
            const PNBPPKN = document.getElementById('linechartPNBPPKN').getContext('2d');
            const myChartPNBPPKN = new Chart(PNBPPKN,{
                type: 'line',
                data:{
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                    datasets: [
                        {
                            data: capaian,
                        }
                    ]
                },
                options:{
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                    scales: {
                        yAxes:{
                            grid:{
                                display:false,
                                
                            },
                        },
                        xAxes:{
                            grid:{
                                display:false,
                                
                            },
                        },
                    }
                }
            });

            const PNBPbarPKN = document.getElementById('barchartPNBPPKN').getContext('2d');
            const myChartbarPKN = new Chart(PNBPbarPKN,{
                type: 'bar',
                data:{
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                    datasets: [
                        {
                            data: [
                                capaian[0],
                                capaian[0]+capaian[1],
                                capaian[0]+capaian[1]+capaian[2],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4]+capaian[5],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4]+capaian[5]+capaian[6],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4]+capaian[5]+capaian[6]+capaian[7],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4]+capaian[5]+capaian[6]+capaian[7]+capaian[8],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4]+capaian[5]+capaian[6]+capaian[7]+capaian[8]+capaian[9],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4]+capaian[5]+capaian[6]+capaian[7]+capaian[8]+capaian[9]+capaian[10],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4]+capaian[5]+capaian[6]+capaian[7]+capaian[8]+capaian[9]+capaian[10]+capaian[11],
                            ],
                        }
                    ]
                },
                options:{
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                    scales: {
                        yAxes:{
                            grid:{
                                display:false,
                                
                            },
                        },
                        xAxes:{
                            grid:{
                                display:false,
                                
                            },
                        },
                    }
                }
            
            });
        }
    })
});

// PNBP LLG
$(document).ready(function(){
    $.ajax({
        type:'POST',
        url:'/PNBPLLG',
        dataType:'json',
        data:{jenis:'LLG'},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            const capaian =[null,null,null,null,null,null,null,null,null,null,null,null]
            $.each(response, function(res, req) {
                switch (req.bulan) {
                    case '1':
                        capaian[0] = parseInt(req.capaian)
                        break;
                    case '2':
                        capaian[1] = parseInt(req.capaian)
                        break;
                    case '3':
                        capaian[2] = parseInt(req.capaian)
                        break;
                    case '4':
                        capaian[3] = parseInt(req.capaian)
                        break;
                    case '5':
                        capaian[4] = parseInt(req.capaian)
                        break;
                    case '6':
                        capaian[5] = parseInt(req.capaian)
                        break;
                    case '7':
                        capaian[6] = parseInt(req.capaian)
                        break;
                    case '8':
                        capaian[7] = parseInt(req.capaian)
                        break;
                    case '9':
                        capaian[8] = parseInt(req.capaian)
                        break;
                    case '10':
                        capaian[9] = parseInt(req.capaian)
                        break;
                    case '11':
                        capaian[10] = parseInt(req.capaian)
                        break;
                    case '12':
                        capaian[11] = parseInt(req.capaian)
                        break;
                }
            })
            const PNBPLLG = document.getElementById('linechartPNBPLLG').getContext('2d');
            const myChartPNBPLLG = new Chart(PNBPLLG,{
                type: 'line',
                data:{
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                    datasets: [
                        {
                            data: capaian,
                        }
                    ]
                },
                options:{
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                    scales: {
                        yAxes:{
                            grid:{
                                display:false,
                                
                            },
                        },
                        xAxes:{
                            grid:{
                                display:false,
                                
                            },
                        },
                    }
                }
            });

            const PNBPbarLLG = document.getElementById('barchartPNBPLLG').getContext('2d');
            const myChartbarLLG = new Chart(PNBPbarLLG,{
                type: 'bar',
                data:{
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                    datasets: [
                        {
                            data: [
                                capaian[0], 
                                capaian[0]+capaian[1],
                                capaian[0]+capaian[1]+capaian[2],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4]+capaian[5],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4]+capaian[5]+capaian[6],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4]+capaian[5]+capaian[6]+capaian[7],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4]+capaian[5]+capaian[6]+capaian[7]+capaian[8],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4]+capaian[5]+capaian[6]+capaian[7]+capaian[8]+capaian[9],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4]+capaian[5]+capaian[6]+capaian[7]+capaian[8]+capaian[9]+capaian[10],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4]+capaian[5]+capaian[6]+capaian[7]+capaian[8]+capaian[9]+capaian[10]+capaian[11],
                            ],
                        }
                    ]
                },
                options:{
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                    scales: {
                        yAxes:{
                            grid:{
                                display:false,
                                
                            },
                        },
                        xAxes:{
                            grid:{
                                display:false,
                                
                            },
                        },
                    }
                }
            
            });
        }
    })
});

// PNBP PPN
$(document).ready(function(){
    $.ajax({
        type:'POST',
        url:'/PNBPPPN',
        dataType:'json',
        data:{jenis:'PPN'},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            const capaian =[null,null,null,null,null,null,null,null,null,null,null,null]
            $.each(response, function(res, req) {
                switch (req.bulan) {
                    case '1':
                        capaian[0] = parseInt(req.capaian)
                        break;
                    case '2':
                        capaian[1] = parseInt(req.capaian)
                        break;
                    case '3':
                        capaian[2] = parseInt(req.capaian)
                        break;
                    case '4':
                        capaian[3] = parseInt(req.capaian)
                        break;
                    case '5':
                        capaian[4] = parseInt(req.capaian)
                        break;
                    case '6':
                        capaian[5] = parseInt(req.capaian)
                        break;
                    case '7':
                        capaian[6] = parseInt(req.capaian)
                        break;
                    case '8':
                        capaian[7] = parseInt(req.capaian)
                        break;
                    case '9':
                        capaian[8] = parseInt(req.capaian)
                        break;
                    case '10':
                        capaian[9] = parseInt(req.capaian)
                        break;
                    case '11':
                        capaian[10] = parseInt(req.capaian)
                        break;
                    case '12':
                        capaian[11] = parseInt(req.capaian)
                        break;
                }
            })
            const PNBPPPN = document.getElementById('linechartPNBPPPN').getContext('2d');
            const myChartPNBPPPN = new Chart(PNBPPPN,{
                type: 'line',
                data:{
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                    datasets: [
                        {
                            data: capaian,
                        }
                    ]
                },
                options:{
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                    scales: {
                        yAxes:{
                            grid:{
                                display:false,
                                
                            },
                        },
                        xAxes:{
                            grid:{
                                display:false,
                                
                            },
                        },
                    }
                }
            });

            const PNBPbarPPN = document.getElementById('barchartPNBPPPN').getContext('2d');
            const myChartbarPPN = new Chart(PNBPbarPPN,{
                type: 'bar',
                data:{
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                    datasets: [
                        {
                            data: [
                                capaian[0], 
                                capaian[0]+capaian[1],
                                capaian[0]+capaian[1]+capaian[2],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4]+capaian[5],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4]+capaian[5]+capaian[6],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4]+capaian[5]+capaian[6]+capaian[7],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4]+capaian[5]+capaian[6]+capaian[7]+capaian[8],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4]+capaian[5]+capaian[6]+capaian[7]+capaian[8]+capaian[9],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4]+capaian[5]+capaian[6]+capaian[7]+capaian[8]+capaian[9]+capaian[10],
                                capaian[0]+capaian[1]+capaian[2]+capaian[3]+capaian[4]+capaian[5]+capaian[6]+capaian[7]+capaian[8]+capaian[9]+capaian[10]+capaian[11],
                            ],
                        }
                    ]
                },
                options:{
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                    scales: {
                        yAxes:{
                            grid:{
                                display:false,
                                
                            },
                        },
                        xAxes:{
                            grid:{
                                display:false,
                                
                            },
                        },
                    }
                }
            
            });
        }
    })
});

// Kepuasan Pelanggan

$(document).ready(function(){
    var tusi = 'ALL';
        $.ajax({
            type: "POST",
            url:"/kepuasanPelanggan",
            dataType:"json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                      tusis:tusi,
                    },
            success: function(response){
                const kepuasanPelanggan = document.getElementById('kepuasanPelanggan').getContext('2d');
                const myChart2 = new Chart(kepuasanPelanggan, {
                    type: 'radar',
                    data: {
                        labels: ['Tangibles', 'Reliability', 'Responsiveness', 'Assurance', 'Empathy'],
                        datasets: [{
                            data: [response.tangibles, response.reliability, response.responsiveness, response.assurance, response.empathy],
                            fill: true,
                            // backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgb(255, 99, 132)',
                            // pointBackgroundColor: 'rgb(255, 99, 132)',
                            pointBorderColor: '#fff',
                            // pointHoverBackgroundColor: '#fff',
                            pointHoverBorderColor: 'rgb(255, 99, 132)'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,

                        r: {
                            suggestedMin: 0,
                            suggestedMax: 5,
                        },
                        legend: {
                            display: false
                        },
                        plugins: {
                            legend: {
                                display: false,
                            },
                            title: {
                                display: false,
                                text: 'INDEKS KEPUASAN PENGGUNA LAYANAN',
                                padding: {
                                    top: 10,
                                }
                            },
                            
                        },            
                    }
                });
                $('#kepuasanTusi').change(function(){
                    myChart2.destroy();
                })
            }
        })
});

$('#kepuasanTusi').change(function(){
    var tusi = $(this).val();
    $.ajax({
        type: "POST",
        url:"/kepuasanPelanggan",
        dataType:"json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
                  tusis:tusi,
        },
        success: function(response){
            const kepuasanPelanggan = document.getElementById('kepuasanPelanggan').getContext('2d');
            const myChart2 = new Chart(kepuasanPelanggan, {
                type: 'radar',
                data: {
                    labels: ['Tangibles', 'Reliability', 'Responsiveness', 'Assurance', 'Empathy'],
                    datasets: [{
                        data: [response.tangibles, response.reliability, response.responsiveness, response.assurance, response.empathy],
                        fill: true,
                        // backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgb(255, 99, 132)',
                        // pointBackgroundColor: 'rgb(255, 99, 132)',
                        pointBorderColor: '#fff',
                        // pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(255, 99, 132)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    r: {
                        suggestedMin: 0,
                        suggestedMax: 5
                    },
                    legend: {
                        display: false
                    },
                    plugins: {
                            legend: {
                              display: false
                            },
                        title: {
                            display: false,
                            text: 'INDEKS KEPUASAN PENGGUNA LAYANAN',
                            padding: {
                                top: 10,
                            }
                        }
                    },            
                },
            });
            $('#kepuasanTusi').change(function(){
                myChart2.destroy();
            })
            myChart2.data.datasets[0].data = [response.tangibles, response.reliability, response.responsiveness, response.assurance, response.empathy];
            myChart2.update();
        }
    })
})

// Table NKO
function praktis(tahun) {
    $.ajax({
        type: "POST",
        url:"/NKO",
        dataType: "json",
        data:{tahun:tahun},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            var labels=[];
            var capaian=[];
            $.each(response.namaIKU, function(res, req){
                labels.push(req);
            })
            $.each(response.capaian, function(res, req){
                capaian.push(req);
            })
            const capaianKinerja = document.getElementById('capaianKinerja');
            capaianKinerja.height = response.namaIKU.length*50;
            const myChart = new Chart(capaianKinerja, {
                type: 'bar',    
                data : {
                    labels: labels,
                    datasets: [{
                        data: capaian,
                        fill: false,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                          ],
                          minBarThickness: 50,
                          maxBarThickness: 50
                    }],
                },
                options:{
                    indexAxis: 'y',
                    layout: {
                        padding:{
                            right:20,
                        },
                    },
                    responsive: true,
                    maintainAspectRatio: false,            
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                    scales: {
                        yAxes:{
                            grid:{
                                display:false,
                                borderColor:'#ffffff00',
                            },
                            ticks: {
                                mirror: true
                              }
                        },
                        xAxes:{
                            grid:{
                                display:false,
                                borderColor:'#ffffff00',
                            },
                            suggestedMin: 0,
                            suggestedMax: 120,
                            ticks: {
                                display:false,
                            }
                        },
                    } 
                },
            });
            $('#CKO').change(function(){
                myChart.destroy();
            })
        }  
    })    
};

function praktisTW(params) {
    $.ajax({
        type: "POST",
        url:"/NKOTW",
        dataType: "json",
        data:{
            tahun:params[0],
            triwulan:params[1]
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function (response) {
            var labels=[];
            var capaian=[];
            $.each(response.namaIKU, function(res, req){
                labels.push(req);
            })
            $.each(response.capaian, function(res, req){
                capaian.push(req);
            })
            const capaianKinerja = document.getElementById('capaianKinerja');
            capaianKinerja.height = response.namaIKU.length*50;
            const myChart = new Chart(capaianKinerja, {
                type: 'bar',    
                data : {
                    labels: labels,
                    datasets: [{
                        data: capaian,
                        fill: false,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                          ],
                          minBarThickness: 50,
                          maxBarThickness: 50
                    }],
                },
                options:{
                    indexAxis: 'y',
                    layout: {
                        padding:{
                            right:20,
                        },
                    },
                    responsive: true,
                    maintainAspectRatio: false,            
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                    scales: {
                        yAxes:{
                            grid:{
                                display:false,
                                borderColor:'#ffffff00',
                            },
                            ticks: {
                                mirror: true
                              }
                        },
                        xAxes:{
                            grid:{
                                display:false,
                                borderColor:'#ffffff00',
                            },
                            suggestedMin: 0,
                            suggestedMax: 120,
                            ticks: {
                                display:false,
                            }
                        },
                    } 
                },
            });
            $('#CKO').change(function(){
                myChart.destroy();
            })
            myChart.update()
        }
    })
}

