<?php
include 'config.php';

$action = isset($_POST['action']) ? $_POST['action'] : '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tracking_number = $_POST['tracking_number'];

    if ($action == 'search') {
        $sql = "SELECT * FROM shipments WHERE tracking_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $tracking_number);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $shipment = $result->fetch_assoc();
        } else {
            $error = "Nomor resi tidak ditemukan.";
        }
    } elseif ($action == 'add') {
        $status = $_POST['status'];
        $shipment_date = $_POST['shipment_date'];
        $sender = $_POST['sender'];
        $receiver = $_POST['receiver'];

        $sql = "INSERT INTO shipments (tracking_number, status, shipment_date, sender, receiver) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $tracking_number, $status, $shipment_date, $sender, $receiver);

        if ($stmt->execute()) {
            $message = "Data berhasil ditambahkan.";
        } else {
            $error = "Gagal menambahkan data.";
        }
    } elseif ($action == 'update') {
        $status = $_POST['status'];
        $shipment_date = $_POST['shipment_date'];
        $sender = $_POST['sender'];
        $receiver = $_POST['receiver'];

        $sql = "UPDATE shipments SET status = ?, shipment_date = ?, sender = ?, receiver = ? WHERE tracking_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $status, $shipment_date, $sender, $receiver, $tracking_number);

        if ($stmt->execute()) {
            $message = "Data berhasil diperbarui.";
        } else {
            $error = "Gagal memperbarui data.";
        }
    } elseif ($action == 'delete') {
        $sql = "DELETE FROM shipments WHERE tracking_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $tracking_number);

        if ($stmt->execute()) {
            $message = "Data berhasil dihapus.";
        } else {
            $error = "Gagal menghapus data.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlyPack - Cek Resi</title>
    <link rel="stylesheet" href="css/style.css"/>
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

    <div id="introduce">
        <h1>Tracking Result</h1>
        <?php if (isset($shipment)) { ?>
            <div class="shipment-details">
                <p><strong>Tracking Number:</strong> <?php echo $shipment['tracking_number']; ?></p>
                <p><strong>Status:</strong> <?php echo $shipment['status']; ?></p>
                <p><strong>Shipping Date:</strong> <?php echo $shipment['shipment_date']; ?></p>
                <p><strong>Sender:</strong> <?php echo $shipment['sender']; ?></p>
                <p><strong>Recipient:</strong> <?php echo $shipment['receiver']; ?></p>
            </div>
        <?php } elseif (isset($error)) { ?>
            <p><?php echo $error; ?></p>
        <?php } elseif (isset($message)) { ?>
            <p><?php echo $message; ?></p>
        <?php } ?>
    </div>

    <div id="form">
        <h2>Add/Edit/Delete Tracking Data</h2>
        <form method="post" action="">
            <input type="hidden" name="action" value="search">
            <label for="tracking_number">Tracking Number:</label>
            <input type="text" id="tracking_number" name="tracking_number" required>
            <button type="submit">Search</button>
        </form>

        <form method="post" action="">
            <input type="hidden" name="action" value="add">
            <label for="tracking_number">Tracking Number:</label>
            <input type="text" id="tracking_number" name="tracking_number" required>
            <label for="status">Status:</label>
            <input type="text" id="status" name="status" required>
            <label for="shipment_date">Shipment Date:</label>
            <input type="date" id="shipment_date" name="shipment_date" required>
            <label for="sender">Sender:</label>
            <input type="text" id="sender" name="sender" required>
            <label for="receiver">Recipient:</label>
            <input type="text" id="receiver" name="receiver" required>
            <button type="submit">Add</button>
        </form>

        <form method="post" action="">
            <input type="hidden" name="action" value="update">
            <label for="tracking_number">Tracking Number:</label>
            <input type="text" id="tracking_number" name="tracking_number" required>
            <label for="status">Status:</label>
            <input type="text" id="status" name="status" required>
            <label for="shipment_date">Shipment Date:</label>
            <input type="date" id="shipment_date" name="shipment_date" required>
            <label for="sender">Sender:</label>
            <input type="text" id="sender" name="sender" required>
            <label for="receiver">Recipient:</label>
            <input type="text" id="receiver" name="receiver" required>
            <button type="submit">Update</button>
        </form>

        <form method="post" action="">
            <input type="hidden" name="action" value="delete">
            <label for="tracking_number">Tracking Number:</label>
            <input type="text" id="tracking_number" name="tracking_number" required>
            <button type="submit">Delete</button>
        </form>
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
<script src="js/script.js"></script>
</body>
</html>
