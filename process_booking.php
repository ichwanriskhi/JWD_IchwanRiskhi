<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $package_id = $_POST['package'];

    // Ambil data paket wisata dari tabel tour_packages
    $sql_package = "SELECT price FROM tour_packages WHERE id_package = $package_id";
    $result_package = $conn->query($sql_package);

    if ($result_package->num_rows > 0) {
        $package_data = $result_package->fetch_assoc();
        $price = $package_data['price'];
    } else {
        $price = 0; // Atau tangani kesalahan jika paket tidak ditemukan
    }

    // Simpan data pemesanan ke tabel bookings tanpa menyimpan harga
    $sql_booking = "INSERT INTO bookings (name, email, phone, package_id) VALUES ('$name', '$email', '$phone', '$package_id')";

    if ($conn->query($sql_booking) === TRUE) {
        // Simpan data ke session
        $_SESSION['form_data'] = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'package_id' => $package_id,
            'price' => $price
        );

        // Redirect ke halaman konfirmasi
        header("Location: confirmation.php");
        exit();
    } else {
        echo "Error: " . $sql_booking . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
