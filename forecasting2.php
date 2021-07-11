<?php
	include('db.php');
	include('session.php');
	if (isset($_POST['submit'])) {
	$product = $_POST['product'];
	$branch = $_POST['Branch'];
	$firstday = date('D', $timestamp)+11;
	
		if(empty($branch) && isset($product))
		{
			$result = "SELECT Product,SUM(`Qty`) AS 'value_sum' FROM `forecasting`  WHERE `day`> $firstday `PName` = '$product' GROUP BY `day`";
			$ARIMA = "SELECT ARIMA  FROM `forecasting`  WHERE `day`> $firstday `PName` = '$product' GROUP BY `day`";
			$Naive = "SELECT Naiv  FROM `forecasting`  WHERE `day`> $firstday `PName` = '$product' GROUP BY `day`";
			$RM = "SELECT Ramdon Forest  FROM `forecasting`  WHERE `day`> $firstday `PName` = '$product' GROUP BY `day`";
			$resultsum = mysqli_query($connection, $result);
			$row = mysqli_fetch_assoc($resultsum); 
			$sum = $row['value_sum'];
			
		}
		elseif(empty($product) && isset($branch))
		{
			$result = "SELECT SUM(`Qty`) AS 'value_sum' FROM `forecasting`  WHERE `day`> $firstday `BName` = '$branch' GROUP BY `day`";
			$ARIMA = "SELECT ARIMA FROM `forecasting`  WHERE `day`> $firstday `PName` = '$product' GROUP BY `day`";
			$Naive = "SELECT Naiv  FROM `forecasting`  WHERE `day`> $firstday `PName` = '$product' GROUP BY `day`";
			$RM = "SELECT Ramdon Forest  FROM `forecasting`  WHERE `day`> $firstday `PName` = '$product' GROUP BY `day`";
			$resultsum = mysqli_query($connection, $result);
			$row = mysqli_fetch_assoc($resultsum); 
			$sum = $row['value_sum'];
            
		}
		elseif(isset($product) && isset($branch))
		{
			$result = "SELECT SUM(`Qty`) AS 'value_sum' FROM `forecasting`  WHERE `day`> $firstday `BName` = '$branch' AND `PName` = '$product' GROUP BY `day`";
			$ARIMA = "SELECT ARIMA FROM `forecasting`  WHERE `day`> $firstday `BName` = '$branch' AND `PName` = '$product' GROUP BY `day`";
			$Naive = "SELECT Naiv  FROM `forecasting`  WHERE `day`> $firstday `BName` = '$branch' AND `PName` = '$product' GROUP BY `day`";
			$RM = "SELECT Ramdon Forest  FROM `forecasting`  WHERE `day`> $firstday `BName` = '$branch' AND `PName` = '$product' GROUP BY `day`";
			$resultsum = mysqli_query($connection, $result);
			$row = mysqli_fetch_assoc($resultsum); 
			$sum = $row['value_sum'];
		}
		elseif(empty($product) && empty($branch))
		{
			$result = "SELECT SUM(`Qty`) AS 'value_sum' FROM `forecasting` WHERE `day`> $firstday GROUP BY `day`";
			$ARIMA = "SELECT ARIMA AS 'value_sum' FROM `forecasting`   WHERE `day`> $firstday GROUP BY `day`";
			$Naive = "SELECT Naiv  FROM `forecasting`  WHERE `day`> $firstday GROUP BY `day`";
			$RM = "SELECT Ramdon Forest  FROM `forecasting`  WHERE `day`> $firstday GROUP BY `day`";
			$resultsum = mysqli_query($connection, $result);
			$row = mysqli_fetch_assoc($resultsum); 
			$sum = $row['value_sum'];
		}
	}
?>

<html> 
<head>
    <meta charset=UTF-8>
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <meta http-equiv="X-UA-Compantible" content="ie-edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>
    <link rel="stylesheet" type="text/css" href="f2.css">
    <script src="https://cdn.anychart.com/releases/8.7.1/js/anychart-core.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.7.1/js/anychart-radar.min.js"></script>
    <title>forecasting</title>
</head>

