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

			//$res = $this->Select( $tabela, $colunas, $condicao, $ordenar, $alcance);

			$res = ['teste'];

			// for($i = 0; $i < count($rows); $i++ ){
			// 	$res[$i] = new ModelPost();
			// 	$res[$i]->setTitulo( $rows[$i]['titulo'] );
			// 	// $res[$i]->setDescricao($rows[$i]['descricao']);
			// 	// $res[$i]->setDescricao($rows[$i]['dt_post']);
			// 	// $res[$i]->setProgramado($rows[$i]['programado']);
			// 	$res[$i]->decryptAll();
			// }
			
			return $res;
		}
	}