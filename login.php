<?php
session_start();
require 'functions.php';


// cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
     $id = $_COOKIE['id'];
     $key = $_COOKIE['key'];


     //ambil username berdasarkan id
     $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
     $row = mysqli_fetch_assoc($result);


     // Cek cookie dan username
     if($key === hash('sha256',$row['username'])){
          // set session
          $_SESSION['login'] = true;
     }
}

// cek session
if(isset($_SESSION['login'])){
     header('location: index.php');
}


if (isset($_POST['login'])) {
     $username = $_POST['username'];
     $password = $_POST['password'];
     $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' ");

     // Cek username
     if (mysqli_num_rows($result) === 1) {
          // Cek password
          $row = mysqli_fetch_assoc($result);
          if (password_verify($password, $row['password'])) {
               // set session
               $_SESSION['login'] = true;
               // cek remember me
               if(isset($_POST['remember'])){
                    // buat cookie

                    setcookie('id', $row['id'], time()+60);
                    setcookie('key', hash('sha256', $row['username']), time()+60);
               }
               // $_SESSION['username'] = $username;
               header('location: index.php');
               exit;
          }
     }
     $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>


<body>

     <?php if (isset($error)) {
          echo "<script>alert('Login gagal')</script>";
     } ?>

     <div class="container mt-5">
          <div class="card">
               <div class="card-header">
                    <h3>Form Login</h3>
               </div>
               <div class="card-body">
                    <form action="" method="POST">
                         <div class="mb-3">
                              <label for="username">Username :</label>
                              <input type="text" class="form-control" name="username" id="username">
                         </div>
                         <div class="mb-3">
                              <label for="username">Password :</label>
                              <input type="password" class="form-control" name="password" id="password">
                         </div>
                         <div class="mb-3">
                              <input type="checkbox" name="remember" id="remember">
                              <label for="remember">Remember Me :</label>
                         </div>
                         <div class="mb-3">
                              <button class="btn btn-primary" type="submit" name="login">Login</button>
                         </div>
                    </form>
               </div>
          </div>
     </div>



     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js
"></script>
</body>

</html>