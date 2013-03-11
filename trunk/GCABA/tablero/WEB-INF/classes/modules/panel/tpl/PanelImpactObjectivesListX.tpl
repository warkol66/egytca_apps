|-if count($objectives) eq 0-|
	<tr style="background:#E3E9F1;" class="position_|-$posId-|">
		<td colspan="4">No se encontraron objetivos de impacto</td>
	</tr>
|-else-|
|-foreach from=$objectives item=objective name=for_objectives-|
	<tr style="background:#E3E9F1;" class="position_|-$posId-|">
	<td id="expand_|-$objective->getId()-|"><a href="#" onClick="indicatorsShow(|-$objective->getId()-|); return false;"><img src="images/icon_expand.png" /></a></td>
	<td id="collapse_|-$objective->getId()-|" style="display: none;"><a href="#" onClick="indicatorsHide(|-$objective->getId()-|); return false;"><img src="images/icon_collapse.png" /></a></td>
	<td><strong>Objetivo de Impacto:</strong> |-$objective->getName()-|</td>
			<td colspan="2" nowrap="nowrap">
		<form action="Main.php" method="get" style="display:inline;">
			<input type="hidden" name="do" value="planningImpactObjectivesViewX" />
			<input type="hidden" name="id" value="|-$objective->getid()-|" />
			<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" id="objective_|-$objective->getId()-|" onClick='javaScript:viewObjective(|-$objective->getId()-|);' value="Ver detalle" name="submit_go_show_objective" title="Ver detalle" /></a>
		</form>
		<!--<form action="Main.php" method="get" style="display:inline;">
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
		</form>|-/if-|-->
	</td>
	</tr>
	|-assign var=indicators value=$objective->getPlanningIndicators()-|
	|-if count($indicators) eq 0-|
	<tr style="background:#D6FFFF;display: none;" class="indicator_|-$objective->getId()-|">
		<td colspan="4">No se encontraron indicadores</td>
	</tr>
	|-else-|
	|-foreach from=$indicators item=indicator name=for_indicators-|
		<tr style="background:#D6FFFF;display: none;" class="indicator_|-$objective->getId()-|">
			<td>&nbsp;</td>
			<td><strong>Indicador:</strong> |-$indicator->getName()-|</td>
			<td colspan="2" nowrap="nowrap">
			<!--<input type="button" class="icon iconView" onClick='window.open("Main.php?do=planningIndicatorsViewX&id=|-$indicator->getid()-|","indicator","width=800,height=600");' value="Ver indicador" title="Ver indicador (abre en ventana nueva)" />-->
				<form action="Main.php" method="get" style="display:inline;">
					<input type="hidden" name="do" value="planningIndicatorsViewX" />
					<input type="hidden" name="id" value="|-$indicator->getid()-|" />
					<a href="#lightbox2" rel="lightbox2" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("planningIndicatorsShowDiv", "Main.php?do=planningIndicatorsViewX&id=|-$indicator->getid()-|", { method: "post", parameters: { id: "|-$indicator->getId()-|"}, evalScripts: true})};$("planningIndicatorsShowWorking").innerHTML = "<span class=\"inProgress\">buscando Indicador...</span>";' value="Ver detalle" name="submit_go_show_indicator" title="Ver detalle" /></a>
				</form>
				<form action="Main.php" method="get" style="display:inline;">
					<input type="hidden" name="do" value="planningIndicatorsView" />
					<input type="hidden" name="id" value="|-$indicator->getid()-|" />
					<a href="#lightbox3" rel="lightbox3" class="lbOn"><input type="button" class="icon iconGraph" onClick='{new Ajax.Updater("planningGraphShowDiv", "Main.php?do=planningIndicatorsView&id=|-$indicator->getid()-|", { method: "post", parameters: { lightbox: true}, evalScripts: true})};$("planningIndicatorsShowWorking").innerHTML = "<span class=\"inProgress\">buscando Gráfico...</span>";' value="Ver Gráfico" name="submit_go_edit_indicator" title="Ver Gráfico" /></a>
				</form>
<!--				<form action="Main.php" method="get" style="display:inline;">
					<input type="hidden" name="do" value="planningIndicatorsViewGraphX" />
					<input type="hidden" name="id" value="|-$indicator->getid()-|" />
					<a href="#lightbox2" rel="lightbox2" class="lbOn"><input type="button" class="icon iconGraph" onClick='{new Ajax.Updater("planningIndicatorsShowDiv", "Main.php?do=planningIndicatorsViewGraphX&id=|-$indicator->getid()-|", { method: "post", parameters: { id: "|-$indicator->getId()-|"}, evalScripts: true})};$("planningIndicatorsShowWorking").innerHTML = "<span class=\"inProgress\">buscando Indicador...</span>";' value="Ver detalle" name="submit_go_show_indicator" title="Ver detalle" /></a>
				</form>-->
				<!--<form action="Main.php" method="get" style="display:inline;">
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
				</form>-->
			</td>
		</tr>
	|-/foreach-|
	|-/if-|
|-/foreach-|
|-/if-|
<script language="JavaScript" type="text/JavaScript">
initialize();
</script>
