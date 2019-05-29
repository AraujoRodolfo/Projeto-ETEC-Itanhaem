<?php 
	namespace App\DAO;

	use App\Model\ModelPost;

	class PostDAO extends DAO {

		public function selectPosts(int $qtd){
			$tabela 	= "post";
			$colunas 	= "*";
			$condicao	= 'status = "ativo"' ;
			$ordenar	= "dt_post DESC";
			$alcance 	= $qtd;

			$res = $this->Select( $tabela, $colunas, $condicao, $ordenar, $alcance);

			foreach($res as $key => $value){
				//
			}
		}
	}