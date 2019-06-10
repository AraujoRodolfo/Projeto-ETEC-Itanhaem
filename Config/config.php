<?php
    //define o fuso-horario
    date_default_timezone_set('America/Sao_Paulo');
    // mostrar erros
    ini_set('display_errors',1);
    ini_set('display_startup_erros',1);
    error_reporting(E_ALL);
    
    //caso nao esteja no root, coloacar o nome da subpasta exemplo: "sub/"
        $subpasta = "";
        
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
        define('DIR_ANEXOS',    DIR_PAGE .'public/img/posts/');
        //diretorio para upload de anexos e etc
        define('DIR_UPLOAD',    DIR_REQ  .'public/');
        define('DIR_UPLOAD_POST_ANEXOS', DIR_UPLOAD . 'img/posts/');
    
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
        define('DB_NAME','etecitan_dev');
        define('DB_HOST','localhost');
        define('DB_USER','etecitan_dev');
        define('DB_PW','9sA_o4~yBf5V');
    
    /**
     * DADOS DE ENVIO DE MAIL
     **/
        define("MAIL_HOST",'etec.profrodolfo.com.br');
        define('MAIL_ADDRESS','no-reply@etec.profrodolfo.com.br');
        define('MAIL_OWNER','Etec Itanhaém');
        define('MAIL_PW','5Tdiud2ZH,+w');
        define('MAIL_PORT','587'); 
        define('MAIL_TYPE','tls'); // ssl ou tls
        
    /**
     * CHAVE DE ENCRIPTAÇÃO
     **/
        define("CRYPT_KEY","3e0d722dfa73647251d023db9248f689cdc78ea4");