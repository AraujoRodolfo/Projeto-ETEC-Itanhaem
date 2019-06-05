<h1>Index</h1>
	<?php
		foreach($this->list['ultimas noticias'] as $obj => $value){
			echo "<h1>".$obj->getTitulo()."</h1>";
		}
	?>