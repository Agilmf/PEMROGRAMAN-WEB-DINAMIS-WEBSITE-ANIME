<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

// Fitur Pencarian
$search_query = "";
if (isset($_POST['search'])) {
    $search_query = $_POST['search_query'];
    $query = "SELECT * FROM anime WHERE judul_anime LIKE '%$search_query%' OR genre LIKE '%$search_query%'";
} else {
    $query = "SELECT * FROM anime";
}

$result = $conn->query($query);

// Tambah Anime
if (isset($_POST['submit'])) {
    $judul = $_POST['judul_anime'];
    $genre = $_POST['genre'];
    $rating = $_POST['rating'];
    $tahun = $_POST['tahun_rilis'];

    $sql = "INSERT INTO anime (judul_anime, genre, rating, tahun_rilis) VALUES ('$judul', '$genre', '$rating', '$tahun')";
    if ($conn->query($sql) === TRUE) {
        header("Location: anime.php");
    }
}

// Edit Anime
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $query = "SELECT * FROM anime WHERE id = $id";
    $result = $conn->query($query);
    $anime = $result->fetch_assoc();
}

// Update Anime
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul_anime'];
    $genre = $_POST['genre'];
    $rating = $_POST['rating'];
    $tahun = $_POST['tahun_rilis'];

    $sql = "UPDATE anime SET judul_anime='$judul', genre='$genre', rating='$rating', tahun_rilis='$tahun' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: anime.php");
    }
}

// Hapus Anime
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM anime WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: anime.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anime</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Daftar Anime</h1>
        <a href="logout.php" class="logout-btn">Logout</a>
        <a href="print_anime.php" class="print-btn" target="_blank">Cetak</a> <!-- Tombol Cetak -->
    </header>

    <div class="container">
        <!-- Form Pencarian -->
        <div class="search-section">
            <form action="anime.php" method="POST">
                <input type="text" name="search_query" value="<?= $search_query ?>" placeholder="Cari Anime..." required>
                <button type="submit" name="search">Cari</button>
            </form>
        </div>

        <!-- Form untuk menambah atau mengedit anime -->
        <div class="form-section">
            <?php if (isset($_GET['edit'])): ?>
                <!-- Form Edit Anime -->
                <form action="anime.php" method="POST">
                    <input type="hidden" name="id" value="<?= $anime['id'] ?>">
                    <input type="text" name="judul_anime" value="<?= $anime['judul_anime'] ?>" required>
                    <input type="text" name="genre" value="<?= $anime['genre'] ?>" required>
                    <input type="number" name="rating" value="<?= $anime['rating'] ?>" min="1" max="10" required>
                    <input type="text" name="tahun_rilis" value="<?= $anime['tahun_rilis'] ?>" required>
                    <button type="submit" name="update">Update Anime</button>
                </form>
            <?php else: ?>
                <!-- Form Tambah Anime -->
                <form action="anime.php" method="POST">
                    <h2>Tambah Anime</h2>
                    <input type="text" name="judul_anime" placeholder="Judul Anime" required>
                    <input type="text" name="genre" placeholder="Genre" required>
                    <input type="number" name="rating" placeholder="Rating" min="1" max="10" required>
                    <input type="text" name="tahun_rilis" placeholder="Tahun Rilis" required>
                    <button type="submit" name="submit">Tambah Anime</button>
                </form>
            <?php endif; ?>
        </div>

        <!-- Daftar Anime -->
        <div class="table-section">
            <h2>Daftar Anime</h2>
            <table>
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Genre</th>
                        <th>Rating</th>
                        <th>Tahun Rilis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['judul_anime'] ?></td>
                        <td><?= $row['genre'] ?></td>
                        <td><?= $row['rating'] ?></td>
                        <td><?= $row['tahun_rilis'] ?></td>
                        <td>
                            <a href="anime.php?edit=<?= $row['id'] ?>" class="btn edit-btn">Edit</a>
                            <a href="anime.php?delete=<?= $row['id'] ?>" class="btn delete-btn">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
