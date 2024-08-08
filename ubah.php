<?php
session_start();
if(!isset($_SESSION['login'])){
     header('location: login.php');
     exit;
}

require 'functions.php';
$id = $_GET['id'];
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

if (isset($_POST['submit'])) {
     if (ubah($_POST) > 0) {
          echo "
          <script>
               alert('Data berhasil diubah');
               document.location.href = 'index.php';
          </script>";
     } else {
          echo "<script>alert('Data gagal diubah');</script>";
     }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Ubah Data</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
     <div class="container mt-3">
          <div class="card">
               <div class="card-header text-center">
                    <h1>Ubah Data</h1>
               </div>
               <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                         <input type="hidden" name="id" value="<?php echo $mhs['id']; ?>">
                         <input type="hidden" name="gambarLama" value="<?php echo $mhs['gambar']; ?>">


                         <div>
                              <label for="nrp">NRP :</label>
                              <input type="text" class="form-control" name="nrp" id="nrp" value="<?php echo $mhs['nrp']; ?>" required>
                         </div>
                         <div>
                              <label for="nama">Nama :</label>
                              <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $mhs['nama']; ?>" required>
                         </div>
                         <div>
                              <label for="email">Email :</label>
                              <input type="email" class="form-control" name="email" id="email" value="<?php echo $mhs['email']; ?>" required>
                         </div>
                         <div>
                              <label for="jurusan">Jurusan :</label>
                              <input type="jurusan" class="form-control" name="jurusan" id="jurusan" value="<?php echo $mhs['jurusan']; ?>" required>
                         </div>
                         <div>
                              <label for="gambar">Gambar :</label>
                              <img src="images/<?php echo $mhs['gambar'] ?>" alt="" width="50">
                              <input type="file" class="form-control" name="gambar" id="gambar">
                         </div>
                         <div class="mt-3 text-end">
                              <button type="submit" class="btn btn-primary" name="submit">Update</button>
                         </div>
                    </form>
               </div>
          </div>
     </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>