<?php
    namespace Src\Classes;
    
    class ClassRender {
        //define o diretório base
        private $dirBase;
        //define o diretório dos arquivos da página
        private $dir;
        //define o titulo da página
        private $title;
        //define as palavras chave da página
        private $keywords;
        //define a descrição da página
        private $description;
        //array para valores especificos das páginas
        public $list = [];
        //estrutura básica da página
        private $head;
        private $header;
        private $main;
        private $footer;
        //Getters ===============================================================================
        public function getDirBase(){ return $this->dirBase; }
        public function getDir(){ return $this->dir; }
        public function getTitle(){ return $this->title; }
        public function getKeywords(){ return $this->keywords; }
        public function getDescription(){ return $this->description; }
        //Setters ===============================================================================
        public function setDirBase($dirBase){ $this->dirBase = $dirBase; }
        public function setDir($dir){ $this->dir = $dir; }
        public function setTitle($title){ $this->title = $title; }
        public function setKeywords($keywords){ $this->keywords = $keywords; }
        public function setDescription($description){ $this->description = $description; }
        
        public function Renderizar(){
            //chama o arquivo principal
            require_once DIR_REQ ."App/View/Layout.php";
        }
        //verifica se tem conteudo para adicionar no head
        public function addHead(){
            
           if(file_exists(DIR_REQ."App/View/".$this->getDirBase()."/".$this->getDir()."/head.php")){
                include_once DIR_REQ."App/View/".$this->getDirBase()."/".$this->getDir()."/head.php";
           }
        }

        //verifica se tem conteudo para adicionar no header
        public function addHeader(){
            //verifica se existe um arquivo header.php na pasta
            if(file_exists(DIR_REQ."App/View/".$this->getDirBase()."/".$this->getDir()."/header.php")){
                //se ele existir, da um include
                include_once DIR_REQ."App/View/".$this->getDirBase()."/header.php";
                /**
                 * Opcional: deixar um header para cada usuário em vez de um header por tela
                 * isso pode ser util se tiver mais de 1 menu exemplo:
                 * menu de visitante(headerBase), menu de aluno, menu de professor, etc...
                 */
                //include_once DIR_REQ."App/View/".$this->getDirBase()."/header.php";
            }else{
                //se nao existir, inclui o header base
                include_once DIR_REQ."App/View/headerBase.php";
            }
            
        }
        //verifica se tem conteudo para adicionar no main
        public function addMain(){
           if(file_exists(DIR_REQ."App/View/".$this->getDirBase()."/".$this->getDir()."/main.php")){
                include_once DIR_REQ."App/View/".$this->getDirBase()."/".$this->getDir()."/main.php";
           } 
        }
        //verifica se tem conteudo para adicionar no footer
        public function addfooter(){
           if(file_exists(DIR_REQ."App/View/".$this->getDirBase()."/".$this->getDir()."/footer.php")){
                include_once DIR_REQ."App/View/".$this->getDirBase()."/".$this->getDir()."/footer.php";
           }else{
                include_once DIR_REQ."App/View/footerBase.php";
           }
        }
    }