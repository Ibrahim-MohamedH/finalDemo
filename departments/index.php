<?php
// core
require_once 'C:/xampp/htdocs/finalDemo/app/dbconfig.php';
// UI
require_once "../shared/head.php";
require_once "../shared/navbar.php";
auth(2, 3);
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
            <?php if ($_SESSION['user']['role'] == 1 || $_SESSION['user']['role'] == 2): ?>
              <th>Action</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($select as $index => $department): ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td><?= $department['department'] ?></td>

              <?php if ($_SESSION['user']['role'] == 1 || $_SESSION['user']['role'] == 2): ?>
                <td>
                  <?php if ($_SESSION['user']['role'] == 1): ?>
                    <a href="edit.php?edit=<?= $department['id'] ?>" class="btn btn-warning">Edit</a>
                  <?php endif; ?>
                  <a href="?delete=<?= $department['id'] ?>" class="btn btn-danger">Delete</a>
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