<?php
$errorAlert = false;
$successAlert = false;
$pswdAlert = false;
// code for registration
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    require 'comp/_dbconnect.php';
    $username = $_POST["username"];
    $pswd = $_POST["pswd"];
    $cpswd = $_POST["cpswd"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $age = $_POST["age"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    if ($pswd==$cpswd) {
        // code for setting data into database
        $hashpswd = password_hash($pswd, PASSWORD_BCRYPT);
        $sql = "INSERT INTO `users`.`users` (`fname`, `lname`, `age`, `address`, `phone`, `username`, `password`,`creation_time`) VALUES ('$fname', '$lname', '$age', '$address', '$phone', '$username', '$hashpswd', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $successAlert = true;
        }else{
            $errorAlert = true;
        }
    }else{
        $pswdAlert=true;
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

    <title>Register</title>
  </head>
  <body>
    <?php require 'comp/_navbar.php';?>
    
    <div class="container my-4">
        <?php 
            if ($pswdAlert) {
                echo '<div class="alert alert-danger">
                <h1>Password same to same nahi hai</h1>
                </div>';
            }elseif ($successAlert) {
                // code for success
                echo '<div class="alert alert-success">
                <h1>Account ban gya</h1>
                </div>';
            }elseif ($errorAlert) {
                // code for error
                echo '<div class="alert alert-danger">
                <h1>Account nhi ban paya. Kuchh dikkat aa gyi.</h1>
                </div>';
            }
        ?>
        <h1>Register</h1>
        <form action="registration.php" method="post" onsubmit="return validate()">
            <div class="mb-3">
                <label for="fname" class="form-label">First Name:</label>
                <input type="text" class="form-control" id="fname" placeholder="Enter Fisrt Name" name="fname">
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last Name:</label>
                <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname">
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age:</label>
                <input type="number" class="form-control" id="age" placeholder="Enter Age" name="age">
            </div>
            <!-- <div class="mb-3">
                <label for="gender" class="form-label">Gender:</label>
                <select id="gender" name="gender" class="form-select" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div> -->
            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <input type="text" class="form-control" id="addresss" placeholder="Enter Address" name="address">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone No.:</label>
                <input type="text" class="form-control" id="phone" placeholder="Enter Phone Number" name="phone">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" id="username" placeholder="Enter Address" name="username">
            </div>
            <!-- <div class="mb-3 mt-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
            </div> -->
            <div class="mb-3">
                <label for="pwd" class="form-label">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
            </div>
            <div class="mb-3">
                <label for="cpwd" class="form-label">Confirm password:</label>
                <input type="password" class="form-control" id="cpwd" placeholder="Enter password" name="cpswd">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form> 
    </div>

    <!-- <script>
        function validate(){
            let pswd = document.getElementById("pwd").value;
            let cpswd = document.getElementById("cpwd").value;
            if(pswd!==cpswd){
                alert("Passwords are not matching.");
                return false;
            }
            return true;
        }
    </script> -->

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
