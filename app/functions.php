<?php
define('base_url', 'http://localhost/finalDemo/');

function url($path = null)
{
  return base_url . $path;
}

function path($path = null)
{
  $location = base_url . $path;
  echo "<script>
  window.location.replace('$location')
  </script>";
}

function filterString($input_value)
{
  $input_value = trim($input_value);
  $input_value = strip_tags($input_value);
  $input_value = htmlspecialchars($input_value);
  $input_value = stripslashes($input_value);

  return $input_value;
}

function stringValidation($input_value, $min)
{
  $empty = empty($input_value);
  $length = strlen($input_value) < $min;
  if ($empty || $length) {
    return true;
  } else {
    return false;
  }
}

function imageValidation($image_name, $image_size, $limitSize)
{
  $empty = empty($image_name);
  $size = ($image_size / 1024) / 1024;
  $isBigger = $size > $limitSize;
  if ($empty || $isBigger) {
    return true;
  } else {
    return false;
  }
}

function auth($num1 = null, $num2 = null)
{
  if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['role'] == 1 || $_SESSION['user']['role'] == $num1 || $_SESSION['user']['role'] == $num2) {
      return true;
    } else {
      path("401.php");
    }
  } else {
    path('login.php');
  }
}
