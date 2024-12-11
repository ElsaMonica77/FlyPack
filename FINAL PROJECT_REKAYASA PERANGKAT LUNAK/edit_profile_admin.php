<?php
session_start();
include 'config.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

// Ambil data pengguna dari sesi
$user = isset($_SESSION['user']) ? $_SESSION['user'] : ['name' => '', 'email' => '', 'phone' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['update_profile'])){ // Jika form edit profil disubmit
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $user_id = $_SESSION['user_id'];

        // Persiapkan SQL untuk mengupdate nama dan nomor telepon
        $sql = "UPDATE users SET name = ?, phone = ? WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssi", $name, $phone, $user_id);

            if ($stmt->execute()) {
                // Update data di sesi
                $_SESSION['user']['name'] = $name;
                $_SESSION['user']['phone'] = $phone;
                header('Location: my_account_admin.php');
                exit;
            } else {
                echo "Error updating record: " . $conn->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    }

    if(isset($_POST['change_password'])){ // Jika form penggantian password disubmit
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        $user_id = $_SESSION['user_id'];

        // Periksa kata sandi saat ini
        $sql_check_password = "SELECT password FROM users WHERE id = ?";
        $stmt_check_password = $conn->prepare($sql_check_password);
        $stmt_check_password->bind_param("i", $user_id);
        $stmt_check_password->execute();
        $result_check_password = $stmt_check_password->get_result();

        if ($result_check_password->num_rows == 1) {
            $row = $result_check_password->fetch_assoc();
            if ($current_password === $row['password']) { 
                if ($new_password === $confirm_password) {
                    $sql_update_password = "UPDATE users SET password = ? WHERE id = ?";
                    $stmt_update_password = $conn->prepare($sql_update_password);
                    $stmt_update_password->bind_param("si", $new_password, $user_id);
        
                    if ($stmt_update_password->execute()) {
                        $success_message = "Kata sandi berhasil diubah.";
                    } else {
                        $error_message = "Error updating record: " . $conn->error;
                    }
                } else {
                    $error_message = "Kata sandi baru tidak cocok.";
                }
            } else {
                $error_message = "Kata sandi saat ini salah.";
            }
        } else {
            $error_message = "User tidak ditemukan di database.";
        }        

        // Tutup pernyataan
        $stmt_check_password->close();
        if (isset($stmt_update_password)) {
            $stmt_update_password->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile and Change Password</title>
    <link rel="stylesheet" href="css/style.css">
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
    
    <div class="my-account">
        <h2>Edit Profile</h2>
        <?php
        if (isset($success_message)) {
            echo "<p class='success-message'>$success_message</p>";
        }
        if (isset($error_message)) {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>
        <form method="post">
            <div class="account-section">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            <div class="account-section">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
            </div>
            <div class="account-section">
                <button type="submit" class="btn" name="update_profile">Save Changes</button>
            </div>
        </form>

        <h2>Change Password</h2>
        <form method="post">
        <div class="account-section">
            <label for="current_password">Current Password:</label>
            <input type="password" id="current_password" name="current_password" required>
        </div>
        <div class="account-section">
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>
        <div class="account-section">
            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <div class="account-section">
            <button type="submit" class="btn" name="change_password">Change Password</button>
        </div>
    </form>
    </div>
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