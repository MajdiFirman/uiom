<?php
session_start();
include "koneksi.php";

// Cek jika pengguna belum login
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'prodi') {
    header('Location: login.php');
    exit();
}

// Mendapatkan ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Mengambil data dari database
$query = "SELECT * FROM judul WHERE id_judul = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

// Proses update data
if (isset($_POST['submit'])) {
    $topik1 = $_POST['topik1'];
    $topik2 = $_POST['topik2'];
    $topik3 = $_POST['topik3'];

    $update_query = "UPDATE judul SET topik1 = ?, topik2 = ?, topik3 = ? WHERE id_judul = ?";
    $update_stmt = $koneksi->prepare($update_query);
    $update_stmt->bind_param("sssi", $topik1, $topik2, $topik3, $id);

    if ($update_stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui'); window.location.href='petugas.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/update.css">
    <title>Update Data</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <h2>Update Pengajuan Topik</h2>
            <div class="input-group">
                <label for="topik1">Topik 1</label>
                <input type="text" id="topik1" name="topik1" value="<?php echo htmlspecialchars($data['topik1']); ?>" required>
            </div>
            <div class="input-group">
                <label for="topik2">Topik 2</label>
                <input type="text" id="topik2" name="topik2" value="<?php echo htmlspecialchars($data['topik2']); ?>" required>
            </div>
            <div class="input-group">
                <label for="topik3">Topik 3</label>
                <input type="text" id="topik3" name="topik3" value="<?php echo htmlspecialchars($data['topik3']); ?>" required>
            </div>
            <div class="input-group">
                <button type="submit" name="submit" class="btn">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
