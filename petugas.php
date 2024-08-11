<?php
session_start();
include "koneksi.php";

// Pastikan user login sebagai Kaprodi
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'prodi') {
    header("Location: index.php");
    exit();
}

// Query untuk mengambil data pengajuan dari database
$query = "SELECT j.*, m.nama_mahasiswa FROM judul j 
          INNER JOIN mahasiswa m ON j.nim = m.nim";
$result = mysqli_query($koneksi, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Dashboard Pengajuan topik skripsi</title>
</head>
<body>
<div class="wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>List Pengajuan</h2>
            <ul>
                <!-- <li><a href="#form-pengajuan">Form Pengajuan</a></li> -->
                <li><a href="#list-pengajuan">List Pengajuan</a></li>
            </ul>
            <div class="logout">
                <a href="logout.php">Logout</a>
            </div>
        </aside>

        <div class="main-content">

            <div class="list-pengajuan">
                <p>List Pengajuan</p>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIM</th>
                            <th>nama mahasiswa</th>
                            <th>topik 1</th>
                            <th>topik 2</th>
                            <th>topik 3</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['nim']}</td>
                                <td>{$row['nama_mahasiswa']}</td>
                                <td>{$row['topik1']}</td>
                                <td>{$row['topik2']}</td>
                                <td>{$row['topik3']}</td>
                                <td>
                                    <a href='edit.php?id={$row['id_judul']}'>Edit</a> |
                                    <a href='delete.php?id={$row['id_judul']}' onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a>
                                </td>
                              </tr>";
                        $no++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>
</body>
</html>