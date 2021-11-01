$(document).ready(function(){
    $.ajax({
      url: "data.php",
      method: "GET",
      success: function(data) {
        console.log(data);
        var user_gender = [];
        var count = [];
  
        for(var i in data) {
          user_gender.push(data[i].user_gender);
          count.push(data[i].count);
        }
  
        var chartdata = {
          labels: user_gender,
          datasets : [
            {
              label: 'Gender',
              backgroundColor: 'rgba(114, 168, 164, 0.75)',
              borderColor: 'rgba(200, 200, 200, 0.75)',
              hoverBackgroundColor: 'rgba(114, 168, 164, 1)',
              hoverBorderColor: 'rgba(200, 200, 200, 1)',
              data: count
            }
          ]
        };
  
        var ctx = $("#canvasGender");
  
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