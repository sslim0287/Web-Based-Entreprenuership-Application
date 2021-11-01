$(document).ready(function(){
    $.ajax({
      url: "data6.php",
      method: "GET",
      success: function(data) {
        console.log(data);
        var name = [];
        var min_profit = [];
        var max_profit = [];

  
        for(var i in data) {
            name.push(data[i].name);
            min_profit.push(data[i].min_profit);
            max_profit.push(data[i].max_profit);

        }
  
        var chartdata = {
          labels: name,
          datasets : [
            {
              label: 'Min Profit',
              backgroundColor: 'rgba(147, 165, 194,0.7)',
              borderColor: 'rgba(179,181,198,1)',
              hoverBackgroundColor: 'rgba(147, 165, 194, 1)',
              hoverBorderColor: 'rgba(200, 200, 200, 1)',
              data: min_profit
            },
            {
                label: 'Max Profit',
                backgroundColor: 'rgba(61, 81, 235, 0.75)',
                borderColor: 'rgba(200, 200, 200, 0.75)',
                hoverBackgroundColor: 'rgba(61, 81, 235, 1)',
                hoverBorderColor: 'rgba(200, 200, 200, 1)',
                data: max_profit
              },
          ]
        };
  
        var ctx = $("#canvasBusinessesType");
  
        var barGraph = new Chart(ctx, {
          type: 'bar',
          data: chartdata
        });
      },
      error: function(data) {
        console.log(data);
      }
    });
  });