<h2>Administración de Motivos</h2>
<h1>Motivos disponibles en sistema</h1>
<p>A continuación se muestra el listado de motivos disponibles en el sistema. Para agregar un nuevo motivo, haga click en "Agregar motivo". Para modificar o eliminar un motivo, utilice los controles disponibles en la fila correspondiente al mismo. Para activar o desactivar un motivo, puede marcar la casilla junto a los controles bal mismo; los motivos inactivos no se muestren en las opciones de motivos disponibles.</p>
<div id="div_themes">
|-if $message eq "ok"-|
	<div class="successMessage">Motivo guardado correctamente</div>
|-elseif $message eq "deleted_ok"-|
	<div class="successMessage">Motivo eliminado correctamente</div>
|-/if-|
	<table border="0" cellpadding="4" cellspacing="0" id="tabla-themes" class="tableTdBorders">
		<thead>
			<tr>
				 <th colspan="11" class="thFillTitle">|-if $smarty.get.all eq 1-|
	<input type="submit" value="Mostrar sólo motivos activos" onclick="location.href='Main.php?do=lausiThemesList'" />
|-else-|
	<input type="submit" value="Mostrar todos los motivos" onclick="location.href='Main.php?do=lausiThemesList&all=1'" />
|-/if-|
<div class="rightLink"><a href="Main.php?do=lausiThemesEdit" class="addLink">Agregar Motivo</a></div></th>
			</tr>
			<tr>
				<th width="2%">Id</th>
				<th width="18%">Nombre</th>
				<th width="18%">Nombre Corto</th>
				<th width="5%">Fecha</th>
				<th width="5%">Duración</th>
				<th width="5%">Tipo</th>
				<th width="10%">Cliente</th>
				<th width="5%">Total</th>
				<th width="5%">Distribuidos</th>
				<th width="2%">&nbsp;</th>
				<th width="2%">Activo</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$themes item=theme name=for_themes-|
			<tr>
				<td>|-$theme->getId()-|</td>
				<td>|-$theme->getName()-|</td>
				<td>|-$theme->getShortName()-|</td>
				<td align="center" nowrap="nowrap">|-$theme->getStartDate()|date_format:"%d-%m-%Y"-|</td>
				<td align="center">|-$theme->getDuration()-| días</td>
				<td>|-$theme->getTypeName()-|</td>
				<td>
					|-assign var=client value=$theme->getClient()-|
					|-if $client neq 0-||-$client->getName()-||-else-|No asignado|-/if-|					
				</td>
				<td class="right">|-$theme->getSheetsTotal()-|</td>
				<td class="right">|-$theme->getSheetsDistributed()-|</td>
				<td nowrap>
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="lausiThemesEdit" />
						<input type="hidden" name="id" value="|-$theme->getid()-|" />
						<input type="submit" name="submit_go_edit_theme" value="Editar" class="iconEdit" />
					</form>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="lausiThemesDoDelete" />
						<input type="hidden" name="id" value="|-$theme->getid()-|" />
						<input type="submit" name="submit_go_delete_theme" value="Borrar" onclick="return confirm('Seguro que desea eliminar el motivo?')" class="iconDelete" />
					</form>				
				</td>
				<td>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="lausiThemesActiveToggleX" />
						<input type="hidden" name="themeId" value="|-$theme->getid()-|" />
						<input type="checkbox" name="active" id="active_|-$theme->getId()-|" |-$theme->getActive()|checked:1-| onchange="javascript:lausiThemeActiveToggle(this.form);" />
						<span id="msgbox_|-$theme->getId()-|"></span>
					</form>
				</td>
			</tr>
		|-/foreach-|						
		|-if $pager->getTotalPages() gt 1-|
			<tr> 
				<td colspan="11" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>													
		|-/if-|						
			<tr>
				<th colspan="11" class="thFillTitle">
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="lausiThemesDeactivateEndedX" />
						<input type="submit" value="Desactivar Vencidos" onclick="return lausiThemesDeactivateEnded(this.form);" />
						<span id="msgboxDeactivate"></span>
					</form>		
				</th>		
			</tr>
			<tr>
				<th colspan="11" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=lausiThemesEdit" class="addLink">Agregar Motivo</a></div></th>
			</tr>
		</tbody>
	</table>
</div>
