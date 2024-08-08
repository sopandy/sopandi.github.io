<?php
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query)
{
     global $conn;
     $result = mysqli_query($conn, $query);
     $rows = [];
     while ($row = mysqli_fetch_assoc($result)) {
          $rows[] = $row;
     }
     return $rows;
}
// =======================================================================
function tambah($data)
{
     global $conn;
     $nrp = htmlspecialchars($data['nrp']);
     $nama = htmlspecialchars($data['nama']);
     $email = htmlspecialchars($data['email']);
     $jurusan = htmlspecialchars($data['jurusan']);

     // Upload gambar
     $gambar = upload();
     if (!$gambar) {
          return false;
     }

     $query = "INSERT INTO mahasiswa VALUES 
          ('','$nrp','$nama','$email','$jurusan','$gambar')";
     mysqli_query($conn, $query);
     return mysqli_affected_rows($conn);
}
// ====================================================================
function upload()
{
     $namaFile = $_FILES['gambar']['name'];
     $ukuranFile = $_FILES['gambar']['size'];
     $error = $_FILES['gambar']['error'];
     $tmpName = $_FILES['gambar']['tmp_name'];

     // Cek apakah ada gambar yang diupload
     if ($error === 4) {
          echo "<script>
               alert('Pilih gambar dulu!');
               </script>";
          return false;
     }

     // Apakah yang diupload itu gambar?
     $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
     $ekstensiGambar = explode('.', $namaFile);
     $ekstensiGambar = strtolower(end($ekstensiGambar));
     if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
          echo "<script>
               alert('Yang anda upload bukan gambar!');
               </script>";
          return false;
     }
     // Cek ukuran gambar
     if ($ukuranFile > 1000000) {
          echo "<script>
               alert('Ukuran gambar terlalu besar! Maksimal 1MB');
               </script>";
          return false;
     }
     // Gambar siap diupload
     // Jika nama file sama (tidak diganti)
     // move_uploaded_file($tmpName, 'images/' . $namaFile);
     // return $namaFile;

     // Jika File Baru diganti dengan nama uniq
     $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
     move_uploaded_file($tmpName, 'images/' . $namaFileBaru);
     return $namaFileBaru;
}

// ================================================================
function hapus($id)
{
     global $conn;
     mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
     return mysqli_affected_rows($conn);
}

// ================================================================
function ubah($data)
{
     global $conn;
     $id = $data['id'];
     $nrp = htmlspecialchars($data['nrp']);
     $nama = htmlspecialchars($data['nama']);
     $email = htmlspecialchars($data['email']);
     $jurusan = htmlspecialchars($data['jurusan']);

     $gambarLama = htmlspecialchars($data['gambarLama']);

     // Cek apakah gambar baru diupload
     if ($_FILES['gambar']['error'] === 4) {
          $gambar = $gambarLama;
     } else {
          $gambar = upload();
     }

     $query = "UPDATE mahasiswa SET 
          nrp = '$nrp', 
          nama = '$nama', 
          email = '$email', 
          jurusan = '$jurusan',
          gambar = '$gambar'
          WHERE id = $id ";
     mysqli_query($conn, $query);
     return mysqli_affected_rows($conn);
}

// ================================================================
function cari($keyword)
{
     $query = "SELECT * FROM mahasiswa 
          WHERE nrp LIKE '%$keyword%' OR 
          nama LIKE '%$keyword%' OR 
          jurusan LIKE '%$keyword%' ";
     return query($query);
}

// =================================================================
function registrasi($data)
{
     global $conn;
     $username = strtolower(stripcslashes($data["username"]));
     $password = mysqli_real_escape_string($conn, $data["password"]);
     $password2 = mysqli_real_escape_string($conn, $data["password2"]);

     // Cek username sudah ada atau belum
     $result = mysqli_query($conn, "SELECT username FROM user WHERE username='$username' ");
     if(mysqli_fetch_assoc($result)){
          echo "<script>alert('Username sudah terdaftar!')</script>";
          return false;
     }


     // Cek apakah password sama
     if ($password !== $password2) {
          echo "<script>alert('Password tidak sesuai')</script>";
          return false;
     }

     // Enkripsi password
     $password = password_hash($password, PASSWORD_DEFAULT);

     // Tambahkan user baru ke database
     mysqli_query($conn, "INSERT INTO user VALUES ('', '$username', '$password')"); 
     return mysqli_affected_rows($conn);


}
