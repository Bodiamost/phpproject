<?php  
 $connect = mysqli_connect("network.cga94bd83uty.ca-central-1.rds.amazonaws.com:3306", "teammember", "phpteam1!", "network");
 ?>

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
     <script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([

          ['Date', 'Visits'],
            <?php 
	        	$query = "SELECT count(ip) AS count, vdate FROM visitors GROUP BY vdate ORDER BY vdate";

	        	$exec = mysqli_query($connect,$query);
	        	while($row = mysqli_fetch_array($exec)){

	        		echo "['".$row['vdate']."',".$row['count']."],";
	        	}
	   ?>
         
        ]);

        var options = {
        	title: 'Date wise visits'
        };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart"));
      chart.draw(data, options);
  }
  </script>

    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
        	['Browser', 'Visits'],
             <?php 
	        	$query = "SELECT count(ip) AS count, browser FROM visitors GROUP BY browser";

	        	$exec = mysqli_query($connect,$query);
	        	while($row = mysqli_fetch_array($exec)){

	        		echo "['".$row['browser']."',".$row['count']."],";
	        	}
	   ?>
        ]);

        var options = {
          title: 'Browser wise visits'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
        <script type="text/javascript">
      google.load("visualization", "1", {packages:["geochart"]});
      google.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {

        var data = google.visualization.arrayToDataTable([

          ['Country', 'Visits'],
           <?php 
	        	$query = "SELECT count(ip) AS count, country FROM visitors GROUP BY country";

	        	$exec = mysqli_query($connect,$query);
	        	while($row = mysqli_fetch_array($exec)){

	        		echo "['".$row['country']."',".$row['count']."],";
	        	}
	   ?>
        ]);

        var options = {
        	
        };

        var chart = new google.visualization.GeoChart(document.getElementById('geochart'));

        chart.draw(data, options);
      }
    </script>
  
    <script type="text/javascript">
    	google.load('visualization', '1', {packages: ['corechart', 'bar']});
	google.setOnLoadCallback(drawMaterial);

	function drawMaterial() {
	      var data = google.visualization.arrayToDataTable([
	        ['Country', 'New Visitors', 'Returned Visitors'],
	      <?php 
	        	$query = "SELECT count(ip) AS count, country FROM visitors GROUP BY country";

	        	$exec = mysqli_query($connect,$query);

	        	while($row = mysqli_fetch_array($exec)){

	        		echo "['".$row['country']."',";
	        		$query2 = "SELECT count(distinct ip) AS count FROM visitors WHERE country='".$row['country']."' ";
	        		$exec2 = mysqli_query($connect,$query2);
	        		$row2 = mysqli_fetch_assoc($exec2);
	        			
	        		echo $row2['count'];
	        		
	        		

	        		$rvisits = $row['count']-$row2['count'];

	        		echo ",".$rvisits."],";
	        	}
	   ?>
	      ]);

	      var options = {
	        
	          title: 'Country wise new and returned visitors',
	        
	        bars: 'horizontal'
	      };
	      var material = new google.charts.Bar(document.getElementById('barchart'));
	      material.draw(data, options);
	    }
    </script>

   

	<div style="align:left;">
   <h3>Column Chart</h3>
   <div id="columnchart" style="width: 900px; height: 500px;"></div>
   <div>
   <div style="align:right;">
   <h3>Pie Chart</h3>
   <div id="piechart" style="width: 900px; height: 500px;"></div>
   </div>
   <div style="align:left;">
   <h3>Geo Chart</h3>
   <div id="geochart" style="width: 900px; height: 500px;"></div>
   </div>
   <div style="align:right;">
   <h3>Bar Chart</h3>
   <div id="barchart" style="width: 900px; height: 500px;"></div>
   </div>


