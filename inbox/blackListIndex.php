<?php if(!isset($names))
{
  header("Location: ../inbox.php");
  exit();
}
?>
<html>
<body>
<section id = "u9cbl_r">Your List</section>
<section id = "u9cbl_w">Block<label class = "resp"> user</label></section>
<section id = "u9cbl_rc">
  <section id = "u9cbl_rcmr">
    <section id = "u9cbl_rcmrn">Username</section>
    <section id = "u9cbl_rcmrd">Blocking since</section>
    <section id = "u9cbl_rcmrr">Delete from black list</section>
  </section>
  <?php
  $lt = count($names);
  if($lt == 0)
  {
    ?><section id = "u9cblnone">There is no user on your black list</section><?php
  }
  else {
    if($lt <= 30)
    {
      for($i = 0 ; $i < $lt; $i++)
      {
        $name = $names[$i];
        $date = $dates[$i];
        $numId = $ids[$i];
        ?><section id = "u9cbl_rcmr" style="position: absolute; top: <?php echo 23+8*($i);?>%; left: 0px;">
          <section id = "u9cbl_rcmrn"><?php echo $name;?></section>
          <section id = "u9cbl_rcmrd"><?php echo $date;?></section>
          <section id = "u9cbl_rcmrr">
            <form method = "post" action = "inbox/deleteFromBL.php">
              <input type = "hidden" name = "u9cbl_dn" value = "<?php echo $numId;?>"/>
              <input type = "submit" id = "u9cbl_ds" value = "Delete"/>
            </form>
          </section>
        </section><?php
      }
    }
    else {
      if($lt < 60)
      {

      }
      else {

      }
    }
  }

  ?>
</section>
<section id = "u9cbl_wc">
  <form method="post" action = "inbox/onBlackList.php">
    <label id = "u9cbl_wcus">
      Username <input type = "text" id = "u9cbl_wcn" name = "u9cbl_wcn"/>
    </label>
    <input type="submit" value = "Confirm" id = "u9cbl_wcc"/>
  </form>
</section>
</body>
</html>
