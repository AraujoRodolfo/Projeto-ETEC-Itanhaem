<?php
    namespace App\DAO;
    
    use App\DAO\DAO;
    
    class visitanteDAO extends DAO{
        //
        public function listaNoticias($qtd = null){
            
            $sql = "SELECT * FROM usuario ORDER BY nm_usuario desc";
            if($qtd != null){
                $sql .= " LIMIT 1, :qtd";
            }
            $this->DB  = $this->connectDB()->prepare($sql);
            $this->DB->bindParam(":qtd",$qtd,\PDO::PARAM_INT);
            
            if($this->DB->execute()){
                $arr = [0 =>["Titulo"  => "Bla bla bla",
                         "Chamada"   => "Uma coisa interessante aqui",
                         "Data"      => "12-13-4984",
                         "Texto"     => "lorem   loren lorem n funciona aqui"
                        ],
                        1 =>["Titulo"   => "Bla bla bla",
                         "Chamada"   => "Uma coisa interessante aqui",
                         "Data"      => "12-13-4984",
                         "Texto"     => "lorem   loren lorem n funciona aqui"
                       ]
                 ];
                 return $arr;
            }
            return;
        }
        //lista a informação de uma noticia especifica
        public function getNoticia($id){
            
        }
        
        public function listaEventos(){
            
        }
        
        public function listaCursos(){
            
        }
        
        public function listaUtilidades(){
            
        }
        
        public function listaLinks(){
            
        }
    }