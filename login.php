<?php
// code for login
$error = false;
$login = false;
if ($_SERVER["REQUEST_METHOD"]=="POST") {
  include "comp/_dbconnect.php";
  $uname = $_POST["username"];
  $pwd = $_POST["pswd"];

  $sql = "select * from users where username = '$uname'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if($num==1){
    $row = mysqli_fetch_assoc($result);
    $hashed_password = $row['password'];
    if (password_verify($pwd, $hashed_password)) {
      $login = true;
      session_start();
      $_SESSION['loggedin']=true;
      $_SESSION['username']=$uname;
      header("location: welcome.php");
    }else {
      $error = true;
    }
  }else{
    $error = true;
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>
    <?php require 'comp/_navbar.php';?>
    
    <div class="container my-4">
        <h1>Login</h1>
        <?php
          if ($error) {
            echo '<div class="alert alert-danger">
                <h1>Invalid Credentials</h1>
                </div>';
          }
          if ($login) {
            echo '<div class="alert alert-success">
            <h1>You are logged in.</h1>
            </div>';
          }
        ?>
        <form action="login.php" method="post">
        <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username">
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form> 
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
