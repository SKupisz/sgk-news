<?php
class Encrypt{
  public $alfa;
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
  public function goBack($alfa){
    $decrypt = "";
    $table = explode(" ",$alfa);
    for($i = 0 ; $i < count($table); $i++)
    {
      $code = (int) $table[$i];
      $code = sqrt($code);
      $code-=1;
      $decrypt.=chr($code);
    }
    return $decrypt;
  }
}
