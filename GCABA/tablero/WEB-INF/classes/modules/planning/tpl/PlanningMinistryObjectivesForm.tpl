<link type="text/css" href="css/chosen.css" rel="stylesheet" />
<script language="JavaScript" type="text/javascript" src="scripts/chosen.proto.js"></script>
<!--<script language="JavaScript" type="text/javascript" src="scripts/jquery/chosen.js"></script>-->
<!--<script language="JavaScript" type="text/javascript" src="scripts/jquery/ajax-chosen.min.js"></script>-->
<script type="text/javascript">
document.observe("dom:loaded", function() {
	new Chosen($("params_regions"));
});

/*	$(document).ready(function() {


		$(".chzn-select").chosen();

$("#autocomplete_responsibleCode").ajaxChosen({
    method: 'GET',
    url: 'Main.php?do=commonAutocompleteJQueryListX&object=position&objectParam=code',
    dataType: 'json'
}, function (data) {
    var terms = {};

    $.each(data, function (i, val) {
        terms[i] = val;
    });

    return terms;
});

	})*/





</script>
|-if $message eq "ok"-|
	<div class="successMessage">Objetivo Ministerial guardado correctamente</div>
|-elseif $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar Objetivo Ministerial</div>
|-/if-|
|-include file="CommonAutocompleterInclude.tpl"-|
  <form name="form_edit_objective" id="form_edit_objective" action="Main.php" method="post">
		<!--pasaje de parametros de filtros -->

    <fieldset title="Formulario de datos de Objetivo Ministerial">
     <legend>Objetivo Ministerial|-if $startingYear eq $endingYear-| - |-$startingYear-||-else-| (|-$startingYear-| - |-$endingYear-|)|-/if-|</legend>
		|-if !$show && !$showLog-|<div id="responsible" style="position: relative;z-index:11000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_responsibleCode" label="Dependencia" url="Main.php?do=commonAutocompleteListX&object=position&objectParam=code" hiddenName="params[responsibleCode]" defaultHiddenValue=$ministryObjective->getResponsibleCode() defaultValue=$ministryObjective->getPosition()-|
		</div>
		|-else-|
      <p>
        <label for="params_responsibleCode">Dependencia</label>
      <input name="params_responsibleCode" type="text" id="params_responsibleCode" size="80" value="|-$ministryObjective->getPosition()-|" readonly="readonly" />
      </p>
		|-/if-|
		      <p>
        <label for="params_name">Nombre</label>
      <input name="params[name]" type="text" id="params_name" size="80" value="|-$ministryObjective->getName()-|" title="Nombre del Objetivo Ministerial" maxlength="255"  class="emptyValidation" /> |-validation_msg_box idField="params_name"-|
      </p>
    <p> 
      <label for="params_description">Resumen Narrativo </label>
      <textarea name="params[description]" cols="70" rows="6" wrap="VIRTUAL" id="params_description" type="text" title="Descripción del Objetivo Ministerial" >|-$ministryObjective->getDescription()|escape-|</textarea> |-validation_msg_box idField="params_description"-|
    </p> 
     <p> 
      <label for="params_indicators">Indicadores</label>
      <input name="params[indicators]" type="text" id="params_indicators" title="Indicadores" value="TO DO" size="7"> 
    </p> 
     <p>
        <label for="params_baseline">Línea de base</label>
      <input name="params[baseline]" type="text" id="params_name" size="15" value="|-$ministryObjective->getBaseline()-|" title="Nombre del Objetivo Ministerial" maxlength="10" class="emptyValidation" /> |-validation_msg_box idField="params_baseline"-|
      </p>
	<p>
		<label for="params_regions">Comunas</label>
		<select class="chzn-select wide-chz-select" data-placeholder="Seleccione una o varias comunas..." multiple="multiple" id="params_regions" name="params[regionsIds][]" size="5" title="comunas">
		|-foreach from=$regions item=object-|
			<option value="|-$object->getid()-|" |-$ministryObjective->hasRegion($object)|selected:true-|>|-$object->getname()-|</option>
		|-/foreach-|
		</select>
	</p>
			|-if isset($loginUser) && $loginUser->isSupervisor() && !$ministryObjective->isNew()-|
				<p>
					<label for="changedBy">|-if $ministryObjective->getVersion() gt 1-|Modificado|-else-|Creado|-/if-| por:</label>
					|-$ministryObjective->updatedBy()-| - |-$ministryObjective->getUpdatedAt()|change_timezone|dateTime_format-| </p>
			|-/if-|
    |-if !$ministryObjective->isNew()-|
    <input type="hidden" name="id" id="id" value="|-$ministryObjective->getId()-|" /> 
    |-/if-|
		|-if !$show && !$showLog -|<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
    <input type="hidden" name="params[startingYear]" id="params_startingYear" value="|-$startingYear-|" /> 
    <input type="hidden" name="params[endingYear]" id="params_endingYear" value="|-$endingYear-|" /> 
    <input type="hidden" name="currentPage" id="currentPage" value="|-$currentPage-|" /> 
    <input type="hidden" name="do" id="do" value="planningMinistryObjectivesDoEdit" /> 
		<p>|-javascript_form_validation_button id="button_edit" value='Aceptar' title='Aceptar'-|
	<input type='button' onClick='location.href="Main.php?do=planningMinistryObjectivesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Objetivos Ministeriales"/>
		</p>|-/if-|
    </fieldset> 
  </form> 