<?php
include 'db.php';

if (isset($_GET['search'])) {
    $keyword = $_GET['keyword'];
    $query = "SELECT * FROM anime WHERE judul_anime LIKE '%$keyword%' OR genre LIKE '%$keyword%'";
    $result = $conn->query($query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Anime</title>
</head>
<body>
    <h1>Hasil Pencarian</h1>
    <table border="1">
        <tr>
            <th>Judul</th>
            <th>Genre</th>
            <th>Rating</th>
            <th>Tahun Rilis</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['judul_anime'] ?></td>
            <td><?= $row['genre'] ?></td>
            <td><?= $row['rating'] ?></td>
            <td><?= $row['tahun_rilis'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
