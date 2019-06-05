<?php 
	namespace App\DAO;

	use App\DAO\DAO;
	use App\Model\ModelPost;

	class PostDAO extends DAO {

		public function selectPosts(int $qtd){
			$tabela 	= "post";
			//dados da tabe de posts
			$colunas 	= "titulo, descricao, dt_post, programado,";
			//dados da tabela de usuarios
			$colunas	.= " nome, foto ";

			$join = [0 =>	[
				'nm_tab1' 	=> 'usuario',
				'nm_tab2'	=>	'post',
				'col_tab1' 	=> 'id',
				'col_tab2' 	=> 'id']
			];

			$condicao	= 'status = "ativo"';
			$ordenar	= "dt_post DESC";
			$alcance 	= $qtd;

			echo $join[0]['nm_tab1'];
			return $join;

			$res = $this->Select( $tabela, $colunas, $condicao, $ordenar, $alcance, $join);

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