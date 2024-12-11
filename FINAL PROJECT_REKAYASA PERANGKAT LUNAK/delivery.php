<?php
session_start();
include 'config.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $nama_pengirim = $_POST['nama_pengirim'];
    $alamat_asal = $_POST['alamat_asal'];
    $nama_penerima = $_POST['nama_penerima'];
    $alamat_tujuan = $_POST['alamat_tujuan'];
    $layanan = $_POST['layanan'];

    // Data tambahan
    $user_id = $_SESSION['user_id'];
    $tracking_number = uniqid('TRACK'); // Buat nomor pelacakan unik
    $status = 'Pending'; // Status default
    $shipment_date = date('Y-m-d H:i:s'); // Tanggal saat ini

    // Buat SQL untuk menyimpan data ke dalam tabel shipments
    $sql = "INSERT INTO shipments (user_id, tracking_number, status, shipment_date, sender, sender_address, receiver, receiver_address, service) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssssss", $user_id, $tracking_number, $status, $shipment_date, $nama_pengirim, $alamat_asal, $nama_penerima, $alamat_tujuan, $layanan);

    // Jalankan query SQL
    if ($stmt->execute()) {
        // Data berhasil disimpan, lakukan tindakan lain jika diperlukan
        $success_message = "Data pengiriman berhasil disimpan.";
    } else {
        // Jika terjadi kesalahan saat menyimpan data
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery - FlyPack</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .main-content {
            max-width: 600px;
            margin: 100px auto 50px;
            background-color: var(--white-color);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .main-content h1 {
            text-align: center;
            color: var(--secondary-color);
            margin-bottom: 30px;
            font-size: 2rem;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
        }

        .form-container label {
            margin-bottom: 5px;
            color: var(--secondary-color);
            font-weight: 600;
        }

        .form-container input,
        .form-container select {
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-container input:focus,
        .form-container select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(52,152,219,0.2);
        }

        .submit {
            background-color: var(--primary-color);
            color: var(--white-color);
            border: none;
            padding: 15px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit:hover {
            background-color: #2980b9;
        }

        .success-message {
            background-color: #2ecc71;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        .error-message {
            background-color: #e74c3c;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
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

    <div class="main-content">
        <h1>Enter the Delivery Details</h1>
        <div class="form-container">
            <?php
            if (isset($success_message)) {
                echo "<p class='success-message'>$success_message</p>";
            }
            if (isset($error_message)) {
                echo "<p class='error-message'>$error_message</p>";
            }
            ?>
            <form action="delivery.php" method="POST">
                <label for="nama_pengirim">Sender Name</label>
                <input type="text" id="nama_pengirim" name="nama_pengirim" required>
                
                <label for="alamat_asal">Pickup Address</label>
                <input type="text" id="alamat_asal" name="alamat_asal" required>
                
                <label for="nama_penerima">Recipient Name</label>
                <input type="text" id="nama_penerima" name="nama_penerima" required>
                
                <label for="alamat_tujuan">Delivery Address</label>
                <input type="text" id="alamat_tujuan" name="alamat_tujuan" required>
                
                <label for="layanan">Select Service Type</label>
                <select id="layanan" name="layanan" required>
                    <option value="">~ Select Service ~</option>
                    <option value="Biasa">Regular</option>
                    <option value="Express">Express</option>
                    <option value="Kilat">Priority</option>
                </select>
                
                <button type="submit" class="submit">Submit Delivery</button>
            </form>
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
</body>
</html>