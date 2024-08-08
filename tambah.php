<?php
session_start();
if(!isset($_SESSION['login'])){
     header('location: login.php');
     exit;
}


require 'functions.php';
if (isset($_POST['submit'])) {

     if (tambah($_POST) > 0) {
          echo "
          <script>
               alert('Data berhasil ditambahkan');
               document.location.href = 'index.php';
          </script>";
     } else {
          echo "<script>alert('Data gagal ditambahkan');</script>";
     }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Tambah Data</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
     <div class="container mt-3">
          <div class="card">
               <div class="card-header text-center">
                    <h1>Tambah Data</h1>
               </div>
               <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                         <div>
                              <label for="nrp">NRP :</label>
                              <input type="text" class="form-control" name="nrp" id="nrp" required>
                         </div>
                         <div>
                              <label for="nama">Nama :</label>
                              <input type="text" class="form-control" name="nama" id="nama" required>
                         </div>
                         <div>
                              <label for="email">Email :</label>
                              <input type="email" class="form-control" name="email" id="email" required>
                         </div>
                         <div>
                              <label for="jurusan">Jurusan :</label>
                              <input type="jurusan" class="form-control" name="jurusan" id="jurusan" required>
                         </div>
                         <div>
                              <label for="gambar">Gambar :</label>
                              <input type="file" class="form-control" name="gambar" id="gambar">
                         </div>
                         <div class="mt-3 text-end">
                              <button type="submit" class="btn btn-primary" name="submit">Tambah Data</button>
                         </div>
                    </form>
               </div>
          </div>
     </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>