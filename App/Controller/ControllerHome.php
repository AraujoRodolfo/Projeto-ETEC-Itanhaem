<?php
    namespace App\Controller;
    
    use Src\Classes\ClassRender;
    use App\Controller\Controller;
    use App\DAO\PostDAO;
    use App\Model\ModelPost;
    
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
            //$render->list +=["ultimas noticias"     => $postDAO->selectPosts(3)];
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
        
    }