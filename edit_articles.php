<?php
 $d=0;//Article delete successfuly
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
    if($_SESSION["admin"]==1){
    $status=$_POST["status"];
    $id=$_POST["id"];
    //DELETE FROM table_name WHERE condition;
    $sql = "UPDATE all_article SET status = '$status' WHERE id = '$id'";
    $result=mysqli_query($conn,$sql);
    if($result==1){
       $d=1;
    }
  }else{
    echo"<script>window.location.replace('login.php')</script>";
  }
  } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>View Article - College Article Management System</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
    }
    header {
      background-color: #007bff;
      padding: 1rem 0;
      text-align: center;
    }
    nav a {
      color: white;
      text-decoration: none;
      font-size: 1.2rem;
    }
    .article-container {
      padding: 40px 20px;
    }
    .article {
      background-color: white;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .article h1 {
      font-size: 2rem;
      margin-bottom: 10px;
      color: #007bff;
      cursor: pointer;
    }
    .article .meta-info {
      font-size: 0.95rem;
      color: #777;
      margin-bottom: 10px;
    }
    .article p {
      font-size: 1rem;
      line-height: 1.6;
      color: #333;
    }
    .article .full-content.visible {
      display: block;
    }
    .deleteBtn{
      border:1px solid red;
      background:white;
      border-radius:10px;
      padding:2px 6px;
      font-weight:bold;
    }
  .deleteBtn:hover{
    border:1px solid white;
      background:red;
      color:white;
      border-radius:10px;
      padding:2px 6px;
  }
  .deleteBtn:active{
      transform:scale(0.95);
  }
  </style>
</head>
<body>
  <header>
    <nav>
      <a href="index.php">Home</a>
    </nav>
  </header>
  <div class="article-container">
  <?php
        if($d==1){
          echo"<p style='color:green;'>Submitted successfully</p>";
          
        }
      $sql = "SELECT * FROM all_article ORDER BY date_time DESC";
      $result=mysqli_query($conn,$sql);
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {  
  echo'
    <div class="article">
      <h1 >'.$row["title"].'</h1> 
            <p class="meta-info">Published by: <b>'.$row["name"].' </b><br><span style="font-size:12px; margin-top:0px; color:#9b9b9b;"> on:'.$row["date_time"].'</span></p>
            <details>
              <summary style="color:gray; font-size:14px;">'.$row["title"].'...</summary>
              <p class="full-content">'.$row["description"].'</p>
            </details>  
            <form style="margin:10px 0px;" method="POST" action="edit_articles.php">';
            if($row["status"]==1){
            echo'<input style="display:none;" type="text" name="status" value="0"> 
            <input style="display:none;" type="text" name="id" value='.$row["id"].'> 
            <button class="deleteBtn">Reject</button></form> 
            <form style="margin:10px 0px;" method="POST" action="edit_articles.php">
            <input style="display:none;" type="text" name="status" value="2"> 
            <input style="display:none;" type="text" name="id" value='.$row["id"].'>
            <button class="deleteBtn">Approve</button></form>';}
            else{echo "submitted";}

   echo" </div> ";
}
}else{
    echo"not found article.......";
}

?>
</div>
</body>
</html>

