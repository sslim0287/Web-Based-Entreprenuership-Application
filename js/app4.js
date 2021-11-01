$(document).ready(function(){
    $.ajax({
      url: "data4.php",
      method: "GET",
      success: function(data) {
        console.log(data);
        var user_reg_date = [];
        var count = [];
        
        for(var i in data) {
            user_reg_date.push(data[i].user_reg_date);
            count.push(data[i].count);
        }
  
        var chartdata = {
          labels: user_reg_date,
          datasets : [
            {
              label: 'User Register Date',
              backgroundColor: 'rgba(110, 81, 14, 0.75)',
              borderColor: 'rgba(110, 81, 14, 0.75)',
              hoverBackgroundColor: 'rgba(110, 81, 14, 1)',
              hoverBorderColor: 'rgba(110, 81, 14, 1)',
              data: count
            }
          ]
        };
        
        var ctx = $("#canvasRegDate");
  
        var barGraph = new Chart(ctx, {
          type: 'line',
          data: chartdata,  
           options : {
            scales: {
                y: {
                    suggestedMin: 0,
                    suggestedMax: 10
                },
                x: {
                    suggestedMin: 0,
                    suggestedMax: 10
                }
            }
        }
        });
      
      
        },
      error: function(data) {
        console.log(data);
      }
    });
  });