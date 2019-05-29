<?php
    namespace App\DAO;
    use App\DB;
    //Essa classe contem metodos básicos usados por todas as classes DAO.
    class DAO extends DB{
        
        protected $DB;
        
        protected function Insert($tabela, $colunas, $valores){
            
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

            return $this->DB;
        }
        
        protected function Update($tabela, $coluna, $condicao, $where, $limit = 1){
            
        }
        
        protected function Delete($tabela, $condicao, $limit = 1){
            
        }
        
    }