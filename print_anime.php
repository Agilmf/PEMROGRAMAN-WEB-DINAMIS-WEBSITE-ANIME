<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

// Ambil data semua anime
$query = "SELECT * FROM anime";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Daftar Anime</title>
    <style>
       /* Umum */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f4f4f9; /* Latar belakang lebih terang */
    color: #333;
}

h1 {
    text-align: center;
    color: #333;
    font-size: 28px;
    margin-bottom: 20px;
    font-weight: bold;
    text-transform: uppercase; /* Agar lebih menonjol */
}

/* Tabel */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    background-color: #ffffff;
    border-radius: 8px; /* Sudut tabel lebih halus */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Bayangan tabel untuk efek kedalaman */
}

th, td {
    border: 1px solid #ddd;
    padding: 12px 15px;
    text-align: center;
    font-size: 14px;
    transition: background-color 0.3s ease; /* Efek transisi untuk hover */
}

th {
    background-color: #e63434; /* Warna merah lebih cerah */
    color: #fff;
    font-weight: bold;
}

td {
    background-color: #f9f9f9; /* Latar belakang sel yang lebih terang */
}

/* Efek Hover untuk Baris Tabel */
tr:hover td {
    background-color: #ffebeb; /* Efek saat hover pada baris tabel */
}

/* Tombol Cetak */
.no-print {
    text-align: center;
    margin-top: 20px;
}

.no-print button {
    padding: 12px 25px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
    margin-right: 10px;
}

.no-print button:hover {
    background-color: #0056b3;
    transform: scale(1.05); /* Efek animasi sedikit lebih besar saat hover */
}

.no-print a {
    text-decoration: none;
    color: #007bff;
    font-size: 16px;
    padding: 10px 20px;
    background-color: #fff;
    border-radius: 5px;
    border: 1px solid #007bff;
    transition: background-color 0.3s ease;
}

.no-print a:hover {
    background-color: #007bff;
    color: white;
}

/* Media Query untuk Cetakan */
@media print {
    body {
        background-color: white;
        color: #000;
        padding: 0;
    }

    h1 {
        font-size: 28px;
        margin-top: 0;
    }

    table {
        width: 100%;
        border: none;
        margin: 0;
        box-shadow: none; /* Menghapus bayangan pada tabel saat dicetak */
    }

    .no-print {
        display: none; /* Menyembunyikan tombol cetak dan tautan kembali saat mencetak */
    }
}

    </style>
</head>
<body>
    <h1>Daftar Anime</h1>
    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Genre</th>
                <th>Rating</th>
                <th>Tahun Rilis</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['judul_anime'] ?></td>
                <td><?= $row['genre'] ?></td>
                <td><?= $row['rating'] ?></td>
                <td><?= $row['tahun_rilis'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()">Cetak Halaman</button>
        <a href="anime.php">Kembali</a>
    </div>
</body>
</html>
