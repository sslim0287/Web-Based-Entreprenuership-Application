$(document).ready(function(){
    $.ajax({
      url: "data3.php",
      method: "GET",
      success: function(data) {
        console.log(data);
        var job_field = [];
        var count = [];
  
        for(var i in data) {
            job_field.push(data[i].job_field);
            count.push(data[i].count);
        }
  
        var chartdata = {
          labels: job_field,
          datasets : [
            {
              label: 'Job',
              backgroundColor: 'rgba(204, 107, 47, 0.75)',
              borderColor: 'rgba(200, 200, 200, 0.75)',
              hoverBackgroundColor: 'rgba(204, 107, 47, 1)',
              hoverBorderColor: 'rgba(200, 200, 200, 1)',
              data: count
            }
          ]
        };
  
        var ctx = $("#canvasJob");
  
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