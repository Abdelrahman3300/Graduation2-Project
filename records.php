<html>
    <head>
        <title>Supplies</title>
        <link rel="stylesheet" type="text/css" href="sent.css">
    </head>
    <body>

        <div class="navbar">
            <a href="W.html">Home</a>
            <a href="Staff.html">Menu</a>
            <h1 style="text-align: center">Welcome to light Fields Anaylsis </h1>
        </div>
        <form method="POST" action="records.php" name="Enter">
            <div class="container" id="container">

                <canvas id="myChart"> </canvas>
                <form>
                    <h1>Enter Sales Record</h1>
                </form>
            </div>

            <div class="End">
                <form>
                    <a href=>Gmail: contact@lightfields.co</a>
                    <a href=>Facbook: contact@lightfields.co</a>
                    </br>
                <a href=>Address: 28th Floor, Crystal Tower, Ahmed Al Jaber Street, Al Sharq Kuwait City, Kuwait.</a>
                </form>
            </div>
            <table id = "sup">
                <th>
                    product name/ID
                </th>
                <th>
                    Branch name/ID
                </th>
                <th>
                    Number Of Sent
                </th>
                <th>
                    Date
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
                            <option selected="selected" value="0"></option>
                        </select>
                    <td>
                        <input id="n" type=number name="value">
                    </td>
                    <td>
                        <input id="d" type=date name="date">
                    </td>
                </tr>
            </table>
            <button id="Set" type="button" name="sales_record" onclick="myFunction()">Add</button>
        </form>
        <script>
            
            var x= document.getElementById("product");
            var y= document.getElementById("Branch");
            var z= document.getElementById("n");

            function myFunction() {
                alert("ADD done correctly");
                window.location.replace("Admin.html");
                x.value="0";
                y.value="0";
                z.value="";
                var tbodyRef = document.getElementById('sup').getElementsByTagName('tbody')[0];
                // Insert a row at the end of table
                var newRow = tbodyRef.insertRow();
                // Insert a cell at the end of the row
                var newCell = newRow.insertCell();
                // Append a text node to the cell
                var newText = document.createTextNode('new row');
                newCell.appendChild(newText);

               
            }
            
        </script>
        
    </body>
</html>

<?php

include('db.php');
include('session.php');

    $pname=$_POST['product'].value;
    $bname=$_POST['branch'].value;
    $qty=$_POST['value'];
    $day=date("d");
    $M=date("m");
    $year=date("y");
            
  if(isset($_POST['Enter']))
  {
    $sql = "INSERT INTO `correctone` (`ProductName`, `BranchName`,`QTY`, `Month`,`day`,`year`) VALUES ('$pname', '$bname','$qty','$day', '$M','$year')";
  }
   if ($connection->query($sql) === TRUE) {   alert("Done");
    } else {
    echo "Error: " . $sql . "<br>" . $connection->error;
    }

  $connection->close();
?>