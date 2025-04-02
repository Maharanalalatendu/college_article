<?php
$x = 0; // Do you want to view all the articles.
$state = true;
session_start();
$id = $_SESSION["id"] ?? null;
$name = $_SESSION["name"] ?? '';

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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = htmlspecialchars($_POST["title"]);
    $content = htmlspecialchars($_POST["content"]);
    
    if($id == 1) {
        $now = new DateTime();
        $formattedDateTime = $now->format('Y-m-d H:i:s.000000');
        $query = "INSERT INTO `all_article`(`name`,`title`,`description`,`date_time`) VALUES ('$name','$title','$content','$formattedDateTime')";
        $result = mysqli_query($conn, $query);
        if($result == 1) {
            $x = 1;
        } else { 
            echo "<div class='error-message'>Database connection error</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Submit Article - College Article Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        function validateForm() {
            const title = document.getElementById('title').value.trim();
            const content = document.getElementById('content').value.trim();
            if (title === '' || content === '') {
                showToast('Both title and content are required!', 'error');
                return false;
            }
            return true;
        }

        function showToast(message, type) {
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.innerHTML = `
                <i class="fas ${type === 'error' ? 'fa-exclamation-circle' : 'fa-check-circle'}"></i>
                <span>${message}</span>
                <i class="fas fa-times close-toast" onclick="this.parentElement.remove()"></i>
            `;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 5000);
        }
    </script>
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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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
        
        .submit-article-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }
        
        .submit-article-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 800px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        
        .submit-article-card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        
        .card-header h2 {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }
        
        .card-header p {
            opacity: 0.9;
            font-size: 0.95rem;
        }
        
        .card-body {
            padding: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }
        
        .form-control {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(78, 84, 200, 0.2);
            outline: none;
        }
        
        textarea.form-control {
            min-height: 200px;
            resize: vertical;
        }
        
        .btn {
            display: inline-block;
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            width: 100%;
        }
        
        .btn:hover {
            background: #3d44a5;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 84, 200, 0.3);
        }
        
        .btn-secondary {
            background: white;
            color: var(--primary);
            border: 1px solid var(--primary);
        }
        
        .btn-secondary:hover {
            background: #f8f9fa;
        }
        
        /* Popup styles */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        
        .popup {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 2rem;
            max-width: 400px;
            width: 90%;
            text-align: center;
            animation: fadeInUp 0.3s ease;
        }
        
        .popup h3 {
            margin-bottom: 1rem;
            color: var(--dark);
        }
        
        .popup p {
            margin-bottom: 1.5rem;
            color: var(--text-light);
        }
        
        .popup-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }
        
        .close-popup {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: var(--text-light);
        }
        
        /* Toast notification */
        .toast {
            position: fixed;
            top: 1rem;
            right: 1rem;
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 0.8rem;
            z-index: 1000;
            animation: slideIn 0.3s ease;
        }
        
        .toast.error {
            border-left: 4px solid var(--danger);
        }
        
        .toast.success {
            border-left: 4px solid var(--success);
        }
        
        .toast i.fa-exclamation-circle {
            color: var(--danger);
        }
        
        .toast i.fa-check-circle {
            color: var(--success);
        }
        
        .close-toast {
            margin-left: 1rem;
            cursor: pointer;
            color: var(--text-light);
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
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
            
            .nav-links {
                margin-top: 1rem;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .submit-article-card {
                margin: 1rem;
            }
            
            .card-header h2 {
                font-size: 1.5rem;
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
                <a href="view_articles.php"><i class="fas fa-newspaper"></i> View Articles</a>
                <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
                    <a href="edit_articles.php"><i class="fas fa-cog"></i> Admin</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <?php if ($id != 1): ?>
        <div class="popup-overlay">
            <div class="popup">
                <button class="close-popup" onclick="window.location.href='login.php'">
                    <i class="fas fa-times"></i>
                </button>
                <h3>Login Required</h3>
                <p>You need to be logged in to submit articles. Please login to continue.</p>
                <div class="popup-buttons">
                    <button class="btn" onclick="window.location.href='login.php'">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                    <button class="btn btn-secondary" onclick="window.location.href='index.php'">
                        <i class="fas fa-home"></i> Go Home
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($x == 1): ?>
        <div class="popup-overlay">
            <div class="popup">
                <button class="close-popup" onclick="window.location.href='submit_article.php'">
                    <i class="fas fa-times"></i>
                </button>
                <h3>Article Submitted!</h3>
                <p>Your article has been successfully submitted. Would you like to view all articles?</p>
                <div class="popup-buttons">
                    <button class="btn" onclick="window.location.href='view_articles.php'">
                        <i class="fas fa-newspaper"></i> View Articles
                    </button>
                    <button class="btn btn-secondary" onclick="window.location.href='submit_article.php'">
                        <i class="fas fa-plus"></i> Submit Another
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="submit-article-container">
        <div class="submit-article-card">
            <div class="card-header">
                <h2>Submit Your Article</h2>
                <p>Share your knowledge with the college community</p>
            </div>
            <div class="card-body">
                <form action="submit_article.php" method="post" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label for="title">Article Title</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Enter your article title" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Article Content</label>
                        <textarea id="content" name="content" class="form-control" placeholder="Write your article content here..." required></textarea>
                    </div>
                    <?php if ($state == true): ?>
                        <button type="submit" class="btn">
                            <i class="fas fa-paper-plane"></i> Submit Article
                        </button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Close popup when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('popup-overlay')) {
                window.location.href = 'login.php';
            }
        });
    </script>
</body>
</html>