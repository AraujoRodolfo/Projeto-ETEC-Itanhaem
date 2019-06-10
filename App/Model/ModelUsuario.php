<?php 	
	namespace App\Model;

	use App\Model\Model;

	class ModelUsuario extends Model {
		private $id;
		private $turma;
		private $nome;
		private $email;
		private $senha;
		private $dtNascimento;
		private $foto;
		private $redefinePwUrl;
		private $dtCriacaoConta;
		private $dtAtualizacaoConta;
		private $hrAtendimento;
		private $social;
		private $status;
		private $ip;
		private $ultimoAcesso;
		//tabela grupo
		private $tipo;
		//GETTERS
		public function getId() { return $this->id; }
		public function getTurma() { return $this->turma; }
		public function getNome() { return $this->nome; }
		public function getEmail() { return $this->email; }
		public function getSenha() { return $this->senha; }
		public function getDtNascimento(){ return $this->dtNascimento; }
		public function getFoto() { return $this->foto; }
		public function getRedefinePwUrl(){ return $this->redefinePwUrl; }
		public function getdtCriacaoConta(){ return $this->dtCriacaoConta; }
		public function getDtAtualizacaoConta(){ return $this->dtAtualizacaoConta; }
		public function getHrAtendimento(){ return $this->hrAtendimento; }
		public function getSocial(){ return $this->social; }
		public function getStatus(){ return $this->status; }
		public function getIp(){ return $this->ip; }
		public function getUltimoAcesso(){ return $this->ultimoAcesso; }

		public function getTipo() { return $this->tipo; }

		//SETTERS
		public function setId(int $id){
			if($id > 0){
				$this->id = $id;	
			}
		}
		public function setTurma($turma){ $this->turma = $turma; }
		public function setNome($nome){
			// if(preg_match('/^[a-zA-Z]{2,}$/', $nome)){
				$this->nome = $nome;
			// }
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
		public function setDtNascimento($dtNascimento){ $this->dtNascimento = $dtNascimento; }
		public function setFoto($foto){
			$tipos = ['image/jpg','image/pnj','image/jpeg','image/PNG'];
			if(isset($foto['type'])){
				if(in_array($foto['type'],$tipos)){
					$this->foto = $foto;
				}
			}	
		}
		public function setCriacaoConta(){ $this->dtCriacaoConta = date('Y-m-d h:i:s'); }
		public function setDtAtualizacaoConta(){ $this->dtCriacaoConta = date('Y-m-d h:i:s'); }
		public function setHrAtendimento($hrAtendimento){ $this->hrAtendimento = $hrAtendimento; }
		public function setSocial($social){ $this->social = $social; }
		public function setStatus($status){ $this->status = $status; }
		public function setIp(){ $this->ip = $_SERVER['REMOTE_ADDR']; }
		public function setRedefinePwUrl($url){	$this->redefinePwUrl = $url; }
		public function setTipo($tipo){ $this->tipo = $tipo; }
	}