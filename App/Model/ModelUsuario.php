<?php 	
	namespace App\Model;

	use App\Model\Model;

	class ModelUsuario extends Model {
		private $id;
		private $nome;
		private $email;
		private $senha;
		private $tipo;

		//GETTERS
		public function getId(){ return $this->id; }
		public function getNome(){ return $this->nome; }
		public function getEmail(){ return $this->email; }
		public function getSenha(){ return $this->senha; }
		public function getTipo(){ return $this->tipo; }

		//SETTERS
		public function setId(int $id){
			if($id > 0){
				$this->id = $id;	
			}
		}

		public function setNome($nome){
			if(preg_match('/^[a-zA-Z]{2,}$/', $nome)){
				$this->nome = $nome;
			}
		}

		public function setEmail($email){
    		if(preg_match('/^[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/',$email)){
				$this->email = $email;
			}
		}

		public function setSenha($senha){
			if(strlen($senha) >= 6){
				$this->senha = $senha;
			}
		}

		public function setTipo($tipo){
			$this->tipo = $tipo;
		}
	}