<?php
session_start();
error_reporting(0); // Menyembunyikan semua pesan error

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
     
    <!--<section class="container">
        <br><br><br>
        <h2>Konfirmasi Pemesanan</h2> <br>
        <div class="booking-form">
            <p><strong>Nama:</strong> <?php echo htmlspecialchars($form_data['name']); ?></p>
            <p><strong>Alamat Email:</strong> <?php echo htmlspecialchars($form_data['email']); ?></p>
            <p><strong>Nomor HP:</strong> <?php echo htmlspecialchars($form_data['phone']); ?></p>
            <p><strong>Paket:</strong> <?php echo htmlspecialchars($package_name); ?></p>
            <p><strong>Harga:</strong> Rp. <?php echo htmlspecialchars($price); ?></p>
        </div>
        <a href="index.html" class="home-btn">Edit</a>
        <a href="index.html" class="home-btn">Konfirmasi Pesanan</a>
    </section>-->

    <br><br>
    <section class="booking" id="booking">
        <h2>Konfirmasi Data Diri Anda</h2>
        <p>Setelah data dirasa benar, klik tombol konfirmasi. <br> Dan jika terdapat data yang kurang tepat, perbaiki data lalu klik edit.</p>
        <br>
        <form class="booking-form" action="booking_edit.php" method="post">
            <input type="hidden" name="id_booking" value="<?php echo htmlspecialchars($form_data['id_booking']); ?>"> 
            
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($form_data['name']); ?>" required>
            
            <label for="email">Alamat Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($form_data['email']); ?>" required>
            
            <label for="phone">Nomor HP:</label>
            <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($form_data['phone']); ?>" required>
            
            <label for="package">Pilihan Paket Saat Ini:</label>
            <input type="text" value="<?php echo htmlspecialchars($package_name); ?>" readonly>

            <label for="package">Ganti Paket:</label>
            <select id="package" name="package" onchange="setPrice()">
                <option value="" disabled selected>Pilih Paket</option>
                <option value="1">Paket 1 (Borobudur)</option>
                <option value="2">Paket 2 (Raja Ampat)</option>
                <option value="3">Paket 3 (Nusa Penida)</option>
            </select>

            <label for="price">Harga:</label>
            <input type="text" id="price" name="price" value="Rp. <?php echo htmlspecialchars($price); ?>" readonly>
            
            <button type="submit">Edit</button>
            <button type="button" onclick="location.href='final.php'">Konfirmasi</button>
        </form>
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
