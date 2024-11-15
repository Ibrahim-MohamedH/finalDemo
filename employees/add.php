<?php
// core
require_once 'C:/xampp/htdocs/finalDemo/app/dbconfig.php';
// UI
require_once "../shared/head.php";
require_once "../shared/navbar.php";
$message = '';
$AllDepartments = "SELECT * FROM `Departments`";
$departments = mysqli_query($con, $AllDepartments);
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $salary = $_POST['salary'];
  $department_id = $_POST['department'];
  $insertQuery = "INSERT INTO `employees` VALUES (NULL, '$name', '$email', '$phone', $salary, $department_id)";
  $insert = mysqli_query($con, $insertQuery);
  if ($insert) {
    $message = "<b>$name</b> has been added successfully";
  }
}

?>

<div class="container col-6 mt-5">
  <h1 class="text-center text-light">Add New Employee</h1>
  <?php if (!empty($message)): ?>
    <div class="alert alert-success">
      <?= $message ?>
    </div>
  <?php endif; ?>
  <div class="card bg-dark text-light">
    <div class="card-body">
      <form method="post">
        <div class="mb-3">
          <label for="name" class="form-label">Name:</label>
          <input type="text" placeholder="Name" name="name" id="name" class="form-control">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input type="email" placeholder="Email" name="email" id="email" class="form-control">
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Phone:</label>
          <input type="text" placeholder="Phone" name="phone" id="phone" class="form-control">
        </div>
        <div class="mb-3">
          <label for="salary" class="form-label">Salary:</label>
          <input type="number" placeholder="Salary" name="salary" id="salary" class="form-control">
        </div>
        <div class="mb-3">
          <label for="department" class="form-label">Department:</label>
          <select name="department" id="department" class="form-select">
            <?php foreach ($departments as $department) : ?>
              <option value="<?= $department['id'] ?>"><?= $department['department'] ?></option>
            <?php endforeach; ?>
          </select>
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