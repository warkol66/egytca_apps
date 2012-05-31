<link type="text/css" href="css/smoothness/jquery-ui-1.8.19.custom.css" rel="Stylesheet" />
<script type="text/javascript" src="scripts/jquery/jquery-ui-1.8.19.custom.min.js"></script>
<link type="text/css" href="css/jquery-ui-timepicker-addon.css" rel="Stylesheet" />
<script type="text/javascript" src="scripts/jquery/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery.ui.datepicker-es.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery.ui.timepicker-es.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery-ui-sliderAccess.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery.ui.touch-punch.min.js"></script>

<h2>Administración de Relevadores</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Relevador</h1>
|-if $message eq "ok"-|
	<div class="successMessage">Relevador guardado correctamente</div>
|-elseif $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar guardar el relevador</div>
|-/if-|
<div id="div_constructions">
		<form name="form_edit_construction" id="form_edit_construction" action="Main.php" method="post">
			<p>Ingrese los datos del relevador</p>
			<fieldset title="Formulario de edición de datos de un relevador">
			<legend>Formulario de Relevadores</legend>
				<p>
					<label for="inspectorname">Nombre</label>
					<input name="params[name]" type="text" id="inspectorname" title="Nombre del Relevador" value="|-$inspector->getName()|escape-|" class="emptyValidation" size="60" maxlength="255" |-js_char_counter object=$inspector columnName="name" fieldName="inspectorname" idRemaining="remaining" sizeRemaining="3" classRemaining="charCount" counterTitle="Cantidad de caracteres restantes" showHide=1 useSpan=0-||-$Counter.pre-| /> |-$Counter.pos-| |-validation_msg_box idField="inspectorname"-|
				</p>
				<p>
					|-if !$inspector->isNew()-|
					<input type="hidden" name="id" id="inspectorid" value="|-$inspector->getid()-|" />
					|-/if-|
					<!--pasaje de parametros de filtros -->
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					<input type="hidden" name="do" id="doEdit" value="constructionsInspectorsDoEdit" />
					|-javascript_form_validation_button id="button_edit_construction" value='Aceptar' title='Aceptar'-|
	<input type='button' onClick='location.href="Main.php?do=constructionsInspectorsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Relevadores"/>
				</p>
			</fieldset>
		</form>
	</div>
