<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "college_project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo "<div class='database-error'>Database connection failed. Please try again later.</div>";
    error_log("MySQLi connection error: " . $conn->connect_error);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Articles - College Article Management System</title>
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
        
        .articles-container {
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
        
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
        }
        
        .article-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        
        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }
        
        .article-header {
            padding: 1.5rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
        }
        
        .article-header h2 {
            font-size: 1.4rem;
            margin-bottom: 0.5rem;
            cursor: pointer;
        }
        
        .article-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            opacity: 0.9;
        }
        
        .article-body {
            padding: 1.5rem;
        }
        
        .article-excerpt {
            color: var(--text-light);
            margin-bottom: 1.5rem;
            line-height: 1.7;
        }
        
        .read-more {
            display: inline-block;
            color: var(--primary);
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .read-more:hover {
            color: var(--secondary);
        }
        
        .read-more i {
            margin-left: 5px;
            transition: transform 0.3s ease;
        }
        
        .read-more.active i {
            transform: rotate(180deg);
        }
        
        .article-full {
            display: none;
            padding-top: 1rem;
            border-top: 1px solid #eee;
            margin-top: 1rem;
            color: var(--text);
            line-height: 1.8;
        }
        
        .article-full.visible {
            display: block;
            animation: fadeIn 0.3s ease;
        }
        
        .no-articles {
            text-align: center;
            grid-column: 1 / -1;
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
        
        .btn {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            background: #3d44a5;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 84, 200, 0.3);
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            
            .articles-grid {
                grid-template-columns: 1fr;
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
                <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
                    <a href="edit_articles.php"><i class="fas fa-cog"></i> Admin</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <div class="articles-container">
        <div class="page-header">
            <h1>College Articles</h1>
            <p>Explore the latest research, opinions, and creative works from our college community</p>
        </div>
        
        <div class="articles-grid">
            <?php
            $X=2;
            $sql = "SELECT * FROM all_article WHERE STATUS='$X' ORDER BY date_time DESC";
            $result = mysqli_query($conn, $sql);
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $excerpt = strlen($row["description"]) > 150 ? substr($row["description"], 0, 150) . '...' : $row["description"];
                    $date = date("F j, Y", strtotime($row["date_time"]));
                    
                    echo '
                    <div class="article-card">
                        <div class="article-header">
                            <h2 onclick="toggleArticle(this)">' . htmlspecialchars($row["title"]) . '</h2>
                            <div class="article-meta">
                                <span><i class="fas fa-user"></i> ' . htmlspecialchars($row["name"]) . '</span>
                                <span><i class="fas fa-calendar-alt"></i> ' . $date . '</span>
                            </div>
                        </div>
                        <div class="article-body">
                            <p class="article-excerpt">' . htmlspecialchars($excerpt) . '</p>
                            <a href="#" class="read-more" onclick="toggleArticle(this); return false;">
                                Read more <i class="fas fa-chevron-down"></i>
                            </a>
                            <div class="article-full">
                                ' . nl2br(htmlspecialchars($row["description"])) . '
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo '
                <div class="no-articles">
                    <i class="fas fa-newspaper"></i>
                    <h3>No Articles Found</h3>
                    <p>There are currently no articles available. Be the first to submit one!</p>
                    <a href="submit_article.php" class="btn">
                        <i class="fas fa-plus-circle"></i> Submit Article
                    </a>
                </div>';
            }
            ?>
        </div>
    </div>

    <script>
        function toggleArticle(element) {
            const articleCard = element.closest('.article-card');
            const fullContent = articleCard.querySelector('.article-full');
            const readMoreLink = articleCard.querySelector('.read-more');
            const chevron = articleCard.querySelector('.read-more i');
            
            fullContent.classList.toggle('visible');
            readMoreLink.classList.toggle('active');
            
            if (fullContent.classList.contains('visible')) {
                readMoreLink.textContent = 'Read less ';
            } else {
                readMoreLink.textContent = 'Read more ';
            }
            
            // Add the icon back after changing text
            readMoreLink.appendChild(chevron);
        }
    </script>
</body>
</html>