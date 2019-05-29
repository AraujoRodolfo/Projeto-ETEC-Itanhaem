<?php
    namespace App\DAO;
    
    use App\DAO\DAO;
    use App\Model\ModelUsuario;
    
    class AuthDAO extends DAO{
        
        public function validar(ModelUsuario $usuario){
        	return true;
        }

        public function carregarDadosUsuario(ModelUsuario $usuario){
        	$usuario->setId('1');
        	$usuario->setNome("Jhonatan");
        	$usuario->setTipo('aluno');

        	return $usuario;
        }
    }