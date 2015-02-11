<!doctype html>
<html>
    <head>
        <title>Bar Chart</title>
        <script src="{{URL::asset('js/Chart.min.js')}}"> </script>
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/jquery-ui.min.css') }}" rel="stylesheet">
        
    </head> 
     <body onload="getchart()">
     
		<script>
   			function getchart(){
			var data = {
		labels: ["January", "February", "March", "April", "May", "June", "July"],
		datasets: [
			{
				label: "My First dataset",
				fillColor: "rgba(220,220,220,0.5)",
				strokeColor: "rgba(220,220,220,0.8)",
				highlightFill: "rgba(220,220,220,0.75)",
				highlightStroke: "rgba(220,220,220,1)",
				data: [65, 59, 80, 81, 56, 55, 40]
			},
			{
				label: "My Second dataset",
				fillColor: "rgba(151,187,205,0.5)",
				strokeColor: "rgba(151,187,205,0.8)",
				highlightFill: "rgba(151,187,205,0.75)",
				highlightStroke: "rgba(151,187,205,1)",
				data: [28, 48, 40, 19, 86, 27, 90]
			}
		]
	};

			var ctx = document.getElementById("myChart").getContext("2d");

			var myChart = new Chart(ctx).Bar(data,{
				  legendTemplate : "<ul>"
                  +"<% for (var i=0; i<datasets.length; i++) { %>"
                    +"<li>"
                    +"<span style='background-color: <%=datasets[i].strokeColor %>'>color</span>"
                    +"<% if (datasets[i].label) { %><%= datasets[i].label %><% } %>"
                  +"</li>"
                +"<% } %>"
              +"</ul>"
				  
				 
			});
			
			document.getElementById("legendDiv").innerHTML = myChart.generateLegend();
			}
			
		</script>
    
   		<div id="legendDiv"></div>
       <canvas id="myChart" width="400" height="400"></canvas>




</body>

</html>



