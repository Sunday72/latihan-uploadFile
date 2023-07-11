<?php

include "function/function.php";

if (isset($_POST['tambah_barang'])) {
  if(tambahBarang($_POST)){
    echo "<script>alert('Berhasil tambah barang!')</script>";
  } else {
    echo "<script>alert('Gagal tambah barang!')</script>";
  }
}

$data_barang = mysqli_query($conn, "SELECT * FROM barang");
$no = 1;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Latihan PHP | Upload File</title>
</head>

<body>
  <h3>Latihan PHP | Upload File</h3>

  <form action="" method="post" enctype="multipart/form-data">
    <label>Nama Barang : </label>
    <input type="text" name="nama_barang" placeholder="Masukkan nama barang..." required>
    <br>

    <label>Stok : </label>
    <input type="number" name="stok" placeholder="Masukkan stok..." required>
    <br>

    <label>Kategori : </label>
    <select name="kategori" required>
      <option value="elektronik">Elektronik</option>
      <option value="atk">ATK</option>
      <option value="perabotan">Perabotan</option>
    </select>
    <br>

    <label>Foto : </label>
    <input type="file" name="foto">
    <br>
    <br>
    <button type="submit" name="tambah_barang">Submit</button>
  </form>

  <hr>
  <!-- TABEL SHOW DATA -->
  <table border="1">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Stok</th>
        <th>Kategori</th>
        <th>Foto</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data_barang as $barang) : ?>
        <tr>
          <td><?= $no; ?></td>
          <td><?= $barang["nama_barang"] ?></td>
          <td><?= $barang["stok"] ?></td>
          <td><?= $barang["kategori"] ?></td>
          <td>
            <img src="img/foto_barang/<?= $barang["foto"] ?>" alt="Foto Barang" width="100px">
          </td>
          <td>
            <button disabled>Edit</button>
            <button disabled>Hapus</button>
          </td>
        </tr>
      <?php $no++;
      endforeach; ?>
    </tbody>
  </table>
</body>

</html>