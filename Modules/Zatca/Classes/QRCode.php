<?php

namespace Modules\Zatca\Classes;

class QRCode {
   public $result;
   public function __construct($params){

        foreach($params as $key=>$value){
            $tag = $key+1;
            $length = $this->stringLen($value);
            $this->result .= $this->toString($tag,$length,$value);
        }
   }
   public function stringLen($string){
    return strlen($string);
   }
   public function toString($tag,$length,$value){
    return $this->__toHex($tag).$this->__toHex($length).($value);
   }
   function __toHex($value) {
    return pack("H*", sprintf("%02X", $value));
    }
   public function getResult(){
    return $this->result;
   }
   public function toBase64(){
    return base64_encode($this->result);
   }
}