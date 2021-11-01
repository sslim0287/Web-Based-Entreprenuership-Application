$(document).ready(function(){
    $.ajax({
      url: "data5.php",
      method: "GET",
      success: function(data) {
        console.log(data);
        var name = [];
        var min_salary = [];
        var max_salary = [];

  
        for(var i in data) {
            name.push(data[i].name);
            min_salary.push(data[i].min_salary);
            max_salary.push(data[i].max_salary);

        }
  
        var chartdata = {
          labels: name,
          datasets : [
            {
              label: 'Min salary',
              backgroundColor: 'rgba(66, 135, 245,0.2)',
              borderColor: 'rgba(179,181,198,1)',
              hoverBackgroundColor: 'rgba(66, 135, 245, 1)',
              hoverBorderColor: 'rgba(200, 200, 200, 1)',
              data: min_salary
            },
            {
                label: 'Max salary',
                backgroundColor: 'rgba(9, 54, 125, 0.75)',
                borderColor: 'rgba(200, 200, 200, 0.75)',
                hoverBackgroundColor: 'rgba(153, 187, 240, 1)',
                hoverBorderColor: 'rgba(200, 200, 200, 1)',
                data: max_salary
              },
          ]
        };
  
        var ctx = $("#canvasJobsType");
  
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