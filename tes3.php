<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk</title>
    <style>
        .form-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <h2>Tambah Produk Baru</h2>
    <form action="simpan_produk.php" method="POST">
        <div class="form-container">
            <div class="form-group">
                <label for="nama">Nama Produk:</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <input type="text" id="deskripsi" name="deskripsi" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" id="harga" name="harga" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok:</label>
                <input type="number" id="stok" name="stok" required>
            </div>
        </div>
        <br>
        <input type="submit" value="Simpan">
    </form>
</body>
</html>


        <?php
        // Konfigurasi koneksi database
        $conn = new mysqli("localhost", "root", "", "produk_db");

        // Memeriksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Mengambil data produk
        $result = $conn->query("SELECT * FROM produk");

        // Menampilkan data produk
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['nama']}</td>
                <td>{$row['deskripsi']}</td>
                <td>{$row['harga']}</td>
                <td>{$row['stok']}</td>
                <td>
                    <a href='edit_produk.php?id={$row['id']}'>Edit</a> |
                    <a href='hapus_produk.php?id={$row['id']}' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                </td>
            </tr>";
        }

        // Menutup koneksi
        $conn->close();
        ?>
    </table>
</body>
</html>
<?php
// Konfigurasi koneksi database
$conn = new mysqli("localhost", "root", "", "produk_db");

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data dari form
$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

// Menyimpan data ke database
$sql = "INSERT INTO produk (nama, deskripsi, harga, stok) VALUES ('$nama', '$deskripsi', '$harga', '$stok')";
$conn->query($sql);

// Menutup koneksi dan kembali ke form
$conn->close();
header("Location: input_produk.php");
exit;
?>
<?php
// Konfigurasi koneksi database
$conn = new mysqli("localhost", "root", "", "produk_db");

// Mengambil data produk yang akan diedit
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM produk WHERE id = $id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
</head>
<body>
    <h2>Edit Produk</h2>
    <form action="update_produk.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        
        <label for="nama">Nama Produk:</label><br>
        <input type="text" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required><br><br>

        <label for="deskripsi">Deskripsi:</label><br>
        <textarea id="deskripsi" name="deskripsi" rows="4" cols="50"><?php echo $row['deskripsi']; ?></textarea><br><br>

        <label for="harga">Harga:</label><br>
        <input type="number" id="harga" name="harga" step="0.01" value="<?php echo $row['harga']; ?>" required><br><br>

        <label for="stok">Stok:</label><br>
        <input type="number" id="stok" name="stok" value="<?php echo $row['stok']; ?>" required><br><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
<?php
// Konfigurasi koneksi database
$conn = new mysqli("localhost", "root", "", "produk_db");

// Mengambil data dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

// Mengupdate data di database
$sql = "UPDATE produk SET nama = '$nama', deskripsi = '$deskripsi', harga = '$harga', stok = '$stok' WHERE id = $id";
$conn->query($sql);

// Menutup koneksi dan kembali ke form utama
$conn->close();
header("Location: input_produk.php");
exit;
?>
<?php
// Konfigurasi koneksi database
$conn = new mysqli("localhost", "root", "", "produk_db");

// Menghapus data dari database
$id = $_GET['id'];
$sql = "DELETE FROM produk WHERE id = $id";
$conn->query($sql);

// Menutup koneksi dan kembali ke form utama
$conn->close();
header("Location: input_produk.php");
exit;
?>
