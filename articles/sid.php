<?php
if(isset($_GET['sid']))
{
  $id = $_GET['sid'];
  $idint = (int)$_GET['sid'];
  if($_GET['sid'] != $idint)
  {
    $sid = -1;
  }
  else {
    $sid = $idint;

  }
}
else {
  $sid = -1;
}
?>
