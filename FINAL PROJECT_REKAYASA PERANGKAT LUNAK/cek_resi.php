<?php
session_start();
include 'config.php';

$tracking_number = "";
$status = "";
$shipment_date = "";
$sender = "";
$receiver = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tracking_number = $_POST['tracking_number'];

    // Buat SQL untuk mencari data berdasarkan nomor resi
    $sql = "SELECT tracking_number, status, shipment_date, sender, receiver FROM shipments WHERE tracking_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $tracking_number);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($tracking_number, $status, $shipment_date, $sender, $receiver);
        $stmt->fetch();
    } else {
        $error_message = "Tracking number not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlyPack - Shipment Tracking</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Main Content */
        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 200px);
            margin-top: 100px;
            padding: 20px;
        }

        #introduces {
            background-color: var(--white-color);
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 600px;
            padding: 40px;
            text-align: center;
        }

        #introduces h1 {
            color: var(--secondary-color);
            margin-bottom: 30px;
            font-size: 2rem;
        }

        .cek-resi-form {
            margin-bottom: 30px;
        }

        .cek-resi-form form {
            display: flex;
            gap: 10px;
        }

        .cek-resi-form input {
            flex-grow: 1;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .cek-resi-form input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(52,152,219,0.2);
        }

        .cek-resi-form button {
            background-color: var(--primary-color);
            color: var(--white-color);
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .cek-resi-form button:hover {
            background-color: #2980b9;
        }

        .error-message {
            color: #e74c3c;
            margin-bottom: 20px;
            text-align: center;
        }

        .shipment-details {
            background-color: #f9f9f9;
            border-radius: 5px;
            padding: 20px;
            text-align: left;
        }

        .shipment-details p {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .shipment-details p strong {
            min-width: 150px;
            margin-right: 10px;
            color: var(--secondary-color);
        }

        .status-indicator {
            display: inline-block;
            margin-left: 10px;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .status-pending {
            background-color: #f39c12;
            color: white;
        }

        .status-transit {
            background-color: #3498db;
            color: white;
        }

        .status-delivered {
            background-color: #2ecc71;
            color: white;
        }

        /* Tracking Progress Styles */
        .tracking-progress {
            margin-top: 30px;
            background-color: #f9f9f9;
            border-radius: 5px;
            padding: 20px;
        }

        .tracking-progress h3 {
            text-align: center;
            color: var(--secondary-color);
            margin-bottom: 20px;
        }

        .progress-timeline {
            display: flex;
            justify-content: space-between;
            position: relative;
        }

        .progress-timeline::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 0;
            right: 0;
            height: 4px;
            background-color: #e0e0e0;
            z-index: 1;
        }

        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
            background-color: white;
            padding: 10px;
            border-radius: 50%;
        }

        .progress-step i {
            font-size: 24px;
            color: #bbb;
            margin-bottom: 10px;
        }

        .progress-step.completed i {
            color: var(--primary-color);
        }

        .progress-step span {
            font-size: 0.8rem;
            color: #666;
        }

        .progress-step.completed span {
            color: var(--secondary-color);
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
        <div id="introduces">
            <h1>Shipment Tracking</h1>
            <div class="cek-resi-form">
                <form method="post" action="cek_resi.php">
                    <input type="text" name="tracking_number" placeholder="Enter Tracking Number" required>
                    <button type="submit">
                        <i class="fas fa-search"></i> Track Shipment
                    </button>
                </form>
            </div>
            <?php
            if (!empty($error_message)) {
                echo "<p class='error-message'><i class='fas fa-exclamation-circle'></i> $error_message</p>";
            } else if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($tracking_number)) {
                // Tentukan kelas status berdasarkan status pengiriman
                $status_class = '';
                switch(strtolower($status)) {
                    case 'pending':
                        $status_class = 'status-pending';
                        break;
                    case 'transit':
                        $status_class = 'status-transit';
                        break;
                    case 'delivered':
                        $status_class = 'status-delivered';
                        break;
                    default:
                        $status_class = '';
                }

                echo "<div class='shipment-details'>";
                echo "<p><strong><i class='fas fa-barcode'></i> Tracking Number:</strong> $tracking_number</p>";
                echo "<p><strong><i class='fas fa-info-circle'></i> Status:</strong> $status <span class='status-indicator $status_class'>$status</span></p>";
                echo "<p><strong><i class='fas fa-calendar-alt'></i> Shipment Date:</strong> $shipment_date</p>";
                echo "<p><strong><i class='fas fa-user-circle'></i> Sender:</strong> $sender</p>";
                echo "<p><strong><i class='fas fa-map-marker-alt'></i> Receiver:</strong> $receiver</p>";
                echo "</div>";

                // Tambahkan tracking progress
                echo "<div class='tracking-progress'>";
                echo "<h3>Shipment Progress</h3>";
                echo "<div class='progress-timeline'>";
                
                // Contoh progress tracking (sesuaikan dengan kebutuhan)
                $progress_steps = [
                    ['title' => 'Order Placed', 'icon' => 'fas fa-shopping-cart', 'completed' => true],
                    ['title' => 'Processing', 'icon' => 'fas fa-box', 'completed' => $status != 'Pending'],
                    ['title' => 'In Transit', 'icon' => 'fas fa-truck', 'completed' => $status == 'Transit' || $status == 'Delivered'],
                    ['title' => 'Delivered', 'icon' => 'fas fa-check-circle', 'completed' => $status == 'Delivered']
                ];

                foreach ($progress_steps as $step) {
                    echo "<div class='progress-step " . ($step['completed'] ? 'completed' : '') . "'>";
                    echo "<i class='{$step['icon']}'></i>";
                    echo "<span>{$step['title']}</span>";
                    echo "</div>";
                }

                echo "</div>";
                echo "</div>";
            }
            ?>
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
    <script>
        // Optional: Tambahkan interaktivitas atau animasi
        document.addEventListener('DOMContentLoaded', function() {
            const progressSteps = document.querySelectorAll('.progress-step');
            progressSteps.forEach((step, index) => {
                step.style.opacity = '0';
                setTimeout(() => {
                    step.style.transition = 'opacity 0.5s ease';
                    step.style.opacity = '1';
                }, index * 200);
            });
        });
    </script>
</body>
</html>