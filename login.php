<?php
$login = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'partials\_dbconnect.php';
    $user = $_POST["username"];
    $pass = $_POST["pass"];
    // $cpass=$_POST["cpass"];
    $exists = false;
    // $sql = "select * from users where username='$user' and pass='$pass' ";
    $sql = "select * from users where username='$user' ";
    $res = mysqli_query($con, $sql);
    $row = mysqli_num_rows($res);
    if ($row == 1) {
        while($num=mysqli_fetch_assoc($res)){
            if(password_verify($pass,$num['pass'])){
                $login = true;
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['username']=$user;
                header("location:welcome.php");
            }
            else $showError = "Invalid Credentials";
        }
        
    } 
    else $showError = "Invalid Credentials";
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

    <title>Login</title>
</head>

<body>
    <?php
    require 'partials\_nav.php';
    if ($login) {
        echo '`<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success! </strong> Your account has been logged in .
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`';
    }
    if ($showError) {
        echo '`<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Failure! </strong>' . $showError . ' .
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`';
    }
    ?>

    <div class="container col-md-6" id="frm">
        <h1 class="text-center my-3">Login to our website</h1>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label ">Username</label>
                <input type="text" class="form-control" placeholder="Enter your username" id="username" name="username" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="pass" class="form-control" placeholder="Enter your password" id="pass" name="pass">
            </div>

            <button type="submit" class="btn btn-primary col-md-12">Login</button>
        </form>
    </div>
    <br>
    <br>
    <marquee behavior="scroll" direction="" scrollamount="10" width="100%" height="50%" > If You are a new user on HSecure Portal... Kindly  <a href="signup.php"> register yourself here</a></marquee>

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