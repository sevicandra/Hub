
const kepuasanPelanggan = document.getElementById('kepuasanPelanggan').getContext('2d');
const myChart2 = new Chart(kepuasanPelanggan, {
    type: 'radar',
    data: {
        labels: ['Tangibles', 'Reability', 'Responsiveness', 'Assurance', 'Empathy'],
        datasets: [{
            label: 'Pengelolaan Kekayaan Negara',
            data: [5, 5, 5, 4, 5],
            fill: true,
            // backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgb(255, 99, 132)',
            // pointBackgroundColor: 'rgb(255, 99, 132)',
            pointBorderColor: '#fff',
            // pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(255, 99, 132)'
        },
        {
            label: 'Penilaian',
            data: [5, 5, 5, 4, 5],
            fill: true,
            // backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgb(255, 99, 132)',
            // pointBackgroundColor: 'rgb(255, 99, 132)',
            pointBorderColor: '#fff',
            // pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(255, 99, 132)'
        },
        {
            label: 'Lelang',
            data: [5, 5, 5, 4, 5],
            fill: true,
            // backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgb(255, 99, 132)',
            // pointBackgroundColor: 'rgb(255, 99, 132)',
            pointBorderColor: '#fff',
            // pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(255, 99, 132)'
        },
        {
            label: 'Piutang Negara',
            data: [5, 2, 4, 1, 3],
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
                // legend: {
                //   display: false
                // },
            title: {
                display: true,
                text: 'INDEKS KEPUASAN PENGGUNA LAYANAN',
                padding: {
                    top: 10,
                }
            }
        },            
    }
});


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
            const capaianKinerja = document.getElementById('capaianKinerja').getContext('2d');
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
                    }],
                },
                options:{
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,            
                    plugins: {
                        legend: {
                            display: false
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
                            suggestedMin: 0,
                            suggestedMax: 120,
                        }
                    }  
                },
            });
        }  
    })    
}