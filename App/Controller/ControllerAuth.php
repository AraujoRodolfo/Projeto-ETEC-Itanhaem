<?php
    namespace App\Controller;
    
    use App\DAO\AuthDAO;
    use App\Model\ModelUsuario;
    use App\Controller\Controller;
    use Src\Classes\ClassRender;
    
    class ControllerAuth extends Controller{
        
        public function login(){
            
           // if(isset($_POST['algumacoisa'])){
                $usuario = new ModelUsuario();
                $usuario->setEmail("jhonatan@exemplo.com");
                $usuario->setSenha('w32324312');
                echo "<pre>";
                echo "antes de validar<br>";
                print_r($usuario);
                $authDAO = new AuthDAO();

                if($authDAO->validar($usuario)){
                    $this->carregarSessao($usuario);
                }
                unset($authDAO);
                unset($usuario);
            // }
        }

        private function carregarSessao(ModelUsuario $usuario){
            $authDAO = new AuthDAO();
            echo "depois de carregar os dados<br>";
            $_SESSION['usuario'] = $authDAO->carregarDadosUsuario($usuario);
            print_r($_SESSION['usuario']);
            unset($authDAO);

            //header('Location: '$_SESSION['usuario']->getTipo().'Home');
        }
        
        public function logout($usuario){
            $loginDAO =  new LoginDAO();
            $loginDAO->encerrarSessao($usuario);
        }
    }