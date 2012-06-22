<link type="text/css" href="css/smoothness/jquery-ui-1.8.19.custom.css" rel="Stylesheet" />
<script type="text/javascript" src="scripts/jquery/jquery-ui-1.8.19.custom.min.js"></script>
<link type="text/css" href="css/jquery-ui-timepicker-addon.css" rel="Stylesheet" />
<script type="text/javascript" src="scripts/jquery/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery.ui.datepicker-es.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery.ui.timepicker-es.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery-ui-sliderAccess.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery.ui.touch-punch.min.js"></script>
<link type="text/css" href="css/chosen.css" rel="stylesheet" />
<script language="JavaScript" type="text/javascript" src="scripts/jquery/chosen.js"></script>
<link rel="stylesheet" href="scripts/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type='text/javascript' src='scripts/fancybox/jquery.fancybox-1.3.4.pack.js'></script>
<script type="text/javascript" src="scripts/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery.jeditable.mini.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		
		$(".chzn-select").chosen();
		initializeDatePickers();
		$('a.galleryPhoto').fancybox({
			titleShow: true,
			titlePosition: 'inside',
			titleFormat: function(title, currentArray, currentIndex, currentOpts) {
				var a = currentArray[currentIndex];
				var photoDiv = $('<div></div>');
				$('<p><span id="title" class="jeditable_'+$(a).attr('photoId')+'">'+$(a).attr('photoTitle')+'</span></p>').appendTo(photoDiv);
				$('<p><span id="description" class="jeditable_'+$(a).attr('photoId')+'">'+$(a).attr('photoDescription')+'</span></p>').appendTo(photoDiv);
				return photoDiv;
			},
			onComplete: function(currentArray, currentIndex) {
				var a = currentArray[currentIndex];
				$('.jeditable_'+$(a).attr('photoId')).editable('Main.php?do=resourcesDoEditParam', {
					id: 'paramName',
					name: 'paramValue',
					submitdata: { id: $(a).attr('photoId') },
					submit: 'OK',
					cancel: 'Cancel',
					indicator : 'Saving...',
					callback: function(value, settings) {
						$(a).attr('photo'+$(this).attr('id'), value);
					}
				});
			}
		});
		|-if !$inspection->isNew()-|
			$('a#photoAdd').fancybox({
				onComplete: function() {
					swfuInit();
				}
			});
		|-/if-|
	});
	
	function initializeDatePickers() {
		$.datepicker.setDefaults({
			dateFormat: 'dd-mm-yy',
			numberOfMonths: 3
//			minDate: 0	
		});
		$('#params_visitDate').datepicker();
		$('#params_endDate').datepicker();
		$('#params_endDateMinistry').datepicker();
	}
	
	inspectionPhotoUploadSuccess = function (file, serverData) {
	try {
		var parsedData = JSON.parse(serverData);
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		
		if (parsedData.error == 1) {
			progress.setError();
			progress.setStatus(parsedData.message);
		} else {
			progress.setComplete();
			progress.setStatus('Complete.');
			var data = JSON.parse(parsedData.data);
			var photo = JSON.parse(data.photo);
			$.ajax({
				url: 'Main.php?do=constructionsInspectionsLoadGalleryPhotoX',
				type: 'post',
				data: { photoId: photo.id },
				success: function(data) {
					$(data).appendTo($('#photos'));
				}
			});
			$('a.galleryPhoto').fancybox();
		}
		
		progress.toggleCancel(false);

	} catch (ex) {
		this.debug(ex);
	}
}
</script>

<h2>Administración de Obras</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Relevamiento</h1>
|-if $message eq "ok"-|
	<div class="successMessage">Relevamiento guardado correctamente</div>
