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

// const capaianKinerja = document.getElementById('capaianKinerja').getContext('2d');
// const myChart = new Chart(capaianKinerja, {
//     type: 'bar',
//     data: {
//         labels: ['Tangibles', 'Reability', 'Responsiveness', 'Assurance', 'Empathy'],
//         datasets: [{
//             data: [65, 59, 80, 81, 56, 55, 40],
//             fill: true,
//         }]
//     },
//     options: {
//         indexAxis: 'y',
//         plugins: {
//                 // legend: {
//                 //   display: false
//                 // },
//             title: {
//                 display: true,
//                 text: 'INDEKS KEPUASAN PENGGUNA LAYANAN',
//                 padding: {
//                     top: 10,
//                 }
//             }
//         },
            
//     }
// });


const capaianKinerja = document.getElementById('capaianKinerja').getContext('2d');
const myChart = new Chart(capaianKinerja, {
    type: 'bar',    
    data : {
        labels: ['Jan', 'Feb', '','','','',''],
        datasets: [{
            data: [65, 59, 80, 81, 56, 55, 40,50,60,60,40,50,50],
            fill: false,
        }]
    },
    options:{
        indexAxis: 'y',
        x:{
            suggestedMin: 0,
            suggestedMax: 120
        },
        responsive: true,
        maintainAspectRatio: false,
    },
   
});