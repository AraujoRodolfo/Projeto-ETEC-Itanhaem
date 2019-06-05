<?php
    namespace App\DAO;
    
    use App\DB;
    //Essa classe contem metodos básicos usados por todas as classes DAO.
    class DAO extends DB{
        
        protected $DB;
        private $res = false;
        
        use \Src\Traits\TraitCrypt;
        
        protected function Insert($tabela, $colunas, $valores){
            $sql = "INSERT INTO $tabela ($colunas) VALUES ($valores)";

            $this->DB = $this->connectDB()->prepare($sql);

            if($this->DB->execute()){
                $this->res = true;
            }

            return $this->res;  
        }
        
        protected function Select($tabela, $colunas, $condicao,$ordenar = null, $alcance = null){

            $sql = "SELECT $colunas FROM $tabela WHERE $condicao ";

            if($ordenar != null){
                $sql .= "ORDER BY $ordenar ";
            }
            
            if($alcance != null){
                $sql .= "LIMIT $alcance";
            }

            $this->DB = $this->connectDB()->prepare($sql);
            $this->DB->execute();
            if($this->DB->rowCount() > 0){
                while($fetch = $this->DB->fetch(\PDO::FETCH_ASSOC)){
                    $this->res[] = $fetch;
                }
            }

            return $this->res;
        }
        
        protected function Update($tabela, $atualizacao, $condicao = 0){
            $sql = "UPDATE $tabela SET $atualizacao WHERE $condicao";

            $this->DB = $this->connectDB()->prepare($sql);

            if($this->DB->execute()){
                $this->res = true;
            }

            return $this->res;  
        }
        
        protected function Delete($tabela, $condicao = 0){

            $sql = "DELETE FROM $tabela WHERE $condicao";

            $this->DB = $this->connectDB()->prepare($sql);

            if($this->DB->execute()){
                $this->res = true;
            }

            return $this->res;
        }
        
    }