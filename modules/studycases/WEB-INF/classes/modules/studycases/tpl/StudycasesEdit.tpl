|-include file='TinyMceInclude.tpl' elements="params[description]" plugins="safari,style,table,advlink,inlinepopups,media,contextmenu,paste,nonbreaking"-|
<h2>Experiencias</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Experiencia</h1>
<div id="div_studycase">
	<p>Ingrese los datos del Experiencia</p>
		<p><a href="#" onClick="location.href='Main.php?do=studycasesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'">Volver atras</a>
		</p>
		|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el Experiencia</span>|-/if-|
	<form name="form_edit_studycase" id="form_edit_studycase" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un studycase">
			<legend>Formulario de Administración de Experiencias</legend>
			<p>
				<label for="params[title]">Título</label>
				<input type="text" id="params[title]" name="params[title]" size="70" value="|-$studycase->gettitle()|escape-|" title="Título" />
			</p>
			<p>
				<label for="params[reference]">Referencia</label>
				<input type="text" id="params[reference]" name="params[reference]" size="70" value="|-$studycase->getreference()|escape-|" title="Referencia" />
			</p>
			<p>
				<label for="params[summary]">Resumen</label>
				<textarea name="params[summary]" cols="50" rows="3" id="params[summary]" wrap="virtual" title="Resumen">|-$studycase->getsummary()|escape-|</textarea>
			</p>
			<p>
				<label for="params[description]">Experiencia</label>
				<textarea name="params[description]" cols="50" rows="8" id="params[description]" wrap="virtual" title="Descripcion">|-$studycase->getdescription()|escape-|</textarea>
			</p>
			<p>
				<label for="params[published]">Publicar</label>
    	<input type="hidden" name="sectionData[published]" value="0" />
    	<input type="checkbox" name="sectionData[published]" value="1"  title="Marque esta opción para publicar la experiencia información" |-$studycase->getPublished()|checked_bool-| /> </p> 
			</p>
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$studycase->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="studycasesDoEdit" />
				<input type="submit" id="button_edit_studycase" name="button_edit_studycase" title="Aceptar" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=studycasesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'"/>
			</p>
		</fieldset>
	</form>
</div>
