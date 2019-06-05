<?php 
	namespace App\DAO;

	use App\DAO\DAO;
	use App\Model\ModelPost;
	use App\Model\ModelUsuario;

	class PostDAO extends DAO {

		public function selectPosts(int $qtd){
			$tabela 	= "post";
			//dados da tabela de posts
			$colunas 	= "titulo, descricao, dt_post, programado,";
			//dados da tabela de usuarios
			$colunas	.= " nome, foto ";

			$join = [0 =>	[
				'nm_tab1' 	=> 'usuario',
				'nm_tab2'	=>	'post',
				'col_tab1' 	=> 'id',
				'col_tab2' 	=> 'id']
			];

			$condicao	= 'status_post = "ativo"';
			$ordenar	= "dt_post DESC";
			$alcance 	= $qtd;

			$res = $this->Select( $tabela, $colunas, $join, $condicao, $ordenar, $alcance);

			for($i = 0; $i < count($res); $i++ ){
				$obj[$i] = new ModelPost();
				$obj[$i]->setTitulo( $this->decrypt($res[$i]['titulo'], CRYPT_KEY) );
				$obj[$i]->setDescricao($this->decrypt($res[$i]['descricao'], CRYPT_KEY) );
				$obj[$i]->setDtPost($res[$i]['dt_post']);
				$obj[$i]->setProgramado($res[$i]['programado']);

				$user = new ModelUsuario();
				$user->setNome($this->decrypt($res[$i]['nome'], CRYPT_KEY));
				$user->setFoto($this->decrypt($res[$i]['foto'], CRYPT_KEY));

				print_r($user);

				$obj[$i]->setUser($user);
			}
			
			return $obj;
		}
	}