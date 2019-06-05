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
        
        protected function Select($tabela, $colunas, $condicao, $ordenar = false, $alcance = false, $join = false){

            $sql = "SELECT $colunas FROM $tabela ";

            if($join){
                foreach($join as $key => $info){
                    $sql .= " JOIN $key['nm_tab1'] ON $key['nm_tab1'].$key['col_tab1'] = $key['nm_tab2'].$key['col_tab2'] ";
                }
            }

            $sql .= "WHERE $condicao"; 

            if($ordenar){
                $sql .= " ORDER BY $ordenar ";
            }
            
            if($alcance){
                $sql .= " LIMIT $alcance ";
            }

            return $sql;

            $this->DB = $this->connectDB()->prepare($sql);
            $this->DB->execute();
            if($this->DB->rowCount() > 0){
                while($fetch = $this->DB->fetch(\PDO::FETCH_ASSOC)){
                    $this->res[] = $fetch;
                }
            }

            // return $this->res;
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