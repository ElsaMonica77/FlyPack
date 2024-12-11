<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlyPack - Your Trusted Delivery Partner</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            padding: 120px 20px 100px;
            margin-top: 0;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero-title {
            font-size: 3.5rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 40px;
            font-weight: 300;
        }

        .hero-cta {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        .btn {
            padding: 15px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: transform 0.3s;
        }

        .btn:hover {
            transform: translateY(-3px);
        }

        .btn-primary {
            background: white;
            color: var(--primary-color);
        }

        .btn-secondary {
            background: transparent;
            border: 2px solid white;
            color: white;
        }

        /* Content Section */
        .home_content {
            padding: 80px 20px;
            background: var(--background-color);
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 50px;
            color: var(--secondary-color);
        }

        .content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .item {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .item:hover {
            transform: translateY(-5px);
        }

        .item-icon {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-top: 20px;
        }

        /* Testimonials */
        .testimonials {
            padding: 80px 20px;
            background: white;
        }

        .testimonial-slider {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .testimonial {
            padding: 30px;
            background: var(--background-color);
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .testimonial-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .testimonial-rating {
            color: gold;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <header class="main-menu">
        <div class="container">
            <img src="img/logo.png" alt="FlyPack" class="logo">
            <nav>
                <ul>
                    <li><a href="home_admin.php">Home</a></li>
                    <li><a href="manajemen_pengiriman.php">Manage</a></li>
                    <li><a href="my_account_admin.php">My Account</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Rest of the content remains the same -->
    <div class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Welcome to FlyPack!</h1>
            <h2 class="hero-subtitle">We serve you with exceptional quality</h2>
            <div class="hero-cta">
                <a href="delivery.php" class="btn btn-primary">Book Shipment</a>
                <a href="cek_resi.php" class="btn btn-secondary">Track Package</a>
            </div>
        </div>
    </div>

    <!-- Why Choose Us Section -->
    <div class="home_content">
        <h2 class="section-title">Why Should You Choose Us?</h2>
        <div class="content">
            <div class="item">
                <div class="item-icon">
                    <i class="fas fa-star"></i>
                </div>
                <p>We have a good and trusted reputation among customers, as evidenced by the many positive testimonials and satisfying reviews.</p>
                <img src="img/service.png" alt="Service Image">
            </div>
            <div class="item">
                <div class="item-icon">
                    <i class="fas fa-globe"></i>
                </div>
                <p>FlyPack has a wide network that reaches every corner of Indonesia, even to remote villages, ensuring reliable and timely service throughout the archipelago.</p>
                <img src="img/network.png" alt="Network Image">
            </div>
            <div class="item">
                <div class="item-icon">
                    <i class="fas fa-box"></i>
                </div>
                <p>We provide a complete range of expedition services, from general goods delivery, important documents, to valuable and fragile goods.</p>
                <img src="img/services.png" alt="Services Image">
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <h2 class="section-title">Customer Voices</h2>
        <div class="testimonial-slider">
            <div class="testimonial">
                <img src="img/CustomerG.png" alt="Customer Avatar" class="testimonial-avatar">
                <p>"FlyPack transformed my shipping experience. Reliable, fast, and always professional!"</p>
                <div class="testimonial-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h4>Sarah Johnson</h4>
            </div>
            <div class="testimonial">
                <img src="img/CustomerM.png" alt="Customer Avatar" class="testimonial-avatar">
                <p>"Incredible service that goes above and beyond. My packages always arrive safely and on time."</p>
                <div class="testimonial-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h4>Michael Chen</h4>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-logo">
            <img src="img/logo.png" alt="FlyPack">           
        </div>
            <div class="footer-links">
                <a href="contact_admin.php">Contact Us</a>
                <a href="privacy.php">Privacy Policy</a>
                <a href="terms.php">Terms of Service</a>
            </div>
            <div class="footer-social">
                <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <p>&copy; 2024 FlyPack. All rights reserved.</p>
    </footer>
</body>
</html>