<?php
require_once "cyphering.php";
require_once "decoding.php";
class Encrypt{
  public $alfa;
  private $base;
  public function __construct(){
  }
  public function goWithIt($alfa){
    $base = new Cypher;
    $encrypt = $base->toDelta($alfa,rand(500,5000),1,1);
    unset($base);
    return $encrypt;
  }
  public function goBack($alfa){
    $decrypt = "";
    $table = explode(" ",$alfa);
    if(strpos($alfa," ") == false)
    {
      $base = new Decode;
      $decrypt = $base->toNormal($alfa);
      unset($base);
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
