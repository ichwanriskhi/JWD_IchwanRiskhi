<?php
session_start();

if (!isset($_SESSION['form_data'])) {
    header("Location: index.html");
    exit();
}

$form_data = $_SESSION['form_data'];

// Ambil data paket wisata
include 'db_connect.php';

$package_id = $form_data['package_id'];
$sql_package = "SELECT package_name, price FROM tour_packages WHERE id_package = $package_id";
$result_package = $conn->query($sql_package);

if ($result_package->num_rows > 0) {
    $package_data = $result_package->fetch_assoc();
    $package_name = $package_data['package_name'];
    $price = $package_data['price'];
} else {
    $package_name = "Tidak ditemukan"; // Atau tangani kesalahan jika paket tidak ditemukan
    $price = 0;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelOne</title>
    <link rel="stylesheet" href="css/style2.css">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
     <header>
        <a href="#" class="logo">TravelOne</a>
        <div class="bx bx-menu" id="menu-icon"></div>

        <ul class="navbar">
            <li><a href="index.html#home">Home</a></li>
            <li><a href="index.html#package">Package</a></li>
            <li><a href="index.html#destination">Gallery</a></li>
            <li><a href="index.html#contact">Contact</a></li>
            <li><a href="index.html#booking">Booking</a></li>
        </ul>
     </header>
     
    <section class="container">
        <br><br><br>
        <h2>Pesanan Anda</h2> <br>
        <div class="booking-form">
            <p><strong>Nama:</strong> <?php echo htmlspecialchars($form_data['name']); ?></p>
            <p><strong>Alamat Email:</strong> <?php echo htmlspecialchars($form_data['email']); ?></p>
            <p><strong>Nomor HP:</strong> <?php echo htmlspecialchars($form_data['phone']); ?></p>
            <p><strong>Paket:</strong> <?php echo htmlspecialchars($package_name); ?></p>
            <p><strong>Harga:</strong> Rp. <?php echo htmlspecialchars($price); ?></p>
        </div>
    </section>

    <section id="contact">
            <div class="footer">
                <div class="main">
                    <div class="list">
                        <h4>TravelOne</h4>
                        <ul>
                            <li><a href="index.html#home">Home</a></li>
                            <li><a href="index.html#package">Package</a></li>
                            <li><a href="index.html#gallery">Gallery</a></li>
                            <li><a href="index.html#contact">Contact</a></li>
                            <li><a href="index.html#booking">Booking</a></li>
                        </ul>
                    </div>

                    <div class="list">
                        <h4>Support</h4>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Help</a></li>
                            <li><a href="#">Tour</a></li>
                        </ul>
                    </div>

                    <div class="list">
                        <h4>Contact Info</h4>
                        <ul>
                            <li><a href="#">Dayeuhkolot</a></li>
                            <li><a href="#">Bandung</a></li>
                            <li><a href="#">085823649560</a></li>
                            <li><a href="#">ichwanriskhi875@gmail.com</a></li>
                        </ul>
                    </div>

                    <div class="list">
                        <h4>Connect</h4>
                        <div class="social">
                            <a href="#"><i class="bx bxl-facebook" ></i></a>
                            <a href="#"><i class="bx bxl-instagram-alt" ></i></a>
                            <a href="#"><i class="bx bxl-twitter" ></i></a>
                            <a href="#"><i class="bx bxl-linkedin" ></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="end-text">
                <p>Copyright @2024 All rights reserved</p>
            </div>
         </section>
    <!-- link to js -->
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>