<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Etec Itanhaém - <?= $this->getTitle(); ?></title>
        <meta name="description" content="<?= $this->getDescription(); ?>">
         <meta name="keywords" content="<?= $this->getKeywords(); ?>">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <!-- BOOSTRAP MIN.CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        	  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
        	  crossorigin="anonymous">
        <!-- ICONES  -->
        <link href="<?= DIR_CSS ?>icon/font/css/open-iconic-bootstrap.css" rel="stylesheet">
        <!-- FONT AWESOME -->
        <link rel="stylesheet" 
        	  href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" 
        	  integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" 
        	  crossorigin="anonymous">
        <!-- LINK DE CSS PARA TODAS AS PÁGINAS -->
       	<link rel="stylesheet" href="<?= DIR_CSS; ?>style.css">
       	<!-- ICONE DA ABA DO SITE -->
       	<link rel="icon" href="<?= DIR_IMG; ?>core-img/favicon.ico">
        <?= $this->addHead(); ?>
    </head>
    <body>
    	<div class="container-fluid">
            <header class="header-area">
                	<?= $this->addHeader(); ?>
            </header>
            <main>
                <?= $this->addMain(); ?>
            </main>
            <footer>
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
                		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                		crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
                		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
                		crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
                		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
                		crossorigin="anonymous"></script>
    		    <!-- VARIAVEIS OU FUNÇÕES QUE PODEM SER USADAS EM MAIS DE 1 ARQUIVO -->
                <script type="text/javascript" src="<?= DIR_JS ?>global.js"></script>
                <?= $this->addFooter(); ?>
            </footer>
        <!-- fim da div container fluid -->
        </div>
    </body>
</html>