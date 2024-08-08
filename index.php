<?php
session_start();
if (!isset($_SESSION['login'])) {
     header('location: login.php');
     exit;
}

require 'functions.php';

// Pagination
// configurasi
$jumlahDataPerHalaman = 3;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerHalaman");

// Ambil data mahasiswa sesuai halaman

// Jika tombol cari ditekan
if (isset($_POST['cari'])) {
     $mahasiswa = cari($_POST['keyword']);
}
if (isset($_POST['clear'])) {
     $mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Halaman Admin</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

</head>

<body>
     <div class="container col-lg-12">
          <div class="card">
               <div class="card-header text-center">
                    <a href="logout.php">Logout</a>
                    <h1>Data Mahasiswa</h1>
                    <a href="tambah.php">Tambah Data</a>
               </div>
               <div class="card-body col-lg-12">

                    <!-- Cari Data -->
                    <form action="" class="mb-3" method="POST">
                         <input type="text" name="keyword" size="30" autofocus placeholder="Masukkan kata pencarian" autocomplete="off">
                         <button class="btn btn-primary" type="submit" name="cari">Cari</button>
                         <button class="btn btn-danger" type="submit" name="clear">Clear</button>
                    </form>

                    <!-- Pagination -->
                    <!-- Jika halaman > 1 -->
                    <?php if ($halamanAktif > 1) : ?>
                         <a href="?halaman=<?= $halamanAktif - 1; ?>">&laquo</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                         <?php if ($i == $halamanAktif) : ?>
                              <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: red"><?= $i; ?></a>
                         <?php else : ?>
                              <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                         <?php endif; ?>
                    <?php endfor; ?>

                    <!-- Jika halaman < jumlah halaman -->
                    <?php if ($halamanAktif < $jumlahHalaman) : ?>
                         <a href="?halaman=<?= $halamanAktif + 1; ?>">&raquo</a>
                    <?php endif; ?>


                    <!-- Tabel -->
                    <table class="table table-bordered table-striped">
                         <tr class="text-center">
                              <th>No.</th>
                              <th>Aksi</th>
                              <th>Gambar</th>
                              <th>NRP</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>Jurusan</th>
                         </tr>
                         <?php $i = 1; ?>
                         <?php foreach ($mahasiswa as $row) : ?>
                              <tr>
                                   <td><?= $i ?></td>
                                   <td>
                                        <a href="ubah.php?id=<?php echo $row['id']; ?>">Ubah</a> |
                                        <a href="hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin?');">Hapus</a>
                                   </td>
                                   <td><img src="images/<?php echo $row['gambar']; ?>" width="50"></td>
                                   <td><?php echo $row['nrp']; ?></td>
                                   <td><?php echo $row['nama']; ?></td>
                                   <td><?php echo $row['email']; ?></td>
                                   <td><?php echo $row['jurusan']; ?></td>
                              </tr>
                              <?php $i++; ?>
                         <?php endforeach ?>
                    </table>


               </div>
          </div>
     </div>
     <br><br>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>