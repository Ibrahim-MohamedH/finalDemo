<?php
// core
require_once "C:/xampp/htdocs/finalDemo/app/functions.php";
if (isset($_GET['logout'])) {
  session_unset();
  path('login.php');
}
?>
<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="<?= url("index.php") ?>">Company</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <?php if (isset($_SESSION['user'])): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Departments
              </a>
              <ul class="dropdown-menu">
                <?php if ($_SESSION['user']['role'] == 1): ?>
                  <li><a class="dropdown-item" href="<?= url('departments/add.php') ?>">add Department</a></li>
                <?php endif; ?>
                <li><a class="dropdown-item" href="<?= url('departments/index.php') ?>">List Departments</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Employees
              </a>
              <ul class="dropdown-menu">
                <?php if ($_SESSION['user']['role'] == 1): ?>
                  <li><a class="dropdown-item" href="<?= url('employees/add.php') ?>">add Employee</a></li>
                <?php endif; ?>
                <li><a class="dropdown-item" href="<?= url('employees/index.php') ?>">List Employees</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img width="30" height="30" class="rounded-circle" src="<?= url('employees/uploads/') . $_SESSION['user']['image'] ?>" alt="">
                <?= $_SESSION['user']['name'] ?>
              </a>
              <ul class="dropdown-menu">
                <li class="text-center"><a class="btn btn-danger" href="?logout">Logout</a></li>
              </ul>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="btn btn-success" href="<?= url('login.php') ?>">
                Login
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
</header>