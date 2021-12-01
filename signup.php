<?php
$showalert=false;
$showerror=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'partials/_dbconnect.php';
    $username = $_POST["username"];
    $password =$_POST["password"];
    $cpassword =$_POST["cpassword"];
    $exists=false;
    // check whether user already exists or not
    $sqlexist= "SELECT * from `user` where username='$username'";
    $result=mysqli_query($conn , $sqlexist);
    $numexistrows=mysqli_num_rows($result);

    if ($numexistrows>0){
      $showerror= " User already exists.";
    }
    else{
      if($password == $cpassword ){
        $hash= password_hash($password,PASSWORD_DEFAULT);
        $sql= "INSERT INTO `user` (`username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
        $result= mysqli_query($conn,$sql);
    
        if($result){
            $showalert=true;
        }
    }
    
    
    else{
        $showerror=" Passwords do not match.";
    
    }

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>signup</title>
  </head>
  <body>
      <?php
      require 'partials/_nav.php';
               
      ?>
      <?php
      if($showalert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>success!</strong> Your account is created and you can login now.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }
      ?>
      <?php
      if($showerror){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong>'.$showerror.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }
      ?>
       
      <div class="container ">
         <h2 class="text-center mt-3 "> Signup to our website.</h2>
      </div>
      <form action="/loginsystem/signup.php" method="post">
  <div class="mb-3 mx-5">
    <label for="username" class="form-label">Username</label>
    <input type="text" maxlength=20 class="form-control" id="username"  name="username" aria-describedby="emailHelp">
</div>
<div class="mb-3 mx-5">
    <label for="password" class="form-label">Password</label>
    <input type="password" maxlength=20 class="form-control" id="password" name="password">
</div>
<div class="mb-3 mx-5">
    <label for="cpassword" class="form-label"> Confirm Password</label>
    <input type="password" class="form-control" id="cpassword" name="cpassword">
    <div id="emailHelp" class="form-text">Make sure to enter the same password.</div>
</div>
  
  <button type="submit" class="btn btn-primary mx-5">Signup</button>
</form>
    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>