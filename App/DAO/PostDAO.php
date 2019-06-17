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
			$colunas 	= "id_post,nm_post, ds_post, dt_post, ds_tipo ,programado,";
			//dados da tabela de usuarios
			$colunas	.= " nm_usuario, nm_img_perfil ";
			//array com as tabelas que deverão se juntar na query (JOIN)
			$join = [0 =>	[
				'nm_tab1' 	=> 'usuario',
				'nm_tab2'	=>	'post',
				'col_tab1' 	=> 'id_usuario',
				'col_tab2' 	=> 'id_usuario']
			];
			//condiçao para a query
			$condicao	= 'ic_status = "ativo"';
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
					$ret[$i]->setId( $res[$i]['id_post'] );
					$ret[$i]->setTitulo( $this->decrypt($res[$i]['nm_post'], CRYPT_KEY) );
					$ret[$i]->setDescricao($this->decrypt($res[$i]['ds_post'], CRYPT_KEY) );
					$ret[$i]->setDtPost($res[$i]['dt_post']);
					$ret[$i]->setProgramado($res[$i]['programado']);
					//cria um objeto Usuario e insere nele as informações referentes a ele
					$autor = new ModelUsuario();
					$autor->setNome($this->decrypt($res[$i]['nm_usuario'], CRYPT_KEY));
					$autor->setFoto($this->decrypt($res[$i]['nm_img_perfil'], CRYPT_KEY));
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
			$cols 	 = 'id_post';
			$cols 	.= ', id_update_post';
			$cols 	.= ', id_usuario';
			$cols 	.= ', nm_post';
			$cols 	.= ', ds_post';
			$cols 	.= ', dt_post';
			$cols 	.= ', ic_status';
			$cols 	.= ', ds_tipo';
			$cols 	.= ', programado';

			//os valores, devem estar em ordem com os campos da variavel acima
			$valores 	 = "null";
			$valores 	.= ",". $idPost ."";
			$valores 	.= ",". $post->getAutor()->getId() ."";
			$valores 	.= ",'". $this->encrypt($post->getTitulo(),CRYPT_KEY)."'";
			$valores 	.= ",'". $this->encrypt($post->getDescricao(),CRYPT_KEY)."'";
			$valores 	.= ",'". $post->getDtPost() ."'";
			$valores 	.= ",'". $post->getStatus() ."'";
			$valores 	.= ",'". $post->getTipo() ."'";
			$valores 	.= ",". $programado ."";

			//insere os dados e recebe eles encriptados junto cmo a primary key e tudo mais.
			$data_post = $this->Insert($this->tabela,$cols,$valores);
			//se o post for inserido com sucesso, verifica se tem anexos para inserir
			if($data_post['error'] == ""){
				$data_anexo = $this->newAnexo($data_post['data']['id_post'], $post->getAnexo());
				//se os anexos forem inseridos com sucesso, retorna 1
				if($data_anexo['error'] == ""){
					return 1;
				}else{//senao, retorna o erro
					return $data_anexo['error'];
				}

			}else{
				return $data_post['error'];
			}
			
		}

		//metodo para adicionar os anexos do post
		private function newAnexo($id_post, $anexos){
			//monta o caminho para o doretório
			$dir  = DIR_UPLOAD_POST_ANEXOS.$id_post.'/';
			// echo $dir;
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
				// echo "<pre>";
				// print_r($anexos);
				//move a imagem para o toreório
				if(move_uploaded_file($anexos[0]['tmp_name'][$i],$dir.$anexos[0]['name'][$i])){
					//campos da tabela
					$colunas  = 'id_anexo';
					$colunas .= ', id_post';
					$colunas .= ', nm_anexo';
					$colunas .= ', ds_anexo';
					//valores da tabela
					$valores  = "null";
					$valores .= ", ".$id_post;
					$valores .= ",'".$anexos[0]['name'][$i]."'";
					$valores .= ",''";

					//insere o nome da imagem no DB
					$res = $this->Insert($tabela,$colunas,$valores);
					
					if($res['error'] != ""){ return $res['error']; }
				}
			}
		}
	}