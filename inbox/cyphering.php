<?php

class Cypher{
    public function __construct(){
      if(!function_exists("basic")){
        include "mainTables.php";
      }
      
    }
    function toDelta($text,$modulo,$ifSum,$option){
      if(strlen($text) > 150)
      {
        //echo strlen($text)."<br><br>";
        $cypher = "";
        for($i = 0 ; $i < strlen($text); $i+=100)
        {
          if($i + 100  < strlen($text))
          {
            $forNowText = substr($text,$i,100);
            //echo strlen($forNowText)." ".$i." ".($i+100)."<br>";
            $cypher.=($this->toDelta($forNowText,$modulo,$ifSum,$option))."k";
          }
          else {
            $forNowText = substr($text,$i,(strlen($text)-$i));
            /*echo strlen($forNowText)." ".$i." ".($i+100)."<br>";*/
            $cypher.=($this->toDelta($forNowText,$modulo,$ifSum,$option));
          }
        }
        return $cypher;
      }
      else {
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
        $basicTableCypher = basic()[0];
        $separators = basic()[1];
        $falseSeq = basic()[2];
        $ifBig = false;
        for($i = 0 ; $i < strlen($text); $i++)
        {
          $where = ord($text[$i]);
          //if($text[$i] == "&") echo $where." ";
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
              if(rand(0,10) == 5)
              {
                $cypher.="f";
                for($k = 0; $k < rand(20,50); $k++)
                {
                  $cypher.=$basicTableCypher[rand(0,8)];
                }
                $cypher.="f";
              }
              else {
                $cypher.=$separators[rand(0,count($separators)-1)];
              }

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
              if(rand(0,10) == 5)
              {
                $cypher.="f";
                for($k = 0; $k < rand(20,50); $k++)
                {
                  $cypher.=$basicTableCypher[rand(0,8)];
                }
                $cypher.="f";
              }
              else {
                $cypher.=$separators[rand(0,count($separators)-1)];
              }

            }
          }
          else if ($where < 127){
            //if($where == 38) echo "jest ";
            $where = array_search($text[$i],$explainonalpha);
            //echo $where."<br>";
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
            ////echo $letter."<br>";
            for($j = 0 ; $j < strlen($letter); $j++){
              $now = (int)$letter[$j];
              $ret.=$basicTableCypher[$now];
            }
            $cypher.=$ret;
            if($i != strlen($text)-1)
            {
              if(rand(0,10) == 5)
              {
                $cypher.="f";
                for($k = 0; $k < rand(20,50); $k++)
                {
                  $cypher.=$basicTableCypher[rand(0,8)];
                }
                $cypher.="f";
              }
              else {
                $cypher.=$separators[rand(0,count($separators)-1)];
              }

            }
          }
          else {
            $where = ord($text[$i]);
            $where*=$where;
            //echo $text[$i];
            //echo $where;
            if(in_array($where,$table))
            {
              //echo "jest w glownej";
              break;
            }
            else if(in_array($where,$uppers)){
              //echo "jest w uppers";
            }
            else if(in_array($where,$nonalpha)){
              //echo "jest w non";
              break;
            }
            else if($text[$i] != ""){
              //echo " można <br>";
              $ret = "";
              $letter = (String)$where;
              ////echo $letter."<br>";
              for($j = 0 ; $j < strlen($letter); $j++){
                $now = (int)$letter[$j];
                $ret.=$basicTableCypher[$now];
              }
              $cypher.=$ret;
              if($i != strlen($text)-1)
              {
                if(rand(0,10) == 5)
                {
                  $cypher.="f";
                  for($k = 0; $k < rand(20,50); $k++)
                  {
                    $cypher.=$basicTableCypher[rand(0,8)];
                  }
                  $cypher.="f";
                }
                else {
                  $cypher.=$separators[rand(0,count($separators)-1)];
                }

              }
            }

          }
          if($modNow > 100)
          {
            $modNow = 0;
          }
        }
        return $cypher;
      }

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
