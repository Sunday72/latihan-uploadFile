<?php

$conn = mysqli_connect('localhost', 'root', '', 'latihan_phpUpload');

function tambahBarang($data)
{
  global $conn;

  $namaBarang = $data["nama_barang"];
  $stok = $data["stok"];
  $kategori = $data["kategori"];
  $foto = upload();

  if (!$foto) {
    return false;
  }

  mysqli_query($conn, "INSERT INTO barang VALUES('', '$namaBarang', '$stok', '$kategori', '$foto')");

  return mysqli_affected_rows($conn);
}

function upload()
{
  $filename = $_FILES["foto"]["name"];
  $size = $_FILES["foto"]["size"];
  $error = $_FILES["foto"]["error"];
  $temp = $_FILES["foto"]["tmp_name"];

  $validExtension = ['png', 'jpg', 'jpeg'];
  $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);

  if ($error == 4) {
    echo "<script>alert('Wajib upload foto!')</script>";
    return false;
  } elseif (!in_array($fileExtension, $validExtension)) {
    echo "<script>alert('file hanya boleh berupa png, jpg, dan jpeg!')</script>";
    return false;
  } elseif ($size > 1000000) {
    echo "<script>alert('Max ukuran file adalah 1 MB!')</script>";
    return false;
  }

  // MOVE UPLOADED FILE
  $filename = pathinfo($filename, PATHINFO_FILENAME) . '_' . uniqid() . '.' . $fileExtension;
  move_uploaded_file($temp, 'img/foto_barang/' . $filename);

  return $filename;
}
