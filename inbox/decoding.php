<?php
function strpos_all($haystack, $needle) {
    $offset = 0;
    $allpos = array();
    while (($pos = strpos($haystack, $needle, $offset)) !== FALSE) {
        $offset   = $pos + 1;
        $allpos[] = $pos;
    }
    return $allpos;
}
class Decode{
  public function __construct(){
    if(!function_exists("basic")){
      if(isset($path)){
        include $path."mainTables.php";
      }
      else{
        include "mainTables.php";
      }
    }

    
  }
  public function toNormal($alfa)
  {
    if(strpos($alfa,"k"))
    {
      //echo $alfa."<br>";
      $forDecode = explode("k",$alfa);
      $cypher = "";
      /*echo count($forDecode);
      for($i = 0; $i < count($forDecode); $i++)
      {
        echo $forDecode[$i]."<br>";
      }*/
      for($i = 0; $i < count($forDecode); $i++)
      {
        $cypher.=($this->toNormal($forDecode[$i]));
        //echo $cypher."<br><br>";
      }
      return $cypher;
    }
    else {
      $cypher = "";
      $modulo = "";
      $i = 0;
      $separators = basic()[1];
      $tableBasic = basic()[0];
      $falseSeq = basic()[2];
      $noAscii = basic()[3];
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
        $explainonalpha = classicNonAlpha()[1];
        break;
        case 2:
        $table = deus_vult();
        $uppers = deus_vultUpperCase();
        $nonalpha = deus_vultNonAlpha()[0];
        $explainonalpha = deus_vultNonAlpha()[1];
        default:
        break;
      }
      $actual = "";
      $modNow = 0;
      $key = 0;
      $actualNumber = "";
      $signal = 0;
      $positions = explode("f",$alfa);
      $alfa = "";
      for($k = 0; $k < count($positions); $k+=2)
      {
        $alfa.=$positions[$k];
        if($k+2 < count($positions))
        {
          $alfa.="a";
        }

      }
      $i+=2;
      $counter = 0;
      while($i < strlen($alfa))
      {
        if(in_array($alfa[$i],$separators)){
          $counter++;
          //echo $actual." ::: ".substr($alfa,0,$i).$counter."<br>";
          for($j = 0 ; $j < strlen($actual); $j++)
          {
            $operand = $actual[$j];
            $number = array_search($operand,$tableBasic);
            //echo $operand." ".$number."<br>";
            $actualNumber.=$number;
          }
          //echo $actualNumber." ";
          $actualNumber = (int) $actualNumber;
          //odczyt liczb działa
          //echo $actualNumber."<br>";
          if(in_array($actualNumber,$table))
          {
            $pos = array_search($actualNumber,$table);
            ////echo $table[$pos].".";
          }
          else if(in_array($actualNumber,$uppers)){
            $pos = array_search($actualNumber,$uppers);
            ////echo $uppers[$pos].".";
          }
          else if(in_array($actualNumber,$nonalpha)){
            ////echo $actualNumber."<br>";
            $pos = array_search($actualNumber,$nonalpha);
            ////echo $nonalpha[$pos].".";
          }
          else {
            $pos = -1;
          }
          if($pos != -1)
          {

                    $modNow += ($pos % $modulo);
                    $pos-=($modNow-($pos % $modulo));
                    //echo "ModNow: ".$modNow."<br>";
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
                    ////echo "jest <br>";
                    ////echo $actualNumber." ".$modNow."<br>";
                    if(in_array($actualNumber,$table))
                    {
                      $cypher.=(String)chr($pos+97);
                      //echo $cypher."<br>";
                    }
                    else if(in_array($actualNumber,$uppers)){
                      $cypher.=(String)chr($pos+65);
                      //echo $cypher."<br>";
                    }
                    else if(in_array($actualNumber,$nonalpha)){
                      $cypher.=$explainonalpha[$pos];
                      //echo $cypher."<br>";
                    }
                    else {
                      break;
                    }
                    $actual = "";
                    $actualNumber = "";
          }
          else {
            //echo $actualNumber;
            $actualNumber = sqrt($actualNumber);
            //echo $actualNumber;
            $actualNumber = (string)$actualNumber;
            if(array_search($actualNumber,$noAscii))
            {
              $cypher.=$noAscii[$actualNumber];
            }
            else {
              $actualNumber = (int)$actualNumber;
              $cypher.=chr($actualNumber);
            }
            $actual = "";
            $actualNumber = "";
          }
          //echo $cypher." ".$modNow."<br>";
          //echo $modNow."<br>";
          //echo "<br>";
          if($modNow > 100)
          {
            $modNow = 0;
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
      else if(in_array($actualNumber,$nonalpha)){
        $pos = array_search($actualNumber,$nonalpha);
      }
      else {
        $pos = -1;
      }
      if($pos != -1)
      {
        $modNow += ($pos % $modulo);
        $pos-=($modNow-($pos % $modulo));
        ////echo $pos;
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

        ////echo $actualNumber." ".$modNow."<br>";
        if(in_array($actualNumber,$table))
        {
          $cypher.=(String)chr($pos+97);
        }
        else if(in_array($actualNumber,$uppers)){
          $cypher.=(String)chr($pos+65);
        }
        else {
          $cypher.=$explainonalpha[$pos];
        }

      }
      else {
        //echo $actualNumber;
        $actualNumber = sqrt($actualNumber);
        //echo $actualNumber."<br>";
        $actualNumber = (string)$actualNumber;
        if(array_search($actualNumber,$noAscii))
        {
          $cypher.=$noAscii[$actualNumber];
        }
        else {
          $actualNumber = (int)$actualNumber;
          $cypher.=chr($actualNumber);
        }
        $actual = "";
        $actualNumber = "";
      }

      $actual = "";
      $actualNumber = "";
      return $cypher;
    }

  }
}
?>
