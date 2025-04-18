<?php
	namespace App\Model;
	use App\Model\Model;
	use App\Model\ModelUsuario;

	class ModelPost extends Model {

		private $id;
		//objeto com os dados do autor do post
		private $autor;
		//caso esteja atualizando um post que ja foi criado
		private $idPost;
		private $titulo;
		private $descricao;
		private $dtPost;
		private $status;
		private $tipo;
		/**
		 * 	caso esteja programado para aparecer no site a partir de determinado dia ou horario
		 *	este campo deverá receber a data-hora.
		 */
		private $programado;
		//recebe o caminho de anexos (imagens ou documentos)
		private $anexo = [];

		//Getters
		public function getId(){ return $this->id; }
		public function getAutor(){ return $this->autor; }
		public function getIdPost(){ return $this->idPost; }
		public function getTitulo(){ return $this->titulo; }
		public function getDescricao(){ return $this->descricao; }
		public function getDtPost(){ return $this->dtPost; }
		public function getStatus(){ return $this->status; }
		public function getTipo(){ return $this->tipo; }
		public function getProgramado(){ return $this->programado; }
		public function getAnexo(){ return $this->anexo; }
		
		//Setters
		public function setId(int $id ){ $this->id = $id; }
		public function setAutor( ModelUsuario $autor ){ $this->autor = $autor; }
		public function setIdPost(int $idPost){ $this->idPost = $idPost; }
		public function setTitulo($titulo){ $this->titulo = $titulo; }
		public function setDescricao($descricao){ $this->descricao = $descricao; }
		public function setDtPost($dt){ $this->dtPost = $dt; }
		public function setStatus($status){ $this->status = $status; }
		public function setTipo($tipo){ $this->tipo = $tipo; }
		public function setProgramado($programado){ $this->programado = $programado; }
		public function setAnexo($anexo){ $this->anexo[] = $anexo; }

	}