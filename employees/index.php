<?php
// core
require_once 'C:/xampp/htdocs/finalDemo/app/dbconfig.php';
// UI
require_once "../shared/head.php";
require_once "../shared/navbar.php";

auth(2, 3);
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $selectOneQuery = "SELECT `image` FROM `employees` where id = $id";
  $selectOne = mysqli_query($con, $selectOneQuery);
  $row = mysqli_fetch_assoc($selectOne);
  $old_image = $row['image'];
  $deleteQuery = "DELETE FROM `employees` WHERE id = $id";
  $delete = mysqli_query($con, $deleteQuery);
  if ($delete) {
    unlink("./uploads/" . $old_image);
    path('employees/index.php');
  }
}


$selectQuery = "SELECT * FROM `employees_department`";
$select = mysqli_query($con, $selectQuery);
?>

<div class="container mt-5">
  <div class="card bg-dark text-light">
    <div class="card-body table-responsive">
      <table class="table table-dark">
        <thead>
          <tr>
            <th>#</th>
            <th>image</th>
            <th>name</th>
            <?php if ($_SESSION['user']['role'] == 1 || $_SESSION['user']['role'] == 2): ?>
              <th>email</th>
              <th>phone</th>
              <th>salary</th>
            <?php endif; ?>
            <th>department</th>

            <?php if ($_SESSION['user']['role'] == 1 || $_SESSION['user']['role'] == 2): ?>
              <th>Action</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($select as $index => $employee): ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td><img width="100" src="./uploads/<?= $employee['image'] ?>" alt=""></td>
              <td><?= $employee['name'] ?></td>
              <?php if ($_SESSION['user']['role'] == 1 || $_SESSION['user']['role'] == 2): ?>
                <td><?= $employee['email'] ?></td>
                <td><?= $employee['phone'] ?></td>
                <td><?= $employee['salary'] ?>$ USD</td>
              <?php endif; ?>
              <td><?= $employee['department'] ?></td>
              <?php if ($_SESSION['user']['role'] == 1 || $_SESSION['user']['role'] == 2): ?>
                <td>

                  <?php if ($_SESSION['user']['role'] == 1): ?>
                    <a href="edit.php?edit=<?= $employee['id'] ?>" class="btn btn-warning">Edit</a>
                  <?php else: ?>
                    <a disabled class="btn btn-warning disabled">Edit</a>
                  <?php endif; ?>
                  <a href="?delete=<?= $employee['id'] ?>" class="btn btn-danger">Delete</a>
                </td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<?php
require_once "../shared/scripts.php";
require_once "../shared/footer.php";
?>