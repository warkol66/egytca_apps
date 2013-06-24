<h2>Newsletter</h2>
<h1>Listado de Plantillas de Newsletter</h1>
	<div id="div_newslettertemplates">
	<p>
	A continuación se presentan las plantillas de newsletter disponibles en el sistema. Puede agregar una nueva plantilla, editar una existente o eliminarla.
	</p>
		|-if $message eq "ok"-|
			<div class="successMessage">Newsletter Template guardado correctamente</div>
		|-elseif $message eq "deleted_ok"-|
			<div class="successMessage">Newsletter Template eliminado correctamente</div>
		|-/if-|
		<table width="100%" class="tableTdBorders" id="tabla-newslettertemplates">
		<col width="50%">
		<col width="45">
		<col width="5%">
			<thead>
			<tr>
				<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=newslettersTemplatesEdit" class="addLink">Agregar Plantilla de Newsletter</a></div></th>
			</tr>
			<tr>
				<th>Nombre de Plantilla</th>
				<th>Nombre de Plantilla Externa</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$newslettertemplates item=newslettertemplate name=for_newslettertemplates-|
			<tr>
				<td>|-$newslettertemplate->getname()-|</td>
				<td>|-assign var=external value=$newslettertemplate->getnewsletterTemplateExternal()-||-if ($external neq '')-||-$external->getName()-||-else-|Sin Plantilla Externa|-/if-|</td>
				<td nowrap="nowrap">
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="newslettersTemplatesEdit" />
						<input type="hidden" name="id" value="|-$newslettertemplate->getid()-|" />
						<input type="submit" name="submit_go_edit_newslettertemplate" value="Editar" class="buttonImageEdit" />
					</form>
					<form action="Main.php" method="get" target="_blank">
						<input type="hidden" name="do" value="newslettersTemplatesShowPreview" />
						<input type="hidden" name="id" value="|-$newslettertemplate->getid()-|" />
						<input type="submit" name="submit_go_edit_newslettertemplate" value="Vista Preliminar" class="buttonImageView" />
					</form>									
					<form action="Main.php" method="post" >
						<input type="hidden" name="do" value="newslettersTemplatesDoDelete" />
						<input type="hidden" name="id" value="|-$newslettertemplate->getid()-|" />
						<input type="submit" name="submit_go_delete_newslettertemplate" value="Borrar" onclick="return confirm('Seguro que desea eliminar el newslettertemplate?')" class="buttonImageDelete" />
					</form>
				</td>
			</tr>
		|-/foreach-|						
		|-if $pager->getTotalPages() gt 1-|
			<tr> 
				<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|						
			<tr>
				<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=newslettersTemplatesEdit" class="addLink">Agregar Plantilla de Newsletter</a></div></th>
			</tr>
		</tbody>
	</table>
</div>
