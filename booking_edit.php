<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_booking = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Pengecekan apakah package telah diset
    if (isset($_POST['package']) && !empty($_POST['package'])) {
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

        // Update data pemesanan di tabel bookings
        $sql_update = "UPDATE bookings SET name='$name', email='$email', phone='$phone', package_id='$package_id' WHERE id_booking='$id_booking'";
    } else {
        // Jika paket tidak diset, ambil package_id yang lama dari session
        $package_id = $_SESSION['form_data']['package_id'];
        
        // Update data pemesanan di tabel bookings tanpa mengganti package_id
        $sql_update = "UPDATE bookings SET name='$name', email='$email', phone='$phone' WHERE id_booking='$id_booking'";
    }

    if ($conn->query($sql_update) === TRUE) {
        // Perbarui data di session
        $_SESSION['form_data'] = array(
            'id' => $id_booking,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'package_id' => $package_id,
            'price' => isset($price) ? $price : $_SESSION['form_data']['price'] // Harga tetap sama jika paket tidak diganti
        );

        // Redirect ke halaman konfirmasi
        header("Location: confirmation.php");
        exit();
    } else {
        echo "Error: " . $sql_update . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
