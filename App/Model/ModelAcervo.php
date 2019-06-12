<?php
	namespace App\Model;

	use App\Model\Model;
	
	class Acervo extends Model{
		
		private $id;
		private $disciplina;
		private $nome;
		private $descricao;
		private $disponivel;
		//materia na qual o projeto foi desenvolvido
		private $disciplina;
		//array com os autores (alunos e professor) 
		private $autores;

		public function getId(){ return $this->id; }
		public function getDisciplina(){ return $this->disciplina; }
		public function getNome(){ return $this->descricao; }
		public function getDisponivel(){ return $this->disponivel; }

		public function setId(int $id){ $this->id = $id; }
		public function setDisciplina($disciplina){ $this->disciplina = $disciplina; }
		public function setDescricao($descricao){ $this->descricao = $descricao; }
		public function setDisponivel($disponivel){ $this->disponivel = $disponivel; }
	}