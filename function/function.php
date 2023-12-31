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

function hapusBarang($data)
{
  global $conn;

  $id = $data["id_barang"];
  $foto = $data["foto"];

  // HAPUS FOTO DARI FOLDER IMG/FOTO_BARANG
  $imgpath = "img/foto_barang/" . $foto;
  unlink($imgpath);

  mysqli_query($conn, "DELETE FROM barang WHERE id_barang='$id'");

  return mysqli_affected_rows($conn);
}

function editBarang($data)
{
  global $conn;

  $id = $data["id_barang"];
  $namaBarang = $data["nama_barang"];
  $stok = $data["stok"];
  $kategori = $data["kategori"];
  $fotoLama = $data["foto_lama"];

  if ($_FILES["foto"]["error"] == 4) {
    $foto = $fotoLama;
  } else {
    $imgpath = "img/foto_barang/" . $fotoLama;
    unlink($imgpath);
    $foto = upload();
  }

  mysqli_query($conn, "UPDATE barang SET nama_barang='$namaBarang', stok='$stok', kategori='$kategori', foto='$foto' WHERE id_barang = '$id'");

  return mysqli_affected_rows($conn);
}
