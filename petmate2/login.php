<?php
session_start();
if(isset($_SESSION['accid'])){
    header("Location: account.php");
    exit;
}
else if(isset($_SESSION['userid'])){
    header("Location: user.php");
    exit;
}
?>

<!DOCTYPE html>
    <head>
        <meta charset='UTF-8'name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css2?family=Lemonada:wght@400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" href="/css/index.css">
        <link rel="stylesheet" href="/css/form.css">
        <title>
            Pet Mate
        </title>
    </head>
<body>
<?php
include('navbar.php');
?>
<div class="container flex-row flex-wrap mt-3">
        <div class="row">
            <div class="info col-6">
            <p style="font-weight: 600;">pet holder account</p>        
            <form id="acc_login_form" action="login.php" method="GET">
                <label  class=form-item for=username1 >EMAIL</label>
                <input  class=form-item type="email" id="username1"  placeholder="Enter email" required name="email1">
                <label  class=form-item for="pass1">PASSWORD</label>
                <input  class=form-item type="password" id=pass1 placeholder="Enter password" required name="password1">
                <button class=form-item  type="submit" id=acc_log_btn name=acc_log_btn value="acclogbtn">Login</button>
            </form>
            </div>
            <div class="info col-6">        
                <form id="user_login_form" action="login.php" method="GET">
                    <p style="font-weight: 600;">pet viewer(user) account</p>
                    <label  class=form-item for=username2 >EMAIL</label>
                    <input  class=form-item type="email" id="username2"  placeholder="Enter email" required name="email2">
                    <label  class=form-item for="pass2">PASSWORD</label>
                    <input  class=form-item type="password" id=pass2 placeholder="Enter password" required name="password2">
                    <button class=form-item  type="submit" id=user_log_btn name=user_log_btn value="userlogbtn">Login</button>
                </form>
            </div>     
            <div class="info col">
                <p>New to Pet Mate? Sign up now!!</p>
                <a href="signuser.php"><button>Find a Mate?</button></a>
                <a href="signacc.php"><button>Become a Match Maker?</button></a>
            </div>       
        </div>
    </div>
 	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="/js/back_animations.js"></script>
<?php
if(isset($_GET['acc_log_btn'])){
    $email=$_GET['email1'];
    $password=$_GET['password1'];
    $conn = mysqli_connect("localhost","petmateadmin","rubenNshaivi","petmatedb");
    if(!$conn){
        echo "<script type = 'text/javascript'>alert('RELOAD:DATABASE CONNECTIVITY ERROR');</script>\n";
    }else{
        $sql = "select acc_id from account_info where email = '$email' and pass_word='$password'";
        echo "<script type='text/javascript'>console.log(\"$sql\");</script>";
        $result = mysqli_query($conn,$sql);
        if($result->num_rows==0){
            echo "<script type='text/javascript'>alert('NO SUCH ACCOUNT!!');</script>";
        }else{
            $acc_info = mysqli_fetch_all($result,MYSQLI_ASSOC);
            mysqli_free_result($result);
            mysqli_close($conn);
            $acc_id = $acc_info[0]['acc_id'];
            $_SESSION['accid'] = $acc_id;
            echo "<script type='text/javascript'>alert('your accid = $acc_id');</script>\n";
            echo "<script type='text/javascript'>window.location.href='account.php';</script>\n";
        }
    }
}

if(isset($_GET['user_log_btn'])){
    $email=$_GET['email2'];
    $password=  $_GET['password2'];
    $conn = mysqli_connect("localhost","petmateadmin","rubenNshaivi","petmatedb");
    if(!$conn){
        echo "<script type='text/javascript'>alert('RELOAD:DATABASE CONNECTIVITY ERROR');</script>\n";
    }else{
        $sql = "select user_id from petmate_users where email = '$email' and pass_word='$password'";
        echo "<script type='text/javascript'>console.log(\"$sql\");</script>";
        $result = mysqli_query($conn,$sql);
        if($result->num_rows==0){
            echo "<script type='text/javascript'>alert('NO SUCH USER ACCOUNT!!');</script>";
        }else{
            $user_info = mysqli_fetch_all($result,MYSQLI_ASSOC);
            mysqli_free_result($result);
            mysqli_close($conn);
            $user_id = $user_info[0]['user_id'];
            $_SESSION['userid'] = $user_id;
            echo "<script type='text/javascript'>alert('your userid = $user_id');</script>\n";
            echo "<script type='text/javascript'>window.location.href='user.php';</script>\n";
        }
        
    }
}
?>
</body>
</html>
