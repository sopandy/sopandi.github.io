<?php
require 'functions.php';

if(isset($_POST['register'])){
     if(registrasi($_POST) > 0) {
          echo "<script>
               alert('User baru berhasil ditambahkan');
          </script>";
     }else{
          echo mysqli_error($conn);
     }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Registrasi</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
     <div class="container mt-5">
          <div class="card">
               <div class="card-header">
                    <h3>Form Registrasi</h3>
               </div>
               <div class="card-body">
                    <form action="" method="POST">
                         <div class="mb-3">
                              <label for="username">Username :</label>
                              <input type="text" class="form-control" name="username" id="username">
                         </div>
                         <div class="mb-3">
                              <label for="password">Password :</label>
                              <input type="password" class="form-control" name="password" id="password">
                         </div>
                         <div class="mb-3">
                              <label for="password">Konfirmasi Password :</label>
                              <input type="password" class="form-control" name="password2" id="password2">
                         </div>
                         <div class="mb-3">
                              <button class="btn btn-primary" type="submit" name="register">Register</button>
                         </div>
                    </form>
               </div>
          </div>
     </div>



     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js
"></>
</body>

</html>