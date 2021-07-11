<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>
    <div class="navbar">
        <a href="W.html">Home</a>
        <h1 style="text-align: center">Welcome to light Fields Anaylsis </h1>
    </div>
    <div id="container">
            <h2 style="text-align: centwer">Login</h2>
            <form name="login" method="POST" action="Login.php">
                <label> <input type="text" name = "uname" placeholder="Enter your Username" class="inp"></label><br>
                <label> <input type="password" name="upass" placeholder="Enter you Password" class="inp"></label><br>
                <button name="login">Login</button>
                <button name="hello">Forgot password?</button>
                <button><a style="color:black;" href="RegisterUser.php">Register New User </a></button>
            </form>
    </div>
    <div class="End">
        <form>
              <a href=>Gmail: contact@lightfields.co</a>
              <a href=>Facbook: contact@lightfields.co</a>
        </form>
    </div>

</body>

</html>

<?php
include('db.php');

if (isset($_POST['login'])) {
    header("Location: admin.html");
    $name = $_POST['uname'];
    $pwd = $_POST['upass'];
    $sql = "SELECT * FROM user WHERE Name = '$name' AND Password = '$pwd' ";
    $uType = "SELECT Type FROM user WHERE Name = '$name' AND Password = '$pwd'";
    $connection = mysqli_connect("localhost","root","","lightfields");
    $result = mysqli_query($connection, $sql);
    $resultU = mysqli_query($connection, $uType);
    $count = mysqli_num_rows($result);
    $countU = mysqli_num_rows($resultU);
    while($row = $result->fetch_assoc()) {
            header("Location: admin.html");
      }

    }
    $connection->close();

?>