|-elseif $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar guardar el Relevamiento</div>
|-/if-|
<div id="div_inspection">
		<form name="form_edit_construction" id="form_edit_construction" action="Main.php" method="post">
			<p>Ingrese los datos de la obra</p>
			<fieldset title="Formulario de edición de datos de una obra">
			<legend>Formulario de Relevamientos</legend>
				|-if !$inspection->isNew()-|
				<p>
					<a href="#" onclick="$('a.galleryPhoto').first().click();">Ver fotos</a>
					<a id="photoAdd" href="#uploader">Agregar foto</a>
				</p>
				|-/if-|
				<p>
					<label for="params_visitDate">Relevamiento</label>
					<input name="params[visitDate]" type="text" id="params_visitDate" title="Día del relevamiento" value="|-$inspection->getVisitDate()|date_format-|" size="12" /> 
				</p>
				<p>
					<label for="params_constructionId">Obra</label>
			|-if isset($constructions)-|
					<select class="chzn-select medium-chz-select" data-placeholder="Seleccione la obra..." id="params_constructionId" name="params[constructionId]" title="Obras">
					<option value=""></option>
					|-foreach from=$constructions item=object-|
						<option value="|-$object->getId()-|" |-$inspection->getConstructionId()|selected:$object->getId()-|>|-$object->getName()-|</option>
					|-/foreach-|
					</select>
			|-else-|
				|-if !isset($construction)-|
					|-assign var=construction value=$inspection->getConstruction()-|
				|-/if-|
					<input name="construction" type="text" id="construction" title="Obra" value="|-$construction-|" size="60" readonly="readonly" />
					<input name="params[constructionId]" type="hidden" id="construction" value="|-$construction->getId()-|" />
			|-/if-|
				</p>
				<p>
					<label for="params_inspectorId">Relevador</label>
					<select id="params_axis" name="params[inspectorId]" class="chzn-select medium-chz-select" data-placeholder="Seleccione el relevador..."  title="Relevador">
					<option value=""></option>
					|-foreach from=$inspectors item=object-|
						<option value="|-$object->getId()-|" |-$inspection->getInspectorId()|selected:$object->getId()-|>|-$object->getName()-|</option>
					|-/foreach-|
					</select>
				</p>
				<p>
					<label for="params_endDate">Fin de la obra</label>
					<input name="params[endDate]" type="text" id="params_endDate" title="Fin de la obra" value="|-$inspection->getEndDate()|date_format-|" size="12" /> 
				</p>							
				<p>
					<label for="params_endDateMinistry">Fin según ministerio</label>
					<input name="params[endDateMinistry]" type="text" id="params_endDateMinistry" title="Fin de la obra según ministerio" value="|-$inspection->getEndDateMinistry()|date_format-|" size="12" /> 
				</p>							
				<p>
					<label for="params_progressInspector">Avance según relevador</label>
					<input name="params[progressInspector]" type="text" id="params_progressInspector" title="Progreso según relevador" value="|-$inspection->getProgressInspector()-|" size="4" /> %
				</p>
				<p>
					<label for="params_workers">Obreros</label>
					<input name="params[workers]" type="text" id="params_workers" title="Obreros" value="|-$inspection->getworkers()-|" size="4" />
				</p>

				<p>
					<label for="params_workshop">Obrador</label>
					<input name="params[workshop]" id="params_workshop" type="hidden" value="0">
					<input name="params[workshop]" type="checkbox" |-$inspection->getWorkshop()|checked_bool-| value="1">
				</p>
				<p>
					<label for="params_workingRate">Ritmo de trabajo</label>
					<select id="params_workingRate" name="params[workingRate]" title="Ritmo de trabajo">
						<option value="0">Seleccione el ritmo de trabajo</option>
				|-foreach from=$workingRates item=rate name=foreach_rate-|
					<option value="|-$rate@key-|" |-$inspection->getWorkingRate()|selected:$rate@key-|>|-$rate-|</option>
				|-/foreach-|
					</select>
				</p>
				<p>
					<label for="params_progress">Avance</label>
					<textarea name="params[progress]" cols="60" rows="6" wrap="VIRTUAL"  id="params_progress">|-$inspection->getProgress()|escape-|</textarea>
			</p>
				<p>
					<label for="params_conclusion">Conclusión</label>
					<textarea name="params[conclusion]" cols="60" rows="6" wrap="VIRTUAL"  id="params_conclusion">|-$inspection->getConclusion()|escape-|</textarea>
			</p>
				<p>
					<label for="params_otherComments">Otros comentarios</label>
					<textarea name="params[otherComments]" cols="60" rows="6" wrap="VIRTUAL"  id="params_otherComments">|-$inspection->getOtherComments()|escape-|</textarea>
			</p>

				<p>
					<label for="params_status">Estado</label>
					<select id="params_status" name="params[status]" title="Estado">
						<option value="0">Seleccione el estado</option>
				|-foreach from=$statuses item=status name=foreach_status-|
					<option value="|-$status@key-|" |-$inspection->getStatus()|selected:$status@key-|>|-$status-|</option>
				|-/foreach-|
					</select>
				</p>


				<p>
					|-if !$inspection->isNew()-|
					<input type="hidden" name="id" id="params_id" value="|-$inspection->getId()-|" />
					|-/if-|
					<!--pasaje de parametros de filtros -->
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					<input type="hidden" name="do" id="doEdit" value="constructionsInspectionsDoEdit" />
					|-javascript_form_validation_button id="button_edit_inspection" value='Aceptar' title='Aceptar'-|
	<input type='button' onClick='location.href="Main.php?do=constructionsInspectionsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Obras"/>
				</p>
			</fieldset>
		</form>
	</div>

|-if !$inspection->isNew()-|
<div id="photos" style="display:none">
|-foreach $photos as $photo-|
	|-include file="ConstructionsInspectionsGalleryPhotoInclude.tpl" photo=$photo-|
|-/foreach-|
</div>
<div style="display:none"><div id="uploader">
	|-include
		file="SWFUploadInclude.tpl"
		url="Main.php?do=constructionsDoUploadInspectionPhoto&inspectionId="|cat:$inspection->getId()
		preventInit=true
		uploadSuccessHandler="inspectionPhotoUploadSuccess"
	-|
</div></div>
|-/if-|