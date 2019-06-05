<?php
    namespace Src\Traits;
    
    trait TraitCrypt {
        
        public function encrypt($string, $key) {
            $result = '';
            for($i = 0; $i<strlen($string); $i++) {
                $char = substr($string, $i, 1);
                $keychar = substr($key, ($i % strlen($key))-1, 1);
                $char = chr(ord($char)+ord($keychar));
                $result.=$char;
            }
            return base64_encode($result);
        }
        
        public function decrypt($string, $key) {
            $result = '';
            $string = base64_decode($string);
        
          for($i=0; $i<strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)-ord($keychar));
            $result.=$char;
          }
          return $result;
        }

        public function decryptAll(){
            foreach(get_object_vars($this) as $key => $value){
                //se o atributo nao existir no array de excessoes, decripte.
                if(!in_array($key,$this->excessoes)){
                    $this->$key = $this->decrypt($value,CRYPT_KEY);
                }
            }
        }
    }