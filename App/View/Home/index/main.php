<h1>Index</h1>
	<?php
		foreach($this->list['ultimas noticias'] as $key => $obj){
			echo "<h1>".$obj->getTitulo()."<small>".$obj->getAutor()->getNome()."</small></h1>";
			echo "<p>".$obj->getDescricao()."</p>";
		}
	?>