<body>
	
    <div class="navbar">
        <a id="ds" href="W.html">Home</a>
        <a id="ds" href="DM.html">Menu</a>
        <h1 style="text-align: center">Welcome to light Fields Anaylsis </h1>
    
	</div>


	<form method="post" action="forecasting2.php">
		<select id="product" name="product">
			<option value="ALL BERRY SALAD">ALL BERRY SALAD</option>
			<option value="BAKED TERIYAKI CHICKEN FILET">BAKED TERIYAKI CHICKEN FILET</option>
			<option value="BBQ STEAK SANDWICH">BBQ STEAK SANDWICH</option>
			<option value="BBQ STEAK WITH SWEET POTATO">BBQ STEAK WITH SWEET POTATO</option>
			<option value="BEEF MUSHROOM BURGER WITH FRIES">BEEF MUSHROOM BURGER WITH FRIES</option>
			<option value="BEETROOT SMOKED SALMON FETTUCICNI">BEETROOT SMOKED SALMON FETTUCICNI</option>
			<option value="BUTTER CHICKEN">BUTTER CHICKEN </option>
			<option value="BUTTER CHICKEN BOWL">BUTTER CHICKEN BOWL </option>
			<option value="CHICKEN CAESAR SALAD">CHICKEN CAESAR SALAD  </option>
			<option value="CHICKEN FAHITA">CHICKEN FAHITA  </option>
			<option value="CHICKEN PENNY PESTO">CHICKEN PENNY PESTO  </option>
			<option value="CHICKEN WINGS"> CHICKEN WINGS </option>
			<option value="CLASSIC BEEF BURGER">CLASSIC BEEF BURGER </option>
			<option value="CRUNCHY ASIAN CHICKEN SALAD">CRUNCHY ASIAN CHICKEN SALAD</option>
			<option value="EGG BURGER"> EGG BURGER</option>
			<option value="ITALIAN CHICKEN PASTA WITH SUNDRIED TOMATO"> ITALIAN CHICKEN PASTA WITH SUNDRIED TOMATO </option>
			<option value="MANGO AND BLUEBERRY FRUIT SALAD"> MANGO AND BLUEBERRY FRUIT SALAD </option>
			<option value="MANGO SALMON POKE BOWL"> MANGO SALMON POKE BOWL</option>
			<option value="MANGO SHRIMP POKE BOWL"> MANGO SHRIMP POKE BOWL </option>
			<option value="MEAT BBQ SPAGHETTI"> MEAT BBQ SPAGHETTI </option>
			<option value="MIXED FRUIT SALAD">MIXED FRUIT SALAD </option>
			<option value="PUMPKIN SPINACH KALE SALAD"> PUMPKIN SPINACH KALE SALAD </option>
			<option value="QUINOA BERRY SALAD"> QUINOA BERRY SALAD</option>
			<option value="SPICY HONEY SALMON POKE BOWL"> SPICY HONEY SALMON POKE BOWL </option>
			<option value="STEAK THAI SALAD"> STEAK THAI SALAD</option>
			<option value="TERIYAKI SHRIMP">TERIYAKI SHRIMP </option>
			<option selected="selected" value="0">All Product</option>
		</select>
		<select name="Branch" id="Branchs">
			<option value="QURTUBA">QURTUBA</option>
			<option value="JABRIYA 1">JABRIYA 1</option>
			<option value="RAWDA/HAWALLY 1">RAWDA/HAWALLY 1</option>
			<option value="KAIFAN">KAIFAN</option>
			<option value="ADALIYA">ADALIYA</option>
			<option value="BAYAN">BAYAN</option>
			<option value="JABRIYA 2">JABRIYA 2</option>
			<option value="SHAAB">SHAAB</option>
			<option value="SURRA">SURRA</option>
			<option value="DAHIAH">DAHIAH </option>
			<option value="QADSIYA">QADSIYA</option>
			<option value="SALMIYA">SALMIYA</option>
			<option value="FAIHA">FAIHA</option>
			<option selected="selected" value="0">All Branch</option>
		</select>
		<button name="submit" class="btn">Add</button>
	</form>

    <div class="movingDown" id="movingDown">
		<div class="container" id="container">
			<canvas id="myChart2" style="width:100%;max-width:600px"></canvas>
		</div>

		<div class="container" id="container">
			<canvas id="myChart" style="max-width: 95%;max-height: 95%;margin-left: 5%;"></canvas>
		</div>
		
		<div class="container" id="container">
			<canvas id="myChart1" style="width:100%;max-width:600px"></canvas>
		</div>
		
        <div class="container" id="container">
		  <div id="piechart" style="width:100%;max-width:600px"></div>
		</div>
    <div class="End">
        <form>
              <a href=>Gmail: contact@lightfields.co</a>
              <a href=>Facbook: contact@lightfields.co</a>
        </form>
    </div>
</body>

</html>

<script type="text/javascript">//first
  //bar
        var xValues = [<?php Print($row)?>]
        var yValues = [<?php Print($value_sum)?>]
        var barColors = ["red", "green","blue","orange","brown","red", "green","blue","orange","brown","red", "green"];
        myBarChart = new Chart("barChart", {
          type: "bar",
          data: {
            labels: xValues,
            datasets: [{
               label: 'quantity for the protuct by day',
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {
            legend: {display: false},
            title: {
              display: true,
              text: "World Wine Production 2018"
            }
          }
        });
      
      //point
      	var xValues = [<?php Print($row)?>]
        var yValues = [<?php Print($value_sum)?>]
        myPointChart = new Chart("pointChart", {
          type: "line",
          data: {
            labels: xValues,
            datasets: [{ 
              label: 'ARIMA',
              data: [<?php Print($ARIMA)?>],
              borderColor: "red",
              fill: false
            }, { 
              label: 'Niave Bayas',
              data: [<?php Print($Naive)?>],
              borderColor: "green",
              fill: false
            }, { 
              label: 'Random forest',
              data: [<?php Print($RM)?>],
              borderColor: "blue",
              fill: false
            }]
          },
          options: {
            legend: {display: false}
          }
        });
      
      //doughnut

       var xValues = <?php Print($Month)?>
        var yValues = <?php Print($value_sum)?>
        var barColors = [
          "#b91d47",
          "#00aba9",
          "#2b5797",
          "#e8c3b9",
          "#1e7145",
          "#a323b9",
          "#8f69d1",
          "#424870",
          "#265761",
          "#488254",
          "#8a9950",
          "#914e21"
        ]
       
        myDoughnutChart = new Chart("donChart", {
          type: "doughnut",
          data: {
              labels: xValues,
              datasets: [{
              backgroundColor: barColors,
              data: yValues
              }]
          },
          options: {
              title: {
              display: true,
              text: "Top branch sales"
              }
          }
        });
      //pie
</script>
