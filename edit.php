<?php
	include('db.php');
    include('session.php');
    
	if (isset($_POST['submit'])) {
	$product = $_POST['product'];
	$branch = $_POST['Branch'];
	
		if(empty($branch) && isset($product))
		{	
			$query = "SELECT * FROM `forecasting` WHERE `PName` = '$product' GROUP BY `day`";
			$resultgt = mysqli_query($connection, $query);
			
			$result = "SELECT SUM(`Qty`) AS 'value_sum' FROM `forecasting`  WHERE `PName` = '$product' GROUP BY `day`";
			$resultsum = mysqli_query($connection, $result);
			$row = mysqli_fetch_assoc($resultsum); 
			$sum = $row['value_sum'];
		}
		elseif(empty($product) && isset($branch))
		{
			$query = "SELECT * FROM `forecasting` WHERE `BName` = '$branch' GROUP BY `day`";
			$resultgt = mysqli_query($connection, $query);
			
			$result = "SELECT SUM(`Qty`) AS 'value_sum' FROM `forecasting`  WHERE `BName` = '$branch' GROUP BY `day`";
			$resultsum = mysqli_query($connection, $result);
			$row = mysqli_fetch_assoc($resultsum); 
			$sum = $row['value_sum'];
		}
		elseif(isset($product) && isset($branch))
		{
			$query = "SELECT * FROM `forecasting` WHERE `BName` = '$branch' GROUP BY `day`";
			$resultgt = mysqli_query($connection, $query);
			
			$result = "SELECT SUM(`Qty`) AS 'value_sum' FROM `forecasting`  WHERE `BName` = '$branch' AND `PName` = '$product' GROUP BY `day`";
			$resultsum = mysqli_query($connection, $result);
			$row = mysqli_fetch_assoc($resultsum); 
			$sum = $row['value_sum'];
			
		}
		elseif(empty($product) && empty($branch))
		{
			$query = "SELECT * FROM `forecasting` GROUP BY `day`";
			$resultgt = mysqli_query($connection, $query);
			
			$result = "SELECT SUM(`Qty`) AS 'value_sum' FROM `forecasting` GROUP BY `day`";
			$resultsum = mysqli_query($connection, $result);
			$row = mysqli_fetch_assoc($resultsum); 
			$sum = $row['value_sum'];
		}
	}
?>
<html>
    <head>
        <title>order</title>
        <link rel="stylesheet" type="text/css" href="edit.css">
        
    </head>
    <body>
       
        <div class="navbar">
            <a href="#home">Home</a>
            <a href="#news">Menu</a>
            <h1 style="text-align: center">Welcome to light Fields Anaylsis </h1>
        </div>
         
        <div class="container" id="container">
            
            <canvas id="myChart"> </canvas>
            <form>
                <h1>Select Records by Name/Date/branch</h1>
            </form>
        </div>

        
        <form method="POST" action="edit.php">
            <table id = "sup">
                <th>
                    product name/ID
                </th>
                <th>
                    Branch name/ID
                </th>
                <th>
                    Number Of Qty
                </th>
                <th>
                    Start Date
                </th>
                <th>
                    End Date
                </th>
                <tr>
                    <td>
                        <select id="product" name="product">
                            <option value="ALL BERRY SALAD">ALL BERRY SALAD </option>
                            <option value="BAKED TERIYAKI CHICKEN FILET">BAKED TERIYAKI CHICKEN FILET </option>
                            <option value="BBQ STEAK SANDWICH">BBQ STEAK SANDWICH </option>
                            <option value="BBQ STEAK WITH SWEET POTATO">BBQ STEAK WITH SWEET POTATO  </option>
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
                            <option selected="selected" value-"0"> </option>
                        </select>
                    </td>
                    <td>
                        <select name="Branch" id="Branch">
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
                            <option selected="selected" value="0"></option>
                        </select>
                    </td>
                    <td>
                        <input id="n" type=number>
                    </td>
                    <td>
                        <input id="d" name="Sday" type=date>
                    </td>
                    <td>
                        <input id="d" name="Eday" type=date>
                    </td>
                </tr>
            </table>
            <button name="submit" class="Set">Add</button>
        </form>
        
        <table align="center" border="2px solid #D6D6D6;" style="width: 50%; margin-left: auto; margin-right: auto; margin-top:6%; text-align:center;">
		<tr>
			<th>ProductName</th>
			<th>BranchName</th>
			<th>Day</th>
			<th>Quantity</th>
            <th>Edit</th>
		</tr>
        <?php
		if(isset($resultgt))
		{
			
			while($rows=mysqli_fetch_assoc($resultgt))
			{
			?>
				<tr>
					<td><input><?php echo $rows['PName'];?></input></td>
					<td><input><?php echo $rows['BName'];?></input></td>
					<td><input><?php echo $rows['day'];?></input></td>
					<td><input><?php echo $sum;}?></input></td>
                    <td><button onclick="myFunction1()" name="edit">edit</button></td>
				</tr>
			<?php
		};
		?>
        <script>
            var x= document.getElementById("product");
            var y= document.getElementById("Branch");
            var z= document.getElementById("n");
            
            function myFunction() {
               x.value="0";
               y.value="0";
               z.value=""; 
               
            }
        </script>
        <div class="End">
            <form>
                <a href=>Gmail: contact@lightfields.co</a>
                <a href=>Facbook: contact@lightfields.co</a>
            </form>
        </div>
    </body>
    <script>
        function myFunction1() {
            alert("update done");
            window.location.replace("DM.html")
        }
    </script>   
</html>

