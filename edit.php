<?php
include "function/function.php";

$id = $_GET["id"];
$data_barang = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang='$id'");
$barang = mysqli_fetch_array($data_barang);

if (isset($_POST["edit_barang"])) {
  if (editBarang($_POST)) {
    echo "<script>
      alert('berhasil mengedit data!');
      document.location.href = 'index.php';
    </script>";
  } else {
    echo "<script>alert('gagal mengedit data!')</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Latihan PHP | Edit File</title>
</head>

<body>
  <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="foto_lama" value="<?= $barang['foto'] ?>">
    <input type="hidden" name="id_barang" value="<?= $id ?>">

    <label>Nama Barang : </label>
    <input type="text" name="nama_barang" placeholder="Masukkan nama barang..." value="<?= $barang['nama_barang'] ?>" required>
    <br>

    <label>Stok : </label>
    <input type="number" name="stok" placeholder="Masukkan stok..." value="<?= $barang['stok'] ?>" required>
    <br>

    <label>Kategori : </label>
    <select name="kategori" required>
      <option value="elektronik" <?= $barang['kategori'] == 'elektronik' ? 'selected' : '' ?>>Elektronik</option>
      <option value="atk" <?= $barang['kategori'] == 'atk' ? 'selected' : '' ?>>ATK</option>
      <option value="perabotan" <?= $barang['kategori'] == 'perabotan' ? 'selected' : '' ?>>Perabotan</option>
    </select>
    <br>

    <label>Foto : </label>
    <input type="file" name="foto" value="<?= $barang['foto'] ?>"><br>
    <img src="img/foto_barang/<?= $barang['foto'] ?>" alt="Foto Barang" width="200px">
    <br>
    <br>
    <button type="submit" name="edit_barang">Edit</button>
  </form>
</body>

</html>