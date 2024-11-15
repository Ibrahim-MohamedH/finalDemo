<?php
// core
require_once 'C:/xampp/htdocs/finalDemo/app/dbconfig.php';
// UI
require_once "../shared/head.php";
require_once "../shared/navbar.php";
$message = '';
if (isset($_POST['submit'])) {
  $department = $_POST['department'];
  $insertQuery = "INSERT INTO `departments` VALUES (NULL, '$department')";
  $insert = mysqli_query($con, $insertQuery);
  if ($insert) {
    $message = "<b>$department</b> has been added successfully";
  }
}

?>

<div class="container col-6 mt-5">
  <h1 class="text-center text-light">Add New Department</h1>
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
          <input type="text" placeholder="department name" name="department" id="department" class="form-control">
        </div>
        <div class=" text-center">
          <button class="btn btn-primary" name="submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>




<?php
require_once "../shared/scripts.php";
require_once "../shared/footer.php";
?>