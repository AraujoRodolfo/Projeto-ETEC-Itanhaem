<?php
    namespace App\DAO;
    
    use App\DB;
    //Essa classe contem metodos básicos usados por todas as classes DAO.
    class DAO extends DB{
        
        private $DB;
        
        use \Src\Traits\TraitCrypt;
        
        //metodo para insert, todo insert do sistema passa por este metodo
        protected function insert($tabela, $colunas, $valores){
            //monta a query
            $sql = "INSERT INTO $tabela ({$colunas}) VALUES ({$valores})";
            //tenta executar o trecho de codigo
            try{

                $this->DB = $this->connectDB()->prepare($sql);
                $this->DB->execute();

                //transforna a variavel $colunas em array, separando onde tem virgula
                $cols = explode(",",$colunas);

                /* chama o metodo privado para puxar o ultimo registro da tabelas
                 * a primeira coluna é sempre o ID da linha
                 * por isso pegamos o indice 0 do array
                 * retorna o array com os campos (encriptados)
                 */
                return $this->returnLastInsert( $tabela, $cols[0]);

            //se nao conseguir executar o codigo acima, captura o erro
            }catch(\PDOException $e){
                //mostra o erro
                print_r($e);
            } 
        }
        //metodo para retornar o ultimo registro inserido.
        private function returnLastInsert($tabela, $col){
            $sql = "SELECT * FROM $tabela ORDER BY $col DESC LIMIT 1";
            $this->DB = $this->connectDB()->prepare($sql);
            $this->DB->execute();
            $fetch = $this->DB->fetch(\PDO::FETCH_ASSOC);
            return $fetch;
        }
        
        protected function Select($tabela, $colunas, $join = false,
            $condicao = false, $ordenar = false, $alcance = false){

            $res = false;
            //começa montando a query apenas com as colunas e o nome da tabela
            $sql = "SELECT $colunas FROM $tabela ";
            //se tiver tabelas para "juntar"...
            if($join){
                //percorre o array e concatena elas na variavel $sql
                foreach($join as $key => $info){
                    /* se o tipo de JOIN for especificado, a váriavel $join recebe o valor
                     * senao, o a váriavel $join recebe JOIN como valor padrão
                     */
                    $join = isset($info['tipo_join'])? $info['tipo_join'] : "JOIN";
                    //aqui é contatenado na variavel $sql as informações do join.
                    $sql .= " {$join} {$info['nm_tab1']} ON {$info['nm_tab1']}.{$info['col_tab1']} = {$info['nm_tab2']}.{$info['col_tab2']}";
                }
            }
            //se houver condição para o select, adiciona a condição na query.
            if($condicao){ $sql .= " WHERE $condicao "; }
            //se houver uma ordenação no select, a adiciona na query.
            if($ordenar){ $sql .= " ORDER BY $ordenar "; }
            //se houver um limite para a quantidade de linhas selecionadas, a adiciona na query.
            if($alcance){ $sql .= " LIMIT $alcance "; }
            //o atributo DB recebe a conexao com o DB e prepara a query
            $this->DB = $this->connectDB()->prepare($sql);
            //executa a query.
            $this->DB->execute();
            //se a query retornar 1 ou mais linhas...
            if($this->DB->rowCount() > 0){
                //enquanto houver "linha", adicione o conteudo dela no array $res;
                while($fetch = $this->DB->fetch(\PDO::FETCH_ASSOC)){
                    //cada "linha" que retornar da query, é inserida em um novo indice do array.
                    $res[] = $fetch;
                }
            }
            //retorna o array com as informações do DB.
            return $res;
        }
        
        protected function Update($tabela, $atualizacao, $condicao = 0){
            $sql = "UPDATE $tabela SET $atualizacao WHERE $condicao";

            $this->DB = $this->connectDB()->prepare($sql);

            if($this->DB->execute()){
                $res = true;
            }

            return $res;  
        }
        
        protected function Delete($tabela, $condicao = 0){

            $sql = "DELETE FROM $tabela WHERE $condicao";

            $this->DB = $this->connectDB()->prepare($sql);

            if($this->DB->execute()){
                $res = true;
            }

            return $res;
        }
        
    }