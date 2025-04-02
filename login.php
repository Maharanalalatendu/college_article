<?php
 $t1=0;//successfuly login
 $t2=0;//invalide details
 $admin=0;
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
$loginEmail=$_POST["loginEmail"];
$loginPassword=$_POST["loginPassword"];
$sql = "SELECT * FROM user WHERE email = '$loginEmail' AND password ='$loginPassword'";
$result=mysqli_query($conn,$sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if($loginEmail=="abhi123@gmail.com" && $loginPassword=="1234"){
            $_SESSION["admin"]=1;
             $admin=1;
             $name = $row["name"];
             $_SESSION["id"]=1;
             $_SESSION["name"]=$name;
        }else{
        $_SESSION["admin"]=0;
        $name = $row["name"];
        $_SESSION["id"]=1;
        $_SESSION["name"]=$name;
        $t1=1;}
    }
}else{
    $t2=1;
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
            display: none;
        }
    </style>
</head>
<body>
    <div class="container" id="login-form">
        <div class="dots">&#8942;</div> <h2>Login</h2>
        <form id="loginForm" method="POST" action="login.php" >
            <div class="form-group">
                <label for="loginEmail">Email*</label>
                <input type="email" id="loginEmail" name="loginEmail" required>
            </div>
            <div class="form-group">
                <label for="loginPassword">Password*</label>
                <input type="password" id="loginPassword" name="loginPassword" required>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
            <div class="form-group">

               <?php
               if ($t1==1){
                echo"<p style='color:green;'>successfuly login</p>";
                echo"<script>window.location.replace('index.php')</script>";
                }
               if ($t2==1){
                echo"<p style='color:red;'>invalid details</p>";
               }
               if ($admin==1){
                echo"<script>window.location.replace('index.php')</script>";
                }  
               ?>
            </div>
            <div class="form-group">
                <a href="register.php" id="signupLink">Sign Up</a>
            </div>
        </form>
    </div>
</body>
</html>