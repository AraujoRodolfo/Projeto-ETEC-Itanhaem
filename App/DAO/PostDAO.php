<?php 
	namespace App\DAO;

	use App\DAO\DAO;
	use App\Model\ModelPost;

	class PostDAO extends DAO {

		public function selectPosts(int $qtd){
			$tabela 	= "post";
			$colunas 	= "titulo, descricao, dt_post, programado";
			$condicao	= 'status = "ativo"' ;
			$ordenar	= "dt_post DESC";
			$alcance 	= $qtd;

			$res = $this->Select( $tabela, $colunas, $condicao, $ordenar, $alcance);

			for($i = 0; $i < count($res); $i++ ){
				$obj[$i] = new ModelPost();
				$obj[$i]->setTitulo( $res[$i]['titulo'] );
				$obj[$i]->setDescricao($res[$i]['descricao']);
				$obj[$i]->setDescricao($res[$i]['dt_post']);
				$obj[$i]->setProgramado($res[$i]['programado']);
				$obj[$i]->decryptAll();
			}
			
			return $obj;
		}
	}