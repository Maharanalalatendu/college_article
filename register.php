<?php
$v1=0;//this email is already exist
$v2=0;//successfuly created
session_start();
$servername = "localhost"; // e.g., localhost or 127.0.0.1
$username = "root";
$password = "";
$dbname = "college_project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo "Database connection failed. Please try again later.";
    error_log("MySQLi connection error: " . $conn->connect_error);
    exit();
  }

if ($_SERVER["REQUEST_METHOD"] === "POST") {
$signupName=$_POST["signupName"];
$signupEmail=$_POST["signupEmail"];
$signupPassword=$_POST["signupPassword"];
$sql1 = "SELECT * FROM user WHERE email = '$signupEmail'";
$result2=mysqli_query($conn,$sql1);
//echo"$result";
if ($result2->num_rows > 0) {
    $v1=1;
}else{
    $query="insert into `user`(`name`,`email`,`password`) value ('$signupName','$signupEmail','$signupPassword')";
    $result=mysqli_query($conn,$query);
    if($result==1){
        $_SESSION["id"]=1;
        $_SESSION["name"]=$signupName;
        $v2=1;
    }else{
        echo"db conn.. error";
    }
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Sign Up</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            position: relative; /* Added for absolute positioning of dots */
        }

        .dots {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 1.5em;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: calc(100% - 12px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }

        .form-group a {
            text-decoration: none;
            color: #007bff;
            font-size: 0.9em;
        }

        .form-group a:hover {
            text-decoration: underline;
        }

        #signup-form {
            display:box;
        }
    </style>
</head>
<body>
    <div class="container" id="signup-form" >
        <div class="dots">&#8942;</div> <h2>Sign Up</h2>
        <form id="signupForm" method="POST" action="register.php">
            <div class="form-group">
                <label for="signupName">Name*</label>
                <input type="text" id="signupName" name="signupName" required>
            </div>
            <div class="form-group">
                <label for="signupEmail">Email*</label>
                <input type="email" id="signupEmail" name="signupEmail" required>
            </div>
            <div class="form-group">
                <label for="signupPassword">Password*</label>
                <input type="password" id="signupPassword" name="signupPassword" required>
            </div>
            <div class="form-group">
                <button type="submit">Sign Up</button>
            </div>
            <div class="form-group">

               <?php
               if ($v1==1){
                echo"<p style='color:red;'>this email is already exist</p>";
                }
               if ($v2==1){
                echo"<p style='color:green;'>successfuly created</p>";
                echo"<script>window.location.replace('login.php')</script>";
               }
               
               ?>
            </div>
            
            <div class="form-group">
                <a href="login.php" id="loginLink">Login</a>
            </div>
        </form>
    </div>
</body>
</html>