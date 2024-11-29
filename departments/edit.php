<?php
// core
require_once 'C:/xampp/htdocs/finalDemo/app/dbconfig.php';
// UI
require_once "../shared/head.php";
require_once "../shared/navbar.php";
auth();
$message = '';
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $selectOneQuery = "SELECT * FROM `departments` where id = $id";
  $selectOne = mysqli_query($con, $selectOneQuery);
  $row = mysqli_fetch_assoc($selectOne);
  $depertment = $row['department'];
  if (isset($_POST['update'])) {
    $department = $_POST['department'];
    $updateQuery = "UPDATE `departments` SET `department`='$department' WHERE id = $id";
    $update = mysqli_query($con, $updateQuery);
    if ($update) {
      path('departments/index.php');
    }
  }
}


?>

<div class="container col-6 mt-5">
  <h1 class="text-center text-light">Update Department</h1>
  <?php if (!empty($message)): ?>
    <div class="alert alert-success">
      <?= $message ?>
    </div>
  <?php endif; ?>
  <div class="card bg-dark text-light">
    <div class="card-body">
      <form method="post">
        <div class="mb-3">
          <label for="department" class="form-label">Depratment Name:</label>
          <input type="text" value="<?= $depertment ?>" placeholder="department name" name="department" id="department" class="form-control">
        </div>
        <div class=" text-center">
          <button class="btn btn-warning" name="update">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>




<?php
require_once "../shared/scripts.php";
require_once "../shared/footer.php";
?>