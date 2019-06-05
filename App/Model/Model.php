<?php
    namespace App\Model;
    //classe generica para as outras herdarem
    class Model {
    	public $excessoes;
    	
        use \Src\Traits\TraitCrypt;
    }