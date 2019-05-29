<?php
    //é o caminho até este arquivo.
    namespace Src\Classes;
    
    class ClassRoutes {
        //atributo que receberá um array.
        private $route;
        //contem uma funcao que retorna um array da URL
        use \Src\Traits\TraitUrlParser;
        //metodo para retornar o controller baseado na url (array[0])
        public function getRoute(){
            //passa o array para a $url
            $url = $this->parseUrl();
            //recupera o valor do primeiro indice
            $i = $url[0];
                       
            $this->route = array(
                //Controladores de telas e funcoes de usuários logados
                "Admin"         => "ControllerAdministrador",
                "Diretoria"     => "ControllerDiretoria",
                "Coordenador"   => "ControllerCoordenador",
                "Professor"     => "ControllerProfessor",
                "Aluno"         => "ControllerAluno",
                //Controladores de telas e funcoes publicas,Cada controlador é 
                //referente a um item no menu, os itens em submenu são seus métodos
                "Cursos"        => "ControllerCursos",
                "Escola"        => "ControllerEscola",
                "Direcao"       => "ControllerDirecao",
                "Secretaria"    => "ControllerSecretaria",
                "TCC"           => "ControllerTCC",
                "Noticia"       => "ControllerNoticia",
                "Home"          => "ControllerHome",
                //Controlador de login e logout
                'Auth'         => 'ControllerAuth'
            );
            //o caminnho que o usuário está chamando existe na lista acima?
            if(array_key_exists($i, $this->route)){
                //o arquivo desse controller existe?
                if(file_exists(DIR_CONTROLLER.$this->route[$i].".php")){
                    //retorne o nome do controller
                    return $this->route[$i];
                }else{
                    //senao existir o arquivo, retorna para a tela inicial.
                   header("Location: ". DIR_PAGE.'Home');
                }
            //se nao existir essa rota na lista...
            }else{
                //retorna para a tela inicial
                header("Location: ". DIR_PAGE.'Home');
            }
        }
    }