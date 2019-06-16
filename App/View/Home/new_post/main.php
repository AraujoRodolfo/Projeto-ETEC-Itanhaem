<form method="post" enctype="multipart/form-data"><br>
	<input type="text" name="titulo" placeholder="titulo"><br>
	<input type="text" name="descricao" placeholder="descricao"><br>
	<select name="status">
		<option value="inativo" selected> inativo </option>
		<option value="ativo" >ativo </option>
	</select><br>

	<select name="tipo">
		<option value="noticia" selected> noticia </option>
		<option value="evento" >evento </option>
	</select><br>

	<input type="checkbox" name="marcada" id="marcada" value="1">
	<label for="marcada">hora marcada</label><br>
	<input type="date" name="dataMarcada"><br>
	<input style="width:60px" type="number" name="hora" min="0" max="23"> : 
	<input style="width:60px" type="number" name="min" min="0" max="59"> : 
	<input style="width:60px" type="number" name="seg" min="0" max="59"><br>

	<input type="file" name="anexo[]">
	<input type="file" name="anexo[]">
	

	<input type="hidden" name="newPost" value="<?= $_SESSION['form_key']; ?>">
	<br>
	<button type="submit"> enviar </button>
</form>