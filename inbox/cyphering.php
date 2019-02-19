<?php

class Cypher{
    public function __construct(){
      include "mainTables.php";
    }
    function toDelta($text,$modulo,$ifSum,$option){
      $cypher = "";
      $first = $this->alfa($modulo,$ifSum,$option);
      $cypher.=$first;
      $modNow = 0;
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
      $basicTableCypher = basic()[0];
      $separators = basic()[1];
      $ifBig = false;
      for($i = 0 ; $i < strlen($text); $i++)
      {
        $where = ord($text[$i]);
        if($where >96 && $where < 123)
        {
          $where-=97;
          $where+=$modNow;
          if($where >25)
          {
            $where = $where % 26;
          }
          if($ifSum == 1)
          {
            $modNow+=($where % $modulo);
          }
          else {
            $modNow = ($where % $modulo);
          }
          $number = $table[$where];
          $ret = "";
          $letter = (String)$number;
          for($j = 0 ; $j < strlen($letter); $j++){
            $now = (int)$letter[$j];
            if($j != strlen($letter))
            {
              $ret.=$basicTableCypher[$now];
            }

          }
          $cypher.=$ret;
          if($i != strlen($text)-1)
          {
            $cypher.=$separators[rand(0,count($separators)-1)];
          }

        }
        else if($where > 64 && $where < 91)
        {
          $where-=65;
          $where+=$modNow;
          if($where >25)
          {
            $where = $where % 26;
          }
          if($ifSum == 1)
          {
            $modNow+=$where % $modulo;
          }
          else {
            $modNow =$where % $modulo;
          }
          $number = $uppers[$where];
          $ret = "";
          $letter = (String)$number;
          for($j = 0 ; $j < strlen($letter); $j++){
            $now = (int)$letter[$j];
            if($j != strlen($letter))
            {
              $ret.=$basicTableCypher[$now];
            }

          }
          $cypher.=$ret;
          if($i != strlen($text)-1)
          {
            $cypher.=$separators[rand(0,count($separators)-1)];
          }
        }
        else{
          $where = array_search($text[$i],classicNonAlpha()[1]);
          $where+=$modNow;
          if($where >count($nonalpha)-1)
          {
            $where = $where % count($nonalpha);
          }
          if($ifSum == 1)
          {
            $modNow+=$where % $modulo;
          }
          else {
            $modNow =$where % $modulo;
          }
          $number = $nonalpha[$where];
          $ret = "";
          $letter = (String)$number;
          //echo $letter."<br>";
          for($j = 0 ; $j < strlen($letter); $j++){
            $now = (int)$letter[$j];
            $ret.=$basicTableCypher[$now];
          }
          $cypher.=$ret;
          if($i != strlen($text)-1)
          {
            $cypher.=$separators[rand(0,count($separators)-1)];
          }
        }

      }
      return $cypher;
    }
    function alfa($modulo,$ifSum,$option){
      $basicTableCypher = basic()[0];
      $separators = basic()[1];
      $return = "";
      $modStr = (String)$modulo;
      for($i = 0 ; $i < strlen($modStr); $i++){
        $now = (int)$modStr[$i];
        $return.=$basicTableCypher[$now];
      }
      $return.=$separators[rand(0,count($separators)-1)];
      $return.=$basicTableCypher[$ifSum];
      $return.=$separators[rand(0,count($separators)-1)];
      $return.=$basicTableCypher[$option];
      $return.=$separators[rand(0,count($separators)-1)];
      return $return;
    }
}

?>
