<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - FlyPack</title>
    <link rel="stylesheet" href="css/style.css"/>
    <style>
        /* Styles untuk company-info section */
        #company-info {
            background-color: var(--white-color);
            padding: 50px 0;
        }

        .company-details {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .detail-card {
            text-align: center;
            background: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .detail-card:hover {
            transform: translateY(-10px);
        }

        .detail-card i {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        /* Styles untuk contact form */
        #contact-form {
            background: var(--background-color);
            padding: 50px 0;
            display: flex; /* Tambahkan */
            justify-content: center; /* Tambahkan */
            align-items: center; /* Tambahkan */
            min-height: 100vh; /* Pastikan tinggi minimum untuk memusatkan secara vertikal */
        }

        #contact-form .container {
            max-width: 600px;
            width: 100%; /* Tambahkan agar form responsif */
            background: #fff; /* Tambahkan untuk latar belakang form */
            padding: 30px; /* Tambahkan untuk ruang dalam */
            border-radius: 10px; /* Tambahkan untuk sudut membulat */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Tambahkan untuk efek bayangan */
        }

        #contact-form h2 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--secondary-color);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px; /* Tambahkan untuk ukuran font */
        }
        .submit-btn {
            display: block;
            width: 100%;
            padding: 15px;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
        }

        /* Team Section */
        #team {
            padding: 50px 0;
            text-align: center;
        }

        #team h2 {
            margin-bottom: 50px;
            color: var(--secondary-color);
            position: relative;
        }

        #team h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: var(--primary-color);
        }

        .team-members {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .team-member {
            background: var(--white-color);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 300px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-10px);
        }

        .member-photo {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .member-info {
            padding: 20px;
            text-align: center;
        }

        .member-info h3 {
            color: var(--secondary-color);
            margin-bottom: 10px;
        }

        .social-media {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 15px;
        }

        .social-media a {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .social-media a:hover {
            color: var(--secondary-color);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .team-members {
                flex-direction: column;
                align-items: center;
            }

            .team-member {
                width: 90%;
            }
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
    
    <div id="intro">
        <h1>We Serve with Passion and Dedication!</h1>
    </div>

    <section id="team">
        <h2>Meet Our Team</h2>
        <div class="team-members">
            <div class="team-member">
                <img src="img/elsa.jpg" alt="Elsa Monica Siwy" class="member-photo">
                <div class="member-info">
                    <h3>Elsa Monica Siwy</h3>
                    <p>Mahasiswa</p>
                    <p>230211060003</p>
                    <div class="social-media">
                        <a href="https://wa.me/6281340298862" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        <a href="https://www.instagram.com/elsamonicasiwy" target="_blank"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="team-member">
                <img src="img/preis.jpg" alt="Praise Maria Permata Moniaga" class="member-photo">
                <div class="member-info">
                    <h3>Praise Maria Permata Moniaga</h3>
                    <p>Mahasiswa</p>
                    <p>230211060088</p>
                    <div class="social-media">
                        <a href="https://wa.me/6282191315664" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        <a href="https://www.instagram.com/praisemnga" target="_blank"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="team-member">
                <img src="img/nobi.jpg" alt="Nobiana Audrey Lie" class="member-photo">
                <div class="member-info">
                    <h3>Nobiana Audrey Lie</h3>
                    <p>Mahasiswa</p>
                    <p>230211060100</p>
                    <div class="social-media">
                        <a href="https://wa.me/6281351560119" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        <a href="https://www.instagram.com/naudreylie" target="_blank"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="company-info">
        <div class="container">
            <div class="company-details">
                <div class="detail-card">
                    <i class="fas fa-globe"></i>
                    <h4>Our Mission</h4>
                    <p>Memberikan solusi pengiriman terbaik dengan teknologi canggih dan pelayanan prima.</p>
                </div>
                <div class="detail-card">
                    <i class="fas fa-box"></i>
                    <h4>Our Services</h4>
                    <p>Pengiriman cepat, aman, dan terpercaya untuk kebutuhan logistik Anda.</p>
                </div>
                <div class="detail-card">
                    <i class="fas fa-users"></i>
                    <h4>Our Vision</h4>
                    <p>Menjadi platform logistik terdepan yang menghubungkan pelanggan secara global.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="contact-form">
        <div class="container">
            <h2>Contact Us</h2>
            <form>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit" class="submit-btn">Send Message</button>
            </form>
        </div>
    </section>

     <!-- Footer -->
     <footer class="footer">
        <div class="footer-content">
            <div class="footer-logo">
                <img src="img/logo.png" alt="FlyPack">
            </div>
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
        // Form validation
        document.querySelector('#contact-form form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;

            if (name.trim() === '' || email.trim() === '' || message.trim() === '') {
                alert('Please fill in all fields');
                return;
            }

            // Anda bisa menambahkan logika pengiriman form di sini
            alert('Message sent successfully!');
            this.reset();
        });
    </script>
</body>
</html>