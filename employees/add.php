<?php
// core
require_once 'C:/xampp/htdocs/finalDemo/app/dbconfig.php';
require_once 'C:/xampp/htdocs/finalDemo/app/functions.php';
// UI
require_once "../shared/head.php";
require_once "../shared/navbar.php";
$message = '';
$AllDepartments = "SELECT * FROM `Departments`";
$departments = mysqli_query($con, $AllDepartments);

$errors = [];

if (isset($_POST['submit'])) {
  $name = filterString($_POST['name']);
  $email = filterString($_POST['email']);
  $phone = filterString($_POST['phone']);
  $salary = filterString($_POST['salary']);
  $department_id = $_POST['department'];
  if (stringValidation($name, 8)) {
    $errors[] = "Employee name is required and it must be at least 8 chars";
  }
  if (stringValidation($email, 2)) {
    $errors[] = "Employee email is required";
  }
  if (stringValidation($phone, 11)) {
    $errors[] = "Employee phone is required";
  }
  if (stringValidation($salary, 0)) {
    $errors[] = "Employee salary is required";
  }

  // image upload
  // $real_name = $_FILES['image']['name'];
  $image_name = "FinalDemo.com" . "_" . time() . "_" . $_FILES['image']['name'];
  $tmp_name = $_FILES['image']['tmp_name'];
  $size = $_FILES['image']['size'];
  $location = './uploads/' . $image_name;
  if (imageValidation($_FILES['image']['name'], $size, 2)) {
    $errors[] = "Image is required and it must be less than 2MB";
  }
  if (empty($errors)) {
    $insertQuery = "INSERT INTO `employees` VALUES (NULL, '$name', '$email', '$phone', $salary, '$image_name', $department_id)";
    $insert = mysqli_query($con, $insertQuery);
    if ($insert) {
      move_uploaded_file($tmp_name, $location);
      $message = "<b>$name</b> has been added successfully";
    }
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
  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
      <ul>
        <?php foreach ($errors as $error): ?>
          <li><?= $error ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>
  <div class="card bg-dark text-light">
    <div class="card-body">
      <form method="post" enctype="multipart/form-data">
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
        <div class="mb-3">
          <label for="image" class="form-label">Image:</label>
          <input type="file" class="form-control" name="image">
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