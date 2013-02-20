<div id="lightbox_const" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="planningConstructionsShowWorking"></div>
	<div class="innerLighbox">
		<div id="planningConstructionsShowDiv"></div>
	</div>
</div>
<div> 
	<table class="tableTdBorders" id="constructionsTable" style="margin-bottom:15px;"> 
	<thead>
		|-*if ($show || $showLog) && $activities|@count gt 0*-|
	</thead> 
	<tbody id="constructionsTbody">
	|-if $constructions|@count eq 0-|
		<tr>
			 <td colspan="4">No hay Obras en este proyecto</td>
		</tr>
	|-else-|
	|-foreach from=$constructions item=construction name=for_contractConstructions-|
		<tr id="constructionId_|-$construction->getId()-|"> 
			<td>|-$construction->getName()-|</td>
			<td><a href="javascript:void(null);" class="flag|-$construction->statusColor()|capitalize-|"></a></td>
			<td nowrap>
				<form action="Main.php" method="get" style="display:inline;">
					<input type="hidden" name="do" value="planningConstructionsViewX" />
					<input type="hidden" name="id" value="|-$construction->getid()-|" />
					<a href="#lightbox_const" rel="lightbox_const" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("planningConstructionsShowDiv", "Main.php?do=planningConstructionsViewX&id=|-$construction->getid()-|", { method: "post", parameters: { id: "|-$construction->getId()-|"}, evalScripts: true})};$("planningConstructionsShowWorking").innerHTML = "<span class=\"inProgress\">buscando Obra...</span>";' value="Ver detalle" name="submit_go_show_construction" title="Ver detalle" /></a>
				</form>
					<form action="Main.php" method="get" style="display:inline;">
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="hidden" name="do" value="panelConstructionsEdit" />
						<input type="hidden" name="id" value="|-$construction->getid()-|" />
						<input type="submit" name="submit_go_edit_construction" value="Editar" class="icon iconListCheck" title="Seguimiento de Obra"/>
					</form>

|-if $showGantt && $construction->countActivities() gt 0-|<input type="button" class="icon iconViewGantt" onClick='window.open("Main.php?do=planningConstructionsViewX&showGantt=true&id=|-$construction->getid()-|","Gantt","scrollbars=1,width=800,height=600");' value="Ver Gantt" title="Ver Gantt (abre en ventana nueva)" />|-else-|<img src="images/clear.png" class="icon iconClear disabled" />|-/if-|
			</td>
		</tr>
	|-/foreach-|
	|-/if-|
		|-*else*-|
		|-*/if*-|
  </tbody> 
 </table> 
</div> 


	<table id="tabla-constructions" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
		</thead>
		<tbody>
		|-foreach from=$planningConstructionColl item=construction name=for_constructions-|
			<tr>
				<td>|-$construction->getName()-|</td>
				<td></td>
				<td nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningConstructionsViewX" />
						<input type="hidden" name="id" value="|-$construction->getid()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("planningConstructionsShowDiv", "Main.php?do=planningConstructionsViewX&id=|-$construction->getid()-|", { method: "post", parameters: { id: "|-$construction->getId()-|"}, evalScripts: true})};$("planningConstructionsShowWorking").innerHTML = "<span class=\"inProgress\">buscando Obra...</span>";' value="Ver detalle" name="submit_go_show_construction" title="Ver detalle" /></a>
					</form>
					<form action="Main.php" method="get" style="display:inline;">
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="hidden" name="do" value="panelConstructionsEdit" />
						<input type="hidden" name="id" value="|-$construction->getid()-|" />
						<input type="submit" name="submit_go_edit_construction" value="Editar" class="icon iconListCheck" title="Seguimiento de Obra"/>
					</form>
					<form action="Main.php" method="post" style="display:inline;">
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="hidden" name="do" value="planningConstructionsDoDelete" />
						<input type="hidden" name="id" value="|-$construction->getid()-|" />
						<input type="submit" name="submit_go_delete_construction" value="Borrar" onclick="return confirm('¿Seguro que desea eliminar el objetivo?')" class="icon iconDelete" title="Eliminar Obra" />
					</form>
					</td>
			</tr>
		|-/foreach-|		
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="4" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			|-if $planningConstructionColl|@count gt 5-|<tr>
				 <th colspan="|-if $moduleConfig.useDependencies.value =="YES"-|9|-else-|8|-/if-|" class="thFillTitle"><div class="rightLink">|-if $smarty.session.planningMode || $loginUser->mayPlan() || $loginUser->mayFollow()-|<a href="Main.php?do=panelConstructionsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-||-if $nav-|&fromPlanningProjectId=|-$filters.planningprojectid-||-/if-|" class="addLink">Agregar Obra</a>|-/if-|</div></th>
			</tr>|-/if-|
		</tbody>
	</table>
