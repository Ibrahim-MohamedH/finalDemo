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
