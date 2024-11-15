<?php
// core
require_once 'C:/xampp/htdocs/finalDemo/app/dbconfig.php';
// UI
require_once "../shared/head.php";
require_once "../shared/navbar.php";

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $deleteQuery = "DELETE FROM `departments` WHERE id = $id";
  $delete = mysqli_query($con, $deleteQuery);
  if ($delete) {
    path('departments/index.php');
  }
}


$selectQuery = "SELECT * FROM `departments`";
$select = mysqli_query($con, $selectQuery);
?>

<div class="container mt-5">
  <div class="card bg-dark text-light">
    <div class="card-body table-responsive">
      <table class="table table-dark">
        <thead>
          <tr>
            <th>#</th>
            <th>Department</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($select as $index => $department): ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td><?= $department['department'] ?></td>
              <td>
                <a href="edit.php?edit=<?= $department['id'] ?>" class="btn btn-warning">Edit</a>
                <a href="?delete=<?= $department['id'] ?>" class="btn btn-danger">Delete</a>
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