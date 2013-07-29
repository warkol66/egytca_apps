<div id="content-actions">
	<h2>Módulo de Contenido</h2>
	<h1>Administrar Idiomas de Contenido</h1>
	<p>A continuación modificar los idiomas habilitados para el módulo de contenidos.</p>
</div>
<div id="mensajes">
|-if $message eq "edited"-|
	<div class='successMessage'>Cambios guardados con éxito</div>
|-elseif $message eq "notedited"-|
	<div class='failureMessage'>Error al guardar los cambios</div>
|-elseif $message eq "deleted"-|
	<div class='successMessage'>Eliminado con éxito</div>
|-elseif $message eq "notdeleted"-|
	<div class='failureMessage'>No se ha podido eliminar</div>
|-/if-|	
</div>
	
	<div id="content-languages-add">
		<form action="Main.php" method="post">
			<p>
			|-if $inactiveLanguages|@count lt 1-|
			Todos los idiomas disponibles se encuentran activos
			|-else-|
				<label>Activación de idioma: </label>
				<select name="id">
					|-foreach from=$inactiveLanguages item=item-|
						<option value="|-$item->getId()-|">|-$item->getName()-|</option>
					|-/foreach-|
				</select>
				<input type="submit" value="Activar">
				<input type="hidden" name="do" value="contentLanguageActivate" />
			|-/if-|</p>
		</form>
	</div>

		<div class="rightLink"><a href="Main.php?do=contentLanguageEdit" class="addLink">Agregar Idioma</a></div></th>


	<div id="content-languages">
		<fieldset>
				<legend>Idiomas disponibles para contenidos </legend>
				<ul id="contentList">
		    
			|-foreach from=$languages item=item-|
				<li> 
					<span class="textOptionMove" style="float:left;width:65%;">
						|-$item->getName()-|
					</span>
					<span style="float:left;width:35%;text-align:right;">
						<form action="Main.php" method="get" style="display: inline;">
							<input type="hidden"  value="contentLanguageEdit" name="do" />
							<input type="hidden"  value="|-$item->getId()-|" name="id" />
							<input type="submit"  value="Editar" class="icon iconEdit" title="Editar" />
						</form>
                        |-if !is_object($defaultLanguage) or $defaultLanguage->getId() neq $item->getId()-|
						<form action="Main.php?do=contentLanguageDoDelete" method="post" style="display: inline;"><input
						 type="hidden" name="id" value="|-$item->getId()-|"/><a href="#"
						 onclick="if (confirm('¿Esta seguro que quiere desactivar este elemento?')) this.parentNode.submit();" alt="Desactivar" title="Desactivar"><img src="images/clear.png" class="icon iconDelete"></a>
						</form>
                        |-/if-|

					</span>
					<br style="clear: left" />
				</li>
			|-/foreach-|
			</ul>
		</fieldset>
	</div>
