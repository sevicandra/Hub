
var options = {
    chart: {
        height: '100%',
        width:'100%',
        type: 'radialBar',
    },
    series: [70],
    labels: ['Kekayaan Negara'],
  }
  
  var chart1 = new ApexCharts(document.querySelector("#PNBP1"), options);
  
  chart1.render();

  var options1 = {
    chart: {
        height: '100%',
        width:'100%',
        type: 'radialBar',
    },
    series: [70],
    labels: ['Lelang'],
  }
  
  var chart2 = new ApexCharts(document.querySelector("#PNBP2"), options1);
  
  chart2.render();

  var options2 = {
    chart: {
        height: '100%',
        width:'100%',
        type: 'radialBar',
    },
    series: [50],
    labels: ['Piutang Negara'],
  }
  
  var chart3 = new ApexCharts(document.querySelector("#PNBP3"), options2);
  
  chart3.render();