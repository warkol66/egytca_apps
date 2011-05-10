<h2>##40,Configuración del Sistema##</h2>
<h1>##151,Administración de Incoterms##</h1>
<div id="div_incoterms">
	|-if $message eq "ok"-|
		<div class="successMessage">Incoterm guardado correctamente</div>
		|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Incoterm eliminado correctamente</div>
		|-elseif $message eq "activated_ok"-|
		<div class="successMessage">Incoterm activado correctamente</div>
		|-/if-|
	<p>A continuación tiene el listado de los Incoterms disponibles en el sistema. Si desea agregar uno nuevo, haga click en "Agregar Incoterm", puede eliminar o agregar nuevos Incoterms. Si elimina un Incoterm, puede reactivarlo nuevamente.</p>
	<table id="tabla-incoterms" class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'>
	<col width="5%">
	<col width="20%">
	<col width="60%">
	<col width="15%">
		<thead>
			<tr>
				<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=importIncotermsEdit" class="addLink">Agregar Incoterm</a></div></th>
			</tr>
			<tr>
				<th class="thFillTitle">Id</th>
				<th class="thFillTitle">Nombre</th>
				<th class="thFillTitle">Descripción</th>
				<th class="thFillTitle">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$incoterms item=incoterm name=for_incoterms-|
			<tr>
												<td>|-$incoterm->getid()-|</td>
												<td>|-$incoterm->getname()-|</td>
												<td>|-$incoterm->getdescription()-|</td>
												<td nowrap="nowrap">
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="importIncotermsEdit" />
																<input type="hidden" name="id" value="|-$incoterm->getid()-|" />
																<input type="submit" name="submit_go_edit_incoterm" value="Editar" class="iconEdit" />
					</form>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="importIncotermsDoDelete" />
																<input type="hidden" name="id" value="|-$incoterm->getid()-|" />
																<input type="submit" name="submit_go_delete_incoterm" value="Borrar" onclick="return confirm('Seguro que desea eliminar el incoterm?')" class="iconDelete" />
					</form>
				</td>
			</tr>
		|-/foreach-|						
		|-if $pager->getTotalPages() gt 1-|
		<tr> 
				<td colspan="4" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>			
			|-/if-|				
	<tr>
		<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=importIncotermsEdit" class="addLink">Agregar Incoterm</a></div></th>
	</tr>
		</tbody>
	</table>
</div>

|-if $inactiveIncoterms|@count gt 1-|

<br />
<h3>Inactivos</h3>

<div>
		<table id="tabla-incoterms" class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'>
		<thead>
			<tr>
				<th class="thFillTitle">Id</th>
				<th class="thFillTitle">Nombre</th>
				<th class="thFillTitle">Descripción</th>
				<th class="thFillTitle">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$inactiveIncoterms item=incoterm name=for_incoterms-|
			<tr>
												<td>|-$incoterm->getid()-|</td>
												<td>|-$incoterm->getname()-|</td>
												<td>|-$incoterm->getdescription()-|</td>
												<td>

					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="importIncotermsDoActivate" />
																<input type="hidden" name="id" value="|-$incoterm->getid()-|" />
																<input type="submit" name="submit_go_delete_incoterm" value="Activar" class="boton" />
					</form>				</td>
			</tr>
		|-/foreach-|
		
		</tbody>
	</table>

</div>
		|-/if-|