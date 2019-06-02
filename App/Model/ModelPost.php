<?php
	namespace App\Model;
	use App\Model\Model;

	class ModelPost extends Model {

		private $id;
		//id do usuario que criou o post
		private $idUser;
		//caso esteja atualizando um post que ja foi criado
		private $idPost;
		private $titulo;
		private $descricao;
		private $dtPost;
		private $status;
		/**
		 * 	caso esteja programado para aparecer no site a partir de determinado dia ou horario
		 *	este campo deverá receber a data-hora.
		 */
		private $programado;
		//recebe o caminho de anexos (imagens ou documentos)
		private $anexo = [];

		//Getters
		public function getId(){ return $this->id; }
		public function getIdUser(){ return $this->idUser; }
		public function getIdPost(){ return $this->idPost; }
		public function getTitulo(){ return $this->titulo; }
		public function getDescricao(){ return $this->descricao; }
		public function getDtPost(){ return $this->dtPost; }
		public function getStatus(){ return $this->status; }
		public function getProgramado(){ return $this->programado; }
		public function getAnexo(){ return $this->anexo; }
		
		//Setters
		public function setId(int $id ){ $this->id = $id; }
		public function setIdUser(int $idUser ){ $this->idUser = $idUser; }
		public function setIdPost(int $idPost){ $this->idPost = $idPost; }
		public function setTitulo($titulo){ $this->titulo = $titulo; }
		public function setDescricao($descricao){ $this->descricao = $descricao; }
		public function setDtPost($dt){ $this->dtPost = $dt; }
		public function setStatus($status){ $this->status = $status; }
		public function setProgramado($programado){ $this->programado = $programado; }
		public function setAnexo($anexo){ $this->anexo = $anexo; }

		public function encryptAll(){
			$excessoes = ['anexo' => 1,'dtPost' => 1,'programado' => 1];
			array_values()

			foreach(get_object_vars($this) as $key => $value){
				//se o atributo nao existir no array de excessoes, encripte.
				if(!in_array($key,$excessoes)){
					$this->$key = $this->encrypt($value,CRYPT_KEY);
				}
			}
		}

		public function decryptAll(){
			$excessoes = ['anexo' => 1,'dtPost' => 1,'programado' => 1];

			foreach(get_object_vars($this) as $key => $value){
				//se o atributo nao existir no array de excessoes, decripte.
				if(!in_array($key,$excessoes)){
					$this->$key = $this->decrypt($value,CRYPT_KEY);
				}
			}
		}

	}