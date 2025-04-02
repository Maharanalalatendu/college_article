<?php
// Session must start before ANY output
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Status - College Article Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4e54c8;
            --secondary: #8f94fb;
            --accent: #ff7e5f;
            --light: #f8f9fa;
            --dark: #343a40;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --text: #333;
            --text-light: #777;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7ff;
            color: var(--text);
            line-height: 1.6;
        }
        
        header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 5%;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: 600;
            color: white;
            display: flex;
            align-items: center;
        }
        
        .logo i {
            margin-right: 10px;
        }
        
        .nav-links {
            display: flex;
            gap: 1.5rem;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }
        
        .nav-links a:hover {
            transform: translateY(-2px);
        }
        
        .nav-links a i {
            margin-right: 8px;
        }
        
        .status-container {
            padding: 3rem 5%;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .page-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .page-header h1 {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }
        
        .page-header h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--accent);
            border-radius: 2px;
        }
        
        .page-header p {
            color: var(--text-light);
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .status-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .status-table th, .status-table td {
            padding: 1.2rem 1.5rem;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        
        .status-table th {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            font-weight: 500;
        }
        
        .status-table tr:last-child td {
            border-bottom: none;
        }
        
        .status-table tr:hover {
            background-color: rgba(79, 84, 200, 0.05);
        }
        
        .status-badge {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .status-pending {
            background-color: rgba(255, 193, 7, 0.2);
            color: #b78a00;
        }
        
        .status-approved {
            background-color: rgba(40, 167, 69, 0.2);
            color: #1e7e34;
        }
        
        .status-rejected {
            background-color: rgba(220, 53, 69, 0.2);
            color: #c82333;
        }
        
        .no-articles {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .no-articles i {
            font-size: 3rem;
            color: var(--text-light);
            margin-bottom: 1.5rem;
        }
        
        .no-articles h3 {
            color: var(--dark);
            margin-bottom: 1rem;
        }
        
        .no-articles p {
            color: var(--text-light);
            margin-bottom: 1.5rem;
        }
        
        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                padding: 1rem;
            }
            
            .logo {
                margin-bottom: 1rem;
            }
            
            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
                gap: 1rem;
            }
            
            .status-table {
                display: block;
                overflow-x: auto;
            }
            
            .page-header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <i class="fas fa-book-open"></i>
                <span>College Articles</span>
            </div>
            <div class="nav-links">
                <a href="index.php"><i class="fas fa-home"></i> Home</a>
                <a href="submit_article.php"><i class="fas fa-plus-circle"></i> Submit Article</a>
                <!-- <a href="edit_articles.php"><i class="fas fa-cog"></i> Admin</a> -->
            </div>
        </nav>
    </header>

    <div class="status-container">
        <div class="page-header">
            <h1>Article Status</h1>
            <p>Track the status of your submitted articles</p>
        </div>
        
        <!-- Example with articles -->
         <?php
          if($_SESSION["id"]==1){  
        echo'<table class="status-table">
            <thead>
                <tr>
                    <th>Article Title</th>
                    <th>Submission Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>';
            $name=$_SESSION["name"];
            $sql = "SELECT * FROM all_article WHERE name='$name' ORDER BY date_time DESC";
            $result = mysqli_query($conn, $sql);
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $excerpt = strlen($row["description"]) > 150 ? substr($row["description"], 0, 150) . '...' : $row["description"];
                    $date = date("F j, Y", strtotime($row["date_time"]));
                echo'<tr>
                    <td>'.$row["title"].'</td>
                    <td>'.$date.'</td>
                    <td>';
                    if($row["status"]==0){
                        echo'<span class="status-badge status-rejected">
                            <i class="fas fa-times-circle"></i> Rejected
                        </span>';}
                    if($row["status"]==1){
                        echo'<span class="status-badge status-pending">
                            <i class="fas fa-clock"></i> Pending
                        </span>';}
                    if($row["status"]==2){
                            echo'<span class="status-badge status-approved">
                                <i class="fas fa-check-circle"></i> Approved
                            </span>';}
                    echo'</td>
                </tr>';}}
             echo'</tbody>
        </table>';}else{echo "you are not yet login";}?>
        
        <!-- Example empty state (comment out when using the table above) -->
        <!--
        <div class="no-articles">
            <i class="fas fa-newspaper"></i>
            <h3>No Articles Submitted</h3>
            <p>You haven't submitted any articles yet. Submit your first article to see its status here.</p>
        </div>
        -->
    </div>
</body>
</html>