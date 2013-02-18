|-if count($objectives) eq 0-|
	<tr style="background:#E3E9F1;">
		<td></td>
		<td>No se encontraron objetivos de impacto</td>
	</tr>
|-else-|
|-foreach from=$objectives item=objective name=for_objectives-|
	<tr style="background:#E3E9F1;">
	<td><a class="icon iconFollow" href="#" onClick="return false;"></a></td>
	<td>Objetivo de Impacto: |-$objective->getName()-|</td>
	<td nowrap>
		<form action="Main.php" method="get" style="display:inline;">
			<input type="hidden" name="do" value="planningImpactObjectivesViewX" />
			<input type="hidden" name="id" value="|-$objective->getid()-|" />
			<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("planningImpactObjectivesShowDiv", "Main.php?do=planningImpactObjectivesViewX&id=|-$objective->getid()-|", { method: "post", parameters: { id: "|-$objective->getId()-|"}, evalScripts: true})};$("planningImpactObjectivesShowWorking").innerHTML = "<span class=\"inProgress\">buscando Objetivo de Impacto...</span>";' value="Ver detalle" name="submit_go_show_objective" title="Ver detalle" /></a>
		</form>
		<form action="Main.php" method="get" style="display:inline;">
			|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
			|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			<input type="hidden" name="do" value="planningImpactObjectivesEdit" />
			<input type="hidden" name="id" value="|-$objective->getid()-|" />
			<input type="submit" name="submit_go_edit_objective" value="Editar" class="icon iconEdit" title="Editar Objetivo de Impacto"/>
		</form>
		<form action="Main.php" method="post" style="display:inline;">
			|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
			|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
			<input type="hidden" name="do" value="planningImpactObjectivesDoDelete" />
			<input type="hidden" name="id" value="|-$objective->getid()-|" />
			<input type="submit" name="submit_go_delete_objective" value="Borrar" onclick="return confirm(\'¿Seguro que desea eliminar el objetivo?\')" class="icon iconDelete" title="Eliminar Objetivo de Impacto" />
		</form>
		|-if $smarty.session.planningMode || $loginUser->mayPlan() || $loginUser->mayFollow()-|
		<form action="Main.php" method="get" style="display:inline;">
			<input type="hidden" name="do" value="planningMinistryObjectivesEdit" />
			<input type="hidden" name="fromImpactObjectiveId" value="|-$objective->getid()-|" />
			<input type="submit" name="submit_go_edit" value="Agregar Objetivos Ministeriales" class="icon iconAdd" title="Agregar Objetivos Ministeriales al Objetivo de Impacto" />
		</form>|-/if-|
	</td>
	</tr>
	|-assign var=indicators value=$objective->getPlanningIndicators()-|
	|-foreach from=$indicators item=indicator name=for_indicators-|
		<tr style="background:#E3E9F1;">
			<td><a class="icon iconFollow" href="#" onClick="return false;"></a></td>
			<td>Indicador: |-$indicator->getName()-|</td>
			<td nowrap>
				<form action="Main.php" method="get" style="display:inline;">
					<input type="hidden" name="do" value="planningIndicatorsView" />
					<input type="hidden" name="id" value="|-$indicator->getid()-|" />
					<input type="submit" name="submit_go_edit_indicator" value="Ver Gráfico" class="icon iconGraph" title="Ver Gráfico" />
				</form>
				<form action="Main.php" method="get" style="display:inline;">
					<input type="hidden" name="do" value="planningIndicatorsViewX" />
					<input type="hidden" name="id" value="|-$indicator->getid()-|" />
					<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("planningIndicatorsShowDiv", "Main.php?do=planningIndicatorsViewX&id=|-$indicator->getid()-|", { method: "post", parameters: { id: "|-$indicator->getId()-|"}, evalScripts: true})};$("planningIndicatorsShowWorking").innerHTML = "<span class=\"inProgress\">buscando Indicador...</span>";' value="Ver detalle" name="submit_go_show_indicator" title="Ver detalle" /></a>
				</form>
				<form action="Main.php" method="get" style="display:inline;">
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="do" value="planningIndicatorsEdit" />
					<input type="hidden" name="id" value="|-$indicator->getid()-|" />
					<input type="submit" name="submit_go_edit_indicator" value="Editar" class="icon iconEdit" title="Editar Indicador"/>
				</form>
				<form action="Main.php" method="post" style="display:inline;">
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="do" value="planningIndicatorsDoDelete" />
					<input type="hidden" name="id" value="|-$indicator->getid()-|" />
					<input type="submit" name="submit_go_delete_indicator" value="Borrar" onclick="return confirm('¿Seguro que desea eliminar el objetivo?')" class="icon iconDelete" title="Eliminar Indicador" />
				</form>
			</td>
		</tr>
	|-/foreach-|
|-/foreach-|
|-/if-|
