<?php
    namespace App\Controller;
    
    use Src\Classes\ClassRender;
    use App\Controller\Controller;
    use App\DAO\PostDAO;
    use App\Model\ModelPost;
    use App\Model\ModelUsuario;
    use Src\Classes\ClassEmail;
        
    class ControllerHome extends Controller{

        private $dirbase = 'Home';
        
        public function __construct(){
            //se nao estiver chamandon nenhum metodo(tela)
            if(count($this->parseUrl()) == 1 ){
                //chama o metodo do index
                $this->index();
            }
        }

        public function index(){
            //MODEL ===========================================================
            $postDAO = new PostDAO();
            
            //VIEW ============================================================
            $render = new ClassRender();
            $render->setTitle('Ensino Médio e Técnico gratuito em Itanhaém');
            $render->setDescription("Etec Itanhaém");
            $render->setKeywords("Etec, itanhaém, gambiarra");
            $render->setDirBase($this->dirbase);
            $render->setDir('index');
            //informações que deverão aparecer na página vindas do DB
            $render->list +=["ultimas noticias"     => $postDAO->selectPosts(3)];
            $render->list +=["eventos e atividades" => ''];
            $render->list +=["ensino tecnico"       => ''];
            $render->list +=["etim"                 => ''];
            $render->list +=["corpo docente"        => ''];
            $render->list +=["links e utilidades"   => ''];

            $render->renderizar();
        }

        public function corpo_docente(){
            echo "corpo decente";
        }

        public function coordenacao(){
            echo "coordenadas";
        }

        public function contato(){
            echo "contato de 4º grau";
        }

        //metodo para testar disparos de email via PHPMailer
        public function enviarEmail(){
            $usuario = new ModelUsuario();
            $usuario->setNome("Jhonatan da Costa Santos");
            $usuario->setEmail("jdc_santos@outlook.com");
            $usuario->setRedefinePwUrl('937498374847');

            $arr[] = $usuario;

            $email = new ClassEmail($arr);
            $email->Conteudo_redefinirSenha();
            $email->enviar();
        }

        //metodo de teste de inserção de posts + anexos
        public function newPost(){

            if(isset($_POST['newPost']) && $_POST['newPost'] === $_SESSION['form_key']){

                $autor = new ModelUsuario();
                $autor->setId(1);

                $post = new ModelPost();
                $post->setAutor($autor);
                $post->setTitulo($_POST['titulo']);
                $post->setDescricao($_POST['descricao']);
                $post->setDtPost(date('Y-m-d h:i:s'));
                $post->setStatus($_POST['status']);
                $post->setTipo($_POST['tipo']);

                //formatar horario programado
                $dthr = null;
                if(isset($_POST['marcada'])){
                    $dthr  = $_POST['dataMarcada'];
                    $dthr .= ' '. $_POST['hora'];
                    $dthr .= ':'. $_POST['min'];
                    $dthr .= ':'. $_POST['seg'];
                }

                $post->setProgramado($dthr);

                if(isset($_FILES)){
                    foreach($_FILES as $key => $anexo){
                        $post->setAnexo($_FILES['anexo']);
                    }    
                }
                

                $postDAO = new PostDAO();
                $res = $postDAO->newPost($post);

                print_r($res);

            }else{
                $_SESSION['form_key'] = md5('Y-M-d h:s:i');

                $render = new ClassRender();
                $render->setTitle('Ensino Médio e Técnico gratuito em Itanhaém');
                $render->setDescription("Etec Itanhaém");
                $render->setKeywords("Etec, itanhaém, gambiarra");
                $render->setDirBase($this->dirbase);
                $render->setDir('new_post');
                $render->renderizar();
            }
        }
    }