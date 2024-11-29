<?php
// core
require_once 'C:/xampp/htdocs/finalDemo/app/dbconfig.php';
// UI
require_once "../shared/head.php";
require_once "../shared/navbar.php";
auth();
$AllDepartments = "SELECT * FROM `Departments`";
$departments = mysqli_query($con, $AllDepartments);
if (isset($_GET["edit"])) {
  $id = $_GET["edit"];
  $selectOneQuery = "SELECT * FROM `employees` where id = $id";
  $selectOne = mysqli_query($con, $selectOneQuery);
  $row = mysqli_fetch_assoc($selectOne);
  if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $salary = $_POST['salary'];
    $department_id = $_POST['department'];

    // upload image
    if ($_FILES["image"]['name']) {
      $image_name = "finalDemo.com_" . time() . "_" . $_FILES["image"]['name'];
      $tmp_name = $_FILES['image']['tmp_name'];
      $location = './uploads/' . $image_name;
      move_uploaded_file($tmp_name, $location);
      $old_image = $row['image'];
      unlink("./uploads/" . $old_image);
    } else {
      $image_name = $row['image'];
    }

    $updateQuery = "UPDATE `employees` SET `name`='$name',`email`='$email',`phone`='$phone',`salary`=$salary, `image`= '$image_name',`department_id`=$department_id WHERE id = $id";
    $update = mysqli_query($con, $updateQuery);
    if ($update) {
      path('employees/index.php');
    }
  }
}


?>

<div class="container col-6 mt-5">
  <h1 class="text-center text-light">Update Employee</h1>
  <?php if (!empty($message)): ?>
    <div class="alert alert-success">
      <?= $message ?>
    </div>
  <?php endif; ?>
  <div class="card bg-dark text-light">
    <div class="card-body">
      <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="name" class="form-label">Name:</label>
          <input type="text" value='<?= $row['name'] ?>' placeholder="Name" name="name" id="name" class="form-control">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input type="email" value='<?= $row['email'] ?>' placeholder="Email" name="email" id="email" class="form-control">
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Phone:</label>
          <input type="text" value='<?= $row['phone'] ?>' placeholder="Phone" name="phone" id="phone" class="form-control">
        </div>
        <div class="mb-3">
          <label for="salary" class="form-label">Salary:</label>
          <input type="number" value='<?= $row['salary'] ?>' placeholder="Salary" name="salary" id="salary" class="form-control">
        </div>
        <div class="mb-3">
          <label for="department" class="form-label">Department:</label>
          <select name="department" id="department" class="form-select">
            <?php foreach ($departments as $department) : ?>
              <?php if ($row['department_id'] == $department['id']): ?>
                <option selected value="<?= $department['id'] ?>"><?= $department['department'] ?></option>
              <?php else: ?>
                <option value="<?= $department['id'] ?>"><?= $department['department'] ?></option>
              <?php endif; ?>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Image:</label>
          <input type="file" class="form-control mb-2" name="image">
          <img width="200" src="./uploads/<?= $row['image'] ?>" alt="">
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