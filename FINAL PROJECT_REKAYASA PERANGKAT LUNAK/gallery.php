<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - FlyPack</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .slider {
            position: relative;
            width: 100%;
            height: 80vh;
            overflow: hidden;
            margin-top: 80px;
        }

        .slide {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .slide.active {
            opacity: 1;
        }

        .slider-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }

        .prev, .next {
            background-color: rgba(0,0,0,0.5);
            color: white;
            padding: 15px;
            text-decoration: none;
            font-size: 24px;
            transition: background-color 0.3s ease;
        }

        .prev:hover, .next:hover {
            background-color: rgba(0,0,0,0.7);
        }

    </style>
</head>
<body>
    <header class="main-menu">
        <div class="container">
            <img src="img/logo.png" alt="FlyPack" class="logo">
            <nav>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="gallery.php">Gallery</a></li>
                    <li><a href="delivery.php">Delivery</a></li>
                    <li><a href="cek_resi.php">Track Shipment</a></li>
                    <li><a href="contact.php">About Us</a></li>
                    <li><a href="my_account.php">My Account</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="slider">
        <img src="img/foto_1.jpg" alt="foto_dok_1" class="slide active">
        <img src="img/foto_2.jpg" alt="foto_dok_2" class="slide">
        <img src="img/foto_3.jpg" alt="foto_dok_3" class="slide">
        <img src="img/foto_4.jpg" alt="foto_dok_4" class="slide">
        
        <div class="slider-nav">
            <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
            <a class="next" onclick="changeSlide(1)">&#10095;</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-logo">
            <img src="img/logo.png" alt="FlyPack">            </div>
            <div class="footer-links">
                <a href="contact.php">Contact Us</a>
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

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');

        function changeSlide(direction) {
            slides[currentSlide].classList.remove('active');
            
            currentSlide += direction;
            
            if (currentSlide >= slides.length) {
                currentSlide = 0;
            }
            
            if (currentSlide < 0) {
                currentSlide = slides.length - 1;
            }
            
            slides[currentSlide].classList.add('active');
        }

        // Otomatis ganti slide setiap 5 detik
        setInterval(() => {
            changeSlide(1);
        }, 5000);
    </script>
</body>
</html>