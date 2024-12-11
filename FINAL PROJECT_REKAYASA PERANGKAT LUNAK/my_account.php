<?php
session_start();
include 'config.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

// Ambil data pengguna dari database
$user_id = $_SESSION['user_id'];
$sql = "SELECT name, email, phone FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Pengguna tidak ditemukan.";
    exit;
}

// Ambil data riwayat pengiriman pengguna dari database
$sql_shipments = "SELECT tracking_number, status FROM shipments WHERE user_id = ?";
$stmt_shipments = $conn->prepare($sql_shipments);
$stmt_shipments->bind_param("i", $user_id);
$stmt_shipments->execute();
$result_shipments = $stmt_shipments->get_result();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password, user_type FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_type'] = $user['user_type'];
            header("Location: my_account.php");
            exit;
        } else {
            $error_message = "Password salah.";
        }
    } else {
        $error_message = "Username tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .my-account {
            max-width: 800px;
            margin: 20vh auto 10vh;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .my-account h2 {
            text-align: center;
            color: #3498db;
        }

        .account-section {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .account-section h3 {
            margin-top: 0;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #2980b9;
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

    <div class="my-account">
        <h2>My Account</h2>
        
        <div class="account-section">
            <h3>Profile Information</h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
            <a href="edit_profile.php" class="btn">Edit Profile</a>
        </div>

        <div class="account-section">
            <h3>Shipment History</h3>
            <?php if ($result_shipments->num_rows > 0): ?>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid #ddd; padding: 8px;">Tracking Number</th>
                            <th style="border: 1px solid #ddd; padding: 8px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($shipment = $result_shipments->fetch_assoc()): ?>
                            <tr>
                                <td style="border: 1px solid #ddd; padding: 8px;"><?php echo htmlspecialchars($shipment['tracking_number']); ?></td>
                                <td style="border: 1px solid #ddd; padding: 8px;"><?php echo htmlspecialchars($shipment['status']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Tidak ada riwayat pengiriman.</p>
            <?php endif; ?>
        </div>
    </div>
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
</body>
</html>