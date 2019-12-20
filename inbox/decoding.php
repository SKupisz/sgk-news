<?php

class Decode{
  public function __construct($path){
    if(isset($path)){
      include $path."mainTables.php";
    }
    else{
      include "./mainTables.php";
    }
    
  }
  public function toNormal($alfa)
  {
    $cypher = "";
    $modulo = "";
    $i = 0;
    $separators = basic()[1];
    $tableBasic = basic()[0];
    while(!in_array($alfa[$i],$separators))
    {
      for($j = 0 ;$j < count($tableBasic); $j++)
      {
        if($tableBasic[$j] == $alfa[$i])
        {
          $modulo.=(String)($j);
          break;
        }
      }
      $i++;
    }
    $i++;
    $modulo = (int)$modulo;
    $collecting = $alfa[$i];
    if(array_search($collecting,$tableBasic) == 0)
    {
      $ifSum = 0;
    }
    else {
      $ifSum = 1;
    }
    $i+=2;
    $option = $alfa[$i];
    $option = array_search($option,$tableBasic);
    switch($option)
    {
      case 1:
      $table = classic();
      $uppers = classicUpperCase();
      $nonalpha = classicNonAlpha()[0];
      break;
      default:
      break;
    }
    $actual = "";
    $modNow = 0;
    $key = 0;
    $actualNumber = "";
    $i+=2;
    while($i < strlen($alfa))
    {
      if(in_array($alfa[$i],$separators)){

        for($j = 0 ; $j < strlen($actual); $j++)
        {
          $operand = $actual[$j];
          $number = array_search($operand,$tableBasic);
          $actualNumber.=$number;
        }
        $actualNumber = (int) $actualNumber;
        //odczyt liczb działa
        //echo $actualNumber."<br>";
        if(in_array($actualNumber,$table))
        {
          $pos = array_search($actualNumber,$table);
        }
        else if(in_array($actualNumber,$uppers)){
          $pos = array_search($actualNumber,$uppers);
        }
        else if(in_array($actualNumber,$nonalpha)){
          //echo $actualNumber."<br>";
          $pos = array_search($actualNumber,$nonalpha);
        }
        else {
          $pos = -1;
        }
        if($pos != -1)
        {

                  $modNow += ($pos % $modulo);
                  $pos-=($modNow-($pos % $modulo));
                  //echo $pos."<br>";
                  if(in_array($actualNumber,$nonalpha))
                  {
                    $pos%=count($nonalpha);
                    if($pos < 0)
                    {
                      $pos+=count($nonalpha);
                    }
                  }
                  else {
                    $pos%=26;
                    if($pos < 0)
                    {
                      $pos+=26;
                    }
                  }

                  //echo $actualNumber." ".$modNow."<br>";
                  if(in_array($actualNumber,$table))
                  {
                    $cypher.=(String)chr($pos+97);
                  }
                  else if(in_array($actualNumber,$uppers)){
                    $cypher.=(String)chr($pos+65);
                  }
                  else {
                    $cypher.=classicNonAlpha()[1][$pos];
                  }
                  $actual = "";
                  $actualNumber = "";
        }
        else {
          $actual.=$alfa[$i];
        }

      }
      else {
        $actual.=$alfa[$i];
      }
      $i++;
    }
    for($j = 0 ; $j < strlen($actual); $j++)
    {
      $operand = $actual[$j];
      $number = array_search($operand,$tableBasic);
      $actualNumber.=$number;
    }
    $actualNumber = (int) $actualNumber;
    //odczyt liczb działa
    if(in_array($actualNumber,$table))
    {
      $pos = array_search($actualNumber,$table);
    }
    else if(in_array($actualNumber,$uppers)){
      $pos = array_search($actualNumber,$uppers);
    }
    else {
      //echo $actualNumber."<br>";
      $pos = array_search($actualNumber,$nonalpha);
    }
    $modNow += ($pos % $modulo);
    $pos-=($modNow-($pos % $modulo));
    //echo $pos;
    if(in_array($actualNumber,$nonalpha))
    {
      $pos%=count($nonalpha);
      if($pos < 0)
      {
        $pos+=count($nonalpha);
      }
    }
    else {
      $pos%=26;
      if($pos < 0)
      {
        $pos+=26;
      }
    }

    //echo $actualNumber." ".$modNow."<br>";
    if(in_array($actualNumber,$table))
    {
      $cypher.=(String)chr($pos+97);
    }
    else if(in_array($actualNumber,$uppers)){
      $cypher.=(String)chr($pos+65);
    }
    else {
      $cypher.=classicNonAlpha()[1][$pos];

    }

    $actual = "";
    $actualNumber = "";
    return $cypher;
  }
}
?>
