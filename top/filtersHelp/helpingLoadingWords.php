<?php
$length = $rezultat->num_rows;
for($i = 0; $i < $length; $i++)
{
  $row = $rezultat->fetch_assoc();
  $id[$i] = $row['id'];
  $from[$i] = $row['username'];
  $title[$i] = $row['title'];
  $content[$i] = $row['content'];
  $words[$i] = $row['words'];
  $views[$i] = $row['views'];
}
$id = array_reverse($id);
$from = array_reverse($from);
$title = array_reverse($title);
$content = array_reverse($content);
$words = array_reverse($words);
$views = array_reverse($views);
?>
