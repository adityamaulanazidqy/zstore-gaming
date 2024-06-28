<?php
include_once 'koneksi.php';


// Menangani data dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Menyiapkan pernyataan SQL
    $sql = "INSERT INTO messages (name, surname, email, subject, message) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $surname, $email, $subject, $message);

    // Menjalankan pernyataan SQL dan memeriksa apakah berhasil
    if ($stmt->execute()) {
        // Notifikasi sukses menggunakan JavaScript
        echo "<script>
                alert('Pesan berhasil dikirim!');
                window.location.href='../contact.html';
              </script>";
    } else {
        // Notifikasi error menggunakan JavaScript
        echo "<script>
                alert('Terjadi kesalahan: " . $conn->error . "');
                window.location.href='../contact.html';
              </script>";
    }

    $stmt->close();
}

$conn->close();
