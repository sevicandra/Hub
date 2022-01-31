
var options = {
    chart: {
        height: 350,
        
        type: 'radialBar',
    },
    series: [70],
    labels: ['Pengelolaan Kekayaan Negara'],
  }
  
  var chart1 = new ApexCharts(document.querySelector("#PNBP1"), options);
  
  chart1.render();

  var options = {
    chart: {
        height: 350,
        
        type: 'radialBar',
    },
    series: [70],
    labels: ['Lelang'],
  }
  
  var chart2 = new ApexCharts(document.querySelector("#PNBP2"), options);
  
  chart2.render();

  var options = {
    chart: {
        height: 350,
        
        type: 'radialBar',
    },
    series: [50],
    labels: ['Piutang Negara'],
  }
  
  var chart3 = new ApexCharts(document.querySelector("#PNBP3"), options);
  
  chart3.render();