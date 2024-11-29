<?php
// core
require_once 'C:/xampp/htdocs/finalDemo/app/dbconfig.php';
// UI
require_once "../shared/head.php";
require_once "../shared/navbar.php";

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
            <th>email</th>
            <th>phone</th>
            <th>salary</th>
            <th>department</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($select as $index => $employee): ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td><img width="100" src="./uploads/<?= $employee['image'] ?>" alt=""></td>
              <td><?= $employee['name'] ?></td>
              <td><?= $employee['email'] ?></td>
              <td><?= $employee['phone'] ?></td>
              <td><?= $employee['salary'] ?>$ USD</td>
              <td><?= $employee['department'] ?></td>
              <td>
                <a href="edit.php?edit=<?= $employee['id'] ?>" class="btn btn-warning">Edit</a>
                <a href="?delete=<?= $employee['id'] ?>" class="btn btn-danger">Delete</a>
              </td>
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