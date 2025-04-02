<?php
// Session must start before ANY output
session_start();
//$_SESSION["admin"]=0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>College Article Management</title>
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
            --gradient: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7ff;
            color: var(--dark);
            line-height: 1.6;
        }
        
        header {
            background: var(--gradient);
            color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 5%;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(to right, #fff, #e0e0e0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
        }
        
        .logo i {
            margin-right: 10px;
            font-size: 1.5rem;
        }
        
        nav ul {
            display: flex;
            list-style: none;
            align-items: center;
        }
        
        nav ul li {
            margin-left: 1.5rem;
        }
        
        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            display: flex;
            align-items: center;
        }
        
        nav ul li a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }
        
        nav ul li a i {
            margin-right: 8px;
            font-size: 0.9rem;
        }

        /* Rest of your CSS remains unchanged */
        .hero {
            position: relative;
            height: 80vh;
            display: flex;
            align-items: center;
            background: url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center/cover;
            color: white;
            text-align: center;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
            animation: fadeInUp 1s ease;
        }
        
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .hero p {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            transition: all 0.3s ease;
        }
        
        .hero p.expanded {
            -webkit-line-clamp: unset;
            display: block;
        }
        
        .view-more {
            display: inline-block;
            color: white;
            background: transparent;
            border: none;
            font-size: 1rem;
            text-decoration: underline;
            cursor: pointer;
            margin-top: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .view-more:hover {
            color: var(--accent);
        }
        
        .view-more i {
            margin-left: 5px;
            transition: transform 0.3s ease;
        }
        
        .view-more.expanded i {
            transform: rotate(180deg);
        }
        
        .features {
            padding: 5rem 5%;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .features h2 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: var(--primary);
            position: relative;
        }
        
        .features h2::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: var(--accent);
            margin: 1rem auto;
            border-radius: 2px;
        }
        
        .feature-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            text-align: center;
            border-top: 4px solid var(--primary);
        }
        
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        
        .card i {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }
        
        .card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--dark);
        }
        
        .card p {
            color: #666;
        }
        
        footer {
            background: var(--dark);
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: 3rem;
        }
        
        .social-links a {
            color: white;
            margin: 0 10px;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            color: var(--accent);
            transform: translateY(-3px);
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
            
            .logo {
                margin-bottom: 1rem;
            }
            
            nav ul {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            nav ul li {
                margin: 0.5rem;
            }
            
            .hero h1 {
                font-size: 2.2rem;
            }
            
            .hero p {
                font-size: 1rem;
            }
            
            .feature-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo"><i class="fas fa-book-open"></i>College Articles</div>
            <ul>
            <?php 
            //    unset($_SESSION["admin"]);
            //    unset($_SESSION["id"]);
            //    unset($_SESSION["name"]);
                 if(isset($_SESSION["admin"])&&$_SESSION["admin"]==0){
                echo'<li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="submit_article.php"><i class="fas fa-plus-circle"></i> Submit Article</a></li>
                <li><a href="article_status.php"><i class="fas fa-clipboard-check"></i> Article Status</a></li>';
                 }?>
                 <li><a href="view_articles.php"><i class="fas fa-search"></i> View Articles</a></li>
                <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                <?php if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1){
                    echo '<li><a href="edit_articles.php"><i class="fas fa-cog"></i> Admin</a></li>';
                }    
                ?>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to MPC Autonomous College Article Portal</h1>
            <p id="hero-paragraph">The MPC College Article Portal is your gateway to academic excellence and intellectual exchange. Our platform hosts a diverse collection of scholarly articles, research papers, and creative works from students and faculty across all disciplines. Whether you're looking to publish your latest research, explore new ideas, or engage in academic discourse, our portal provides the perfect environment. With rigorous editorial standards and an easy-to-use interface, we make knowledge sharing accessible to everyone in our college community. Join us in building a repository of knowledge that inspires learning and innovation.</p>
            <button class="view-more" id="view-more-btn">View More <i class="fas fa-chevron-down"></i></button>
        </div>
    </section>

    <section class="features">
        <h2>Why Join Our Community?</h2>
        <div class="feature-cards">
            <div class="card">
                <i class="fas fa-pen-fancy"></i>
                <h3>Submit Articles</h3>
                <p>Share your research, opinions, and creative works with the college community through our easy submission process.</p>
            </div>
            <div class="card">
                <i class="fas fa-search"></i>
                <h3>Discover Content</h3>
                <p>Explore a diverse collection of articles across various disciplines written by students and faculty members.</p>
            </div>
            <div class="card">
                <i class="fas fa-users-cog"></i>
                <h3>Quality Control</h3>
                <p>Our editorial team ensures all published content meets academic standards while encouraging creative expression.</p>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 MPC College Article Management System. All rights reserved.</p>
        <div class="social-links">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paragraph = document.getElementById('hero-paragraph');
            const viewMoreBtn = document.getElementById('view-more-btn');
            
            viewMoreBtn.addEventListener('click', function() {
                paragraph.classList.toggle('expanded');
                viewMoreBtn.classList.toggle('expanded');
                
                // Remove existing icon
                const oldIcon = viewMoreBtn.querySelector('i');
                if (oldIcon) oldIcon.remove();
                
                // Update text and add new icon
                if (paragraph.classList.contains('expanded')) {
                    viewMoreBtn.textContent = 'View Less ';
                    const iconUp = document.createElement('i');
                    iconUp.className = 'fas fa-chevron-up';
                    viewMoreBtn.appendChild(iconUp);
                } else {
                    viewMoreBtn.textContent = 'View More ';
                    const iconDown = document.createElement('i');
                    iconDown.className = 'fas fa-chevron-down';
                    viewMoreBtn.appendChild(iconDown);
                }
            });
        });
    </script>
</body>
</html>