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
				$obj[$i]->setTitulo( $this->decrypt($res[$i]['titulo'],CRYPT_KEY) );
				$obj[$i]->setDescricao($this->decrypt($res[$i]['descricao'],CRYPT_KEY) );
				$obj[$i]->setDtPost($res[$i]['dt_post']);
				$obj[$i]->setProgramado($res[$i]['programado']);
			}
			
			return $obj;
		}
	}