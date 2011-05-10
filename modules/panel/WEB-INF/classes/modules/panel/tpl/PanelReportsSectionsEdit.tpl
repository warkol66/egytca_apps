|-include file='CommonEditTinyMceInclude.tpl' elements="sectionData[content],sectionData[enviromentalSupervision]," plugins="safari,style,table,advlink,inlinepopups,media,contextmenu,paste,nonbreaking"-|
<h2>##common,18,Configuración del Sistema##</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Sección de reporte</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<script type="text/javascript" language="javascript">
function sectionsGetAllParentsBySectionX(form){
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'parentInfo'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('reportSectionsMsgField').innerHTML = '<p><span class="inProgress">buscando padres...</span></p>';
	return true;
}

function sectionsGetObjectInfoX(form){
	var fields = Form.serialize(form, true);
	fields['do'] = 'panelReportsSectionsGetObjectInfoX';
	fields = Object.toQueryString(fields);
	var myAjax = new Ajax.Updater(
				{success: 'embeddedForm'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('reportSectionsMsgField').innerHTML = '<p><span class="inProgress">Actualizando información de la entidad...</span></p>';
	return false;
}
</script>



<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<div id="lightbox1" class="leightbox"> 
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="iconDelete" /></a> 
	</p>
	<div class="innerLighbox">
	<div id="embeddedForm">
		|-include file=$formTemplateName action="showLog"-|
	</div> 
	</div>
</div> 

<p>A continuación podrá |-if $action eq "edit"-|editar|-else-|crear|-/if-| una sección de reporte.</p>
<div id="div_reportSection">
	|-if $message eq "ok"-|
		<div class="successMessage">Sección guardada correctamente</div>
	|-/if-|
	|-if $message eq "error"-|
		<div class="errorMessage">Ha ocurrido un error al intentar guardar la sección </div>
	|-/if-|
		<fieldset title="Formulario de edición de datos de una sección">
     <legend>Ingrese los datos de la Sección</legend>
	<form action="Main.php" method="post" >
				<input type="hidden" name="do" value="panelReportsSectionsGetAllParentsBySectionX" />
<p>
      <label for="sectionDataX[type]">Tipo</label>
|-if $action eq "edit"-|
|-$section->getTypeTranslated()-|
|-else-|<select id="sectionDataX[type]" name="sectionDataX[type]" title="type" onChange="sectionsGetAllParentsBySectionX(this.form);">
				<option value="0">Seleccione el tipo</option>
			|-foreach from=$sectionTypes key=typeKey item=type name=for_type-|
				|-if $typeKey gt $configModule->get('reportSections','treeRootType')-|
        <option value="|-$typeKey-|">|-$type-|</option>
				|-/if-|
			|-/foreach-|
      </select>|-/if-|</p>
		</form>
	<form name="form_edit_section" id="form_edit_section" action="Main.php" method="post">
<div id="reportSectionsMsgField"></div>
<div id="parentInfo">
|-if $action eq "edit"-|
  <p><label for="sectionData[parentId]">Dentro de</label>
  <select id="sectionData[parentId]" name="sectionData[parentId]" title="parentId"> 
	|-if $section->getType() eq $configModule->get('reportSections','treeRootType') or empty($sections) or count($sections) eq 0 -|
    <option value="0" selected="selected">Ninguna</option> 
	|-else-|
	|-foreach from=$sections item=parent name=for_parent-|
   |-assign var=level value=$parent->getLevel()-|<option value="|-$parent->getId()-|" |-if $section->getParentId() eq $parent->getId()-|selected="selected" |-/if-|>|-section name=space loop=$level-|&nbsp;&nbsp;|-/section-||-$parent->getName()-|</option> 
	|-/foreach-|
	|-/if-|
  </select></p>
|-/if-|
|-if $action eq "edit"-|
  <input type="hidden" name="sectionData[objectType]" value="|-$objectType-|" />
  <p><label for="sectionData[objectId]">Acerca de</label>
  <select id="sectionData[objectId]" name="sectionData[objectId]" title="objectId" onChange="sectionsGetObjectInfoX(this.form);"> 
	|-if $section->getType() eq $configModule->get('reportSections','treeRootType') or empty($sections) or count($sections) eq 0 -|
    <option value="0" selected="selected">Ninguna</option>
    |-else-|
    	|-foreach from=$objects item=object name=for_object-|
   			<option value="|-$object->getId()-|" |-if $section->getObjectId() eq $object->getId()-|selected="selected" |-/if-|>|-$object->getName()|truncate:70-|</option> 
		|-/foreach-|
	|-/if-|
  </select><a id="lbOn" href="#lightbox1" rel="lightbox1" class="lbOn linkView">Ver Detalle</a></p>
|-/if-|
</div>
	<p>
	  <label for="sectionData[name]">Nombre</label>
	  <input name="sectionData[name]" type="text" id="sectionData[name]" title="name" value="|-$section->getName()|escape-|" size="60" maxlength="150" />
	</p>
	
	<p>
	  <label for="sectionData[content]">Detalle de Avance</label>
	  <textarea name="sectionData[content]" id="sectionData[content]" title="content" cols="70" rows="6" wrap="VIRTUAL">|-$section->getContent()|escape-|</textarea>
	</p>
	<p>
	  <label for="sectionData[enviromentalSupervision]">Supervisión Ambiental</label>
	  <textarea name="sectionData[enviromentalSupervision]" id="sectionData[enviromentalSupervision]" title="content" cols="70" rows="6" wrap="VIRTUAL">|-$section->getEnviromentalSupervision()|escape-|</textarea>
	</p>
    <p> 
    <label for="sectionData[completed]">Completo</label> 
    |-if $action eq "showLog"-|
    	<span>|-$section->getCompleted()|yes_no|multilang_get_translation:"common"-|</span>
    |-else-|    	
    	<input type="hidden" name="sectionData[completed]" value="0" />
    	<input type="checkbox" name="sectionData[completed]" value="1"  title="Marque esta opción si está completa la información" |-$section->getCompleted()|checked_bool-| /> </p> 
    |-/if-|
    </p> 
	<p>	
	|-if $action eq "edit"-|
		<input type="hidden" name="id" id="id" value="|-$section->getId()-|" />
	|-/if-|
		<input type="hidden" name="action" id="action" value="|-$action-|" />
		<input type="hidden" name="do" id="do" value="panelReportsSectionsDoEdit" />
		<br />
		<input type="submit" id="button_edit_section" name="button_edit_section" title="Aceptar" value="Aceptar" />
		<input type="button" id="button_return_section" name="button_return_section" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=panelReportSectionsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'" />
		<input type="hidden" name="sectionData[type]" id="sectionData[type]" value="|-$section->getType()-|" />
	</p>
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
		|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
	</form>
		</fieldset>
</div>

|-if $action eq "edit"-|
<!-- Manejo de documentos -->
|-if ($configModule->get("reportSections","useDocuments"))-|
	|-include file="DocumentsListInclude.tpl" entity="ReportSection" entityId=$section->getId()-|
	|-include file="DocumentsEditInclude.tpl" entity="ReportSection" entityId=$section->getId()-|
|-/if-| 
<!-- Fin manejo de documentos -->
|-/if-|