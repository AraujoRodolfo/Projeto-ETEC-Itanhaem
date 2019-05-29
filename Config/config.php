<?php
    //caso nao esteja no root, coloacar o nome da subpasta exemplo: "sub/"
        $subpasta = "ProjetoETEC/";
        
    /**
     * ROTAS BASE
     **/
     
        define("DIR_PAGE","https://". $_SERVER['HTTP_HOST'].'/'.$subpasta);

        if(substr($_SERVER['DOCUMENT_ROOT'],-1) == '/'){
            define('DIR_REQ',$_SERVER['DOCUMENT_ROOT'].$subpasta);
        }else{
            define('DIR_REQ',$_SERVER['DOCUMENT_ROOT'].'/'.$subpasta);
        }
    /**
     * DIRETORIOS BASE PUBLICOS (public)
     **/
        define('DIR_CSS',       DIR_PAGE .'public/css/');
        define('DIR_JS',        DIR_PAGE .'public/js/');
        define('DIR_TEMPLATE',  DIR_PAGE .'public/template/');
        define('DIR_IMG',       DIR_PAGE .'public/img/');
    
    /**
     *  DIRETORIOS DA APLICAÇÃO
     **/
        define('DIR_APP',        DIR_REQ .'App/');
        define('DIR_CONTROLLER', DIR_APP .'Controller/');
        define('DIR_MODEL',      DIR_APP .'Model/');
        define('DIR_VIEW',       DIR_APP .'View/');
        define('DIR_DAO',        DIR_APP .'DAO/');
    
    /**
     * DADOS DE ACESSO AO BANCO DE DADOS
     **/
        define('DB_NAME','exemploMVC');
        define('DB_HOST','localhost');
        define('DB_USER','o0jdc0o');
        define('DB_PW','');
    
    /**
     * DADOS DE ENVIO DE MAIL
     **/
        define('MAIL_ADDRESS','meuemail@exemplo.com');
        define('MAIL_OWNER','administrador da silva');
        define('MAIL_PW','senha do email');
        define('MAIL_PORT','25'); 
        define('MAIL_TYPE','tls'); // ssl ou tls
        
    /**
     * CHAVE DE ENCRIPTAÇÃO
     **/
        define("CRYPT_KEY","3e0d722dfa73647251d023db9248f689cdc78ea4");