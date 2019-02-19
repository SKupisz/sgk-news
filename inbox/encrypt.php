<?php
require_once "cyphering.php";
require_once "decoding.php";
class Encrypt{
  public $alfa;
  public function goWithIt($alfa){
    $base = new Cypher;
    $encrypt = $base->toDelta($alfa,51,1,1);
    return $encrypt;
  }
  /*
  public function goWithIt($alfa){
    $encrypt = "";
    for($i = 0 ; $i < strlen($alfa); $i++)
    {
      $code = ord($alfa[$i]);
      $code+=1;
      $code = $code*$code;
      $al = (String) $code;
      $encrypt.=$al." ";
    }
    return $encrypt;
  }
  */
  public function goBack($alfa){
    $decrypt = "";
    $table = explode(" ",$alfa);
    if(count($table) == 1)
    {
      $base = new Decode;
      $decrypt = $base->toNormal($alfa);
      echo $decrypt;
    }
    else {
      for($i = 0 ; $i < count($table); $i++)
      {
        $code = (int) $table[$i];
        $code = sqrt($code);
        $code-=1;
        $decrypt.=chr($code);
      }
    }

    return $decrypt;
  }
}
