<h2>Formularios</h2>
<h1>Administración de Formularios</h1>
<p>A continuación se muestra el listado de los formularios disponibles en el sistema. Puede editar o eliminar los formulariso existentes, o agregar uno nuevo.</p>
<div id="div_forms">
	|-if $message eq "ok"-|
		<div class="successMessage">Formulario guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Formulario eliminado correctamente</div>
	|-/if-|
	<table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders" id="table-forms">
		<thead>
			<tr>
				<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=formsFormsEdit" class="addLink">Agregar Formulario</a></div></th>
			</tr>
			<tr>
				<th>id</th>
				<th>Nombre</th>
				<th>Descripción</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$forms item=form name=for_forms-|
			<tr>
				<td>|-$form->getid()-|</td>
				<td>|-$form->getname()-|</td>
				<td>|-$form->getDescription()-|</td>
				<td nowrap="nowrap">
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="formsFormsEdit" />
						<input type="hidden" name="id" value="|-$form->getid()-|" />
						<input type="submit" name="submit_go_edit_form" value="Editar" title="Editar" class="buttonImageEdit" />
					</form>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="formsFormsDoDelete" />
						<input type="hidden" name="id" value="|-$form->getid()-|" />
						<input type="submit" name="submit_go_delete_form" value="Eliminar" title="Eliminar" class="buttonImageDelete" onclick="return confirm('Seguro que desea eliminar el formulario?')" />
					</form>
				</td>
			</tr>
		|-/foreach-|						
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="4">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|						
			<tr>
				<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=formsFormsEdit" class="addLink">Agregar Formulario</a></div></th>
			</tr>
		</tbody>
	</table>
</div>
