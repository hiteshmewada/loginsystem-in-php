<?php
    $showAlert=false;
    $showError=false;
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        
        include 'partials\_dbconnect.php';
        $user=$_POST["username"];
        if($user==" "){
            $showError="username cannot be empty";
        }
        else{

            $pass=$_POST["pass"];
            $cpass=$_POST["cpass"];
            $exists=false;
            $existsql="select * from users where username='$user' ";
            $res=mysqli_query($con,$existsql);
            $numexistrow=mysqli_num_rows($res);
            // echo $numexistrow;
            if($numexistrow<=0) 
            {
                if(($pass==$cpass) and $exists==false){
                    $hash=password_hash($pass,PASSWORD_DEFAULT);
                    $sql="insert into `users` (`username`,`pass`,`dt`) values('$user','$hash', current_timestamp()) ";
                    $res=mysqli_query($con,$sql);
                    if($res) $showAlert=true;
                }
                else $showError="Passwords do not match";
            }
            else $showError="Username already exists";
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
    <link rel="stylesheet" href="style.css">

    <title>Sign Up</title>
</head>

<body>
    <?php
    require 'partials\_nav.php';
        if($showAlert){
        echo '`<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success! </strong> Your account has been created and now you can <a href="login.php">login here</a> .
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`';
        }
        
        if($showError){
            echo '`<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Failure! </strong> Your '.$showError .' .
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`';
            }
    ?>
    
    <div class="container col-md-6" id="frm">
        <h1 class="text-center my-3">Sign Up to our website</h1>
        <form action="signup.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label ">Username</label>
                <input type="text" class="form-control" placeholder="Enter your username" required maxlength="11" minlength="1" id="username" name="username" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="pass" class="form-control" placeholder="Enter password" required maxlength="25" minlength="1" id="pass" name="pass">
            </div>
            <div class="mb-3">
                <label for="cpass" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" placeholder="Confirm the password" id="cpass" name="cpass">
                <div id="emailHelp" class="form-text"> Make sure you entered the same password.</div>
            </div>
            <button type="submit" class="btn btn-primary col-md-12">Sign Up</button>
        </form>
    </div>

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