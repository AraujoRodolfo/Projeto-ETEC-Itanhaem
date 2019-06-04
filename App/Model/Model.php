<?php
    namespace App\Model;
    //classe generica para as outras herdarem
    class Model {
    	protected $excessoes;
    	
        use \Src\Traits\TraitCrypt;

        public function encryptAll(){
			foreach(get_object_vars($this) as $key => $value){
				//se o atributo nao existir no array de excessoes, encripte.
				if(!in_array($key,$this->excessoes)){
					$this->$key = $this->encrypt($value,CRYPT_KEY);
				}
			}
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