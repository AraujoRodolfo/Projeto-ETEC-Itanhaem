<h1>Index</h1>
	<?php
	// if(is_array($this->list['ultimas noticias'])){
		foreach($this->list['ultimas noticias'] as $key => $obj){
			echo "<h1>".$obj->getTitulo()."<small>".$obj->getAutor()->getNome()."</small></h1>";
			echo "<p>".$obj->getDescricao()."</p>";
		}
	// }

	?>