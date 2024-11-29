<?php
// core
require_once "./app/dbconfig.php";
require_once "./app/functions.php";
// UI
require_once "./shared/head.php";
require_once "./shared/navbar.php";

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $selectOneQuery = "SELECT * FROM `employees` WHERE email = '$email'";
  $selectOne = mysqli_query($con, $selectOneQuery);
  if (mysqli_num_rows($selectOne) == 1) {
    $row = mysqli_fetch_assoc($selectOne);
    $passwordVerify = password_verify($password, $row['password']);
    if ($passwordVerify) {
      $_SESSION['user'] = [
        'id' => $row['id'],
        'name' => $row['name'],
        'email' => $row['email'],
        'phone' => $row['phone'],
        'salary' => $row['salary'],
        'image' => $row['image'],
        'department_id' => $row['department_id'],
        'role' => $row['roles_id'],
      ];
      path('index.php');
    } else {
      echo "false";
    }
  }
}
?>
<div class="container mt-5 col-5">
  <h1 class="text-center">سجل الدخول يا معلم</h1>
  <div class="card card-body bg-dark text-light">
    <form method="post">
      <div class="row">
        <div class="col-6 mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" id="email" name="email" class="form-control">
        </div>
        <div class="col-6 mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" id="password" name="password" class="form-control">
        </div>
        <div class="col-12 text-center">
          <button class="btn btn-primary" name="login">Login</button>
        </div>
      </div>
    </form>
  </div>
</div>







<?php
require_once "./shared/scripts.php";
require_once "./shared/footer.php";
?>