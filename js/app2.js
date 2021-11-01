$(document).ready(function(){
    $.ajax({
      url: "data2.php",
      method: "GET",
      success: function(data) {
        console.log(data);
        var user_country = [];
        var count = [];
  
        for(var i in data) {
            user_country.push(data[i].user_country);
            count.push(data[i].count);
        }
  
        var chartdata = {
          labels: user_country,
          datasets : [
            {
              label: 'Country',
              backgroundColor: 'rgba(6, 85, 138, 0.75)',
              borderColor: 'rgba(200, 200, 200, 0.75)',
              hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
              hoverBorderColor: 'rgba(6, 85, 138, 1)',
              data: count
            }
          ]
        };
  
        var ctx = $("#canvasCountry");
  
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