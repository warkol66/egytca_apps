<script type="text/javascript" src="scripts/lightbox.js"></script>
<div id="lightbox1" class="leightbox" style="z-index:12000;">
	<p align="right">
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a> 
	</p>
	<div id="planningActivityDocumentsShowWorking"></div>
	<div class="innerLighbox">
		<div><p align="right"><a id="documentAddLink" href="#" class="addLink">Agregar nuevo documento</a></p></div>
		<div id="planningActivityDocumentsListDiv"></div>
	</div>
</div>
<a id="openLightbox1_control" href="#lightbox1" rel="lightbox1" class="lbOn" style="display:none"></a>
<a id="closeLightbox_control" href="#" class="lbAction blackNoDecoration" rel="deactivate" style="display:none"></a>

<div id="lightbox2" class="leightbox" style="z-index:13000;">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a> 
	</p>
	<div id="planningActivityDocumentsShowWorking2"></div>
	<div class="innerLighbox">
		<div id="planningActivityDocumentsEditDiv"></div>
	</div>
</div>
<a id="openLightbox2_control" href="#lightbox2" rel="lightbox2" class="lbOn" style="display:none"></a>
<h2>Seguimiento
|-if isset($show) && is_object($dependency)-|
 - <a href="Main.php?do=tableroPolicyGuidelinesShow">|-$dependency->getName()-|</a></h2> 
|-/if-|
|-if !$notValidId || is_object($planningProject)-|
<h1>Seguimiento  de Proyectos - |-if !$planningProject->isNew()-|Editar|-else-|Crear|-/if-| Proyecto</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p>Responsable:</p>
<div id="div_project">
	<fieldset>
	<h1>Proyecto: |-$planningProject->getName()-|</h1>
	<h3>Listado y Gantt de actividades</h3>
	|-include file="PlanningActivitiesInclude.tpl" activities=$planningProject->getActivities() margin="false" add="false" -|
	<h3>Listado de obras</h3>
	|-include file="PanelConstructionsInclude.tpl" constructions=$planningProject->getPlanningConstructions()-|
	</fieldset>
</div>
|-else-|
	<h1>Administración de Proyectos</h1>
	<div class="errorMessage">El identificador del proyecto ingresado no es válido. Seleccione un proyecto de la lista.</div>
	<input type='button' onClick='location.href="Main.php?do=planningProjectsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Proyectos"/>
|-/if-|

<script type="text/javascript">
	function loadAddDocumentsLightbox(planningActivityId) {
		$('planningActivityDocumentsListDiv').innerHTML = '';
		new Ajax.Updater(
			'planningActivityDocumentsListDiv',
			'Main.php?do=planningActivityDocumentsListX',
			{
				method: 'get',
				parameters: { id: planningActivityId },
				evalScripts: true,
				onSuccess: function() {
					$('planningActivityDocumentsShowWorking').innerHTML = '';
				},
				onFailure: function(response) {
					$('planningActivityDocumentsShowWorking').innerHTML = response.statusText;
				}
			}
		);
		$('planningActivityDocumentsShowWorking').innerHTML = '<span class="inProgress">buscando Documentos...</span>';
		$('documentAddLink').onclick = function() {
			var html = $('planningActivityDocumentsEditTemplate').innerHTML.replace('<%planningActivityId%>', planningActivityId);
			$('planningActivityDocumentsEditDiv').innerHTML = html;
			openLightbox2();
		};
	}

	function openLightbox1() { $('openLightbox1_control').click(); }
	function openLightbox2() { $('openLightbox2_control').click(); }
	function closeLightbox() { $('closeLightbox_control').click(); }
</script>

<div id="planningActivityDocumentsEditTemplate" style="display:none">
	|-include file="DocumentsEditInclude.tpl" entity="PlanningActivity" entityId="<%planningActivityId%>" iframe="true" target="submit-iframe"-|
	<iframe name="submit-iframe" style="display: none;" |-*onload="if (this.innerHTML != '') { closeLightbox(); loadAddDocumentsLightbox('<%planningActivityId%>'); openLightbox1(); }"*-|></iframe>
</div>
