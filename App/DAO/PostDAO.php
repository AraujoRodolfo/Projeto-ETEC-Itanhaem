<?php 
	namespace App\DAO;

	use App\DAO\DAO;
	use App\Model\ModelPost;
	use App\Model\ModelUsuario;

	class PostDAO extends DAO {

		private $tabela = "post";

		public function selectPosts(int $alcance){
			//variavel que irá retornar o resultado
			$ret = false;
			//colunas da tabela post que deverão ser mostrados
			$colunas 	= "titulo, descricao, dt_post, programado,";
			//dados da tabela de usuarios
			$colunas	.= " nome, foto ";
			//array com as tabelas que deverão se juntar na query (JOIN)
			$join = [0 =>	[
				'nm_tab1' 	=> 'usuario',
				'nm_tab2'	=>	'post',
				'col_tab1' 	=> 'id',
				'col_tab2' 	=> 'usuario']
			];
			//condiçao para a query
			$condicao	= 'status_post = "ativo"';
			//ordenar por...
			$ordenar	= "dt_post DESC";
			//chama o metodo Select (metodo da DAO, de quem esta classe é filha)
			$res = $this->Select($this->tabela, $colunas, $join, $condicao, $ordenar, $alcance);
			//se o retorn for um array (se conter 1 resultado ou mais)
			if(is_array($res)){
				//para cada indice no array que retornou...
				for($i = 0; $i < count($res); $i++ ){
					//cria um objeto Post e instancia ele em um indice de 1 array
					$ret[$i] = new ModelPost();
					//insere neste objeto as informações referentes a ele que vieram no array
					$ret[$i]->setTitulo( $this->decrypt($res[$i]['titulo'], CRYPT_KEY) );
					$ret[$i]->setDescricao($this->decrypt($res[$i]['descricao'], CRYPT_KEY) );
					$ret[$i]->setDtPost($res[$i]['dt_post']);
					$ret[$i]->setProgramado($res[$i]['programado']);
					//cria um objeto Usuario e insere nele as informações referentes a ele
					$autor = new ModelUsuario();
					$autor->setNome($this->decrypt($res[$i]['nome'], CRYPT_KEY));
					$autor->setFoto($this->decrypt($res[$i]['foto'], CRYPT_KEY));
					//insere o objeto usuario dentro do atributo autor do post.
					$ret[$i]->setAutor($autor);
				}
			}
			//retorna o resultado
			return $ret;
		}

		public function newPost(ModelPost $post){

			$idPost = 'null';
			$programado = 'null';

			//se este post for atualizacao de um existente, a variavel recebe o id
			if($post->getIdPost() !== null ){ $idPost = $post->getIdPost(); }
			//se este post tiver hora marcada para aparecer, recebe o horario
			if($post->getProgramado() !== null){ $programado = $post->getProgramado(); }

			//os campos que devem receber os valores
			$cols 	 = 'id';
			$cols 	.= ', usuario';
			$cols 	.= ', id_post';
			$cols 	.= ', titulo';
			$cols 	.= ', descricao';
			$cols 	.= ', dt_post';
			$cols 	.= ', status_post';
			$cols 	.= ', programado';

			//os valores, devem estar em ordem com os campos da variavel acima
			$valores 	 = "null";
			$valores 	.= ",". $post->getAutor()->getId() ."";
			$valores 	.= ",". $idPost ."";
			$valores 	.= ",'". $this->encrypt($post->getTitulo(),CRYPT_KEY)."'";
			$valores 	.= ",'". $this->encrypt($post->getDescricao(),CRYPT_KEY)."'";
			$valores 	.= ",'". $post->getDtPost() ."'";
			$valores 	.= ",'". $post->getStatus() ."'";
			$valores 	.= ",". $programado ."";

			//insere os dados e recebe eles encriptados junto cmo a primary key e tudo mais.
			$data_post = $this->Insert($this->tabela,$cols,$valores);

			$this->newAnexo($data_post['id'], $post->getAnexo());
		}

		//metodo para adicionar os anexos do post
		private function newAnexo($id_post, $anexos){
			//monta o caminho para o doretório
			$dir  = DIR_UPLOAD_POST_ANEXOS.$id_post;
			echo $dir;
			//nome da tabela onde os dados do anexo vão ficar
			$tabela = "anexo";
			//conta quantos arquivos foram enviados
			$qtd_files = 0;
			foreach($anexos[0]['name'] as $key => $value){
				if($value != null){
					$qtd_files++;
				}
			}

			//para cada anexo que foi inserido no post
			for($i = 0;$i < $qtd_files; $i++ ){
				//se nao existir o diretorio
				if(!is_dir($dir)){
					//crie o diretorio
					mkdir($dir, 0777);
				}
				echo "<pre>";
				print_r($anexos);
				//move a imagem para o toreório
				if(move_uploaded_file($anexos[0]['tmp_name'][$i],$dir.'/'.$anexos[0]['name'][$i])){
					//campos da tabela
					$colunas  = 'id_anexo';
					$colunas .= ', post';
					$colunas .= ', nome';
					//valores da tabela
					$valores  = "null";
					$valores .= ", ".$id_post;
					$valores .= ",'".$anexos[0]['name'][$i]."'";

					//insere o nome da imagem no DB
					$this->Insert($tabela,$colunas,$valores);
				}
			}
		}
	}