|-if $action ne "showLog"-|
|-include file="CommonAutocompleterInclude.tpl" -|
<script type="text/javascript" language="javascript" charset="utf-8">
function addContractorToProject(form) {
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'msgField'},
				'Main.php?do=projectsDoAddContractorX',
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('msgField').innerHTML = '<span class="inProgress">agregando contratista al proyecto...</span>';
	return true;
}

function deleteContractorFromProject(form){
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'contractors_list'},
				'Main.php?do=projectsDoDeleteContractorX',
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
				});
	$('msgField').innerHTML = '<span class="inProgress">eliminando contratista...</span>';
	return true;
}

</script>

<fieldset title="Formulario de listas de contratistas asociados al ##projects,4,proyecto##">
	<legend>Contratistas</legend>
	
	<div id="msgField"></div>
	
	<form method="post" style="display:inline;">
		<div id="contractorAdder" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_contractors" label="Agregar contratista a candidatos" url="Main.php?do=panelContractorsAutocompleteListX&projectId="|cat:$project->getid() hiddenName="contractor[id]" disableSubmit="addContractor"-|
		</div>
		<input type="hidden" name="do" id="do" value="projectsDoAddContractorX" />
		<input type="hidden" name="type" id="type" value="1" /> 
		<input type="hidden" name="projectId" id="projectId" value="|-$project->getId()-|" /> 
      	<input type="button" id="addContractor" value="Agregar contratista al proyecto" title="Agregar contratista al proyecto" disabled onClick="javascript:addContractorToProject(this.form)"/> 
	</form>

	<form method="post" style="display:inline;">
		<div id="contractors_list">
		  |-include file="ProjectsContractorsListSection1Include.tpl"-|
		</div>
		<input type="hidden" name="type" id="type" value="2" /> 
		<input type="hidden" name="projectId" id="projectId" value="|-$project->getId()-|" />
	</form>
</fieldset>
|-elseif $contractors|@count gt 0 || $preClasifiedContractors|@count gt 0-|
<fieldset title="Contratistas asociados al ##projects,4,proyecto##">
	<legend>Contratistas</legend>
<ul>Lista larga
	|-foreach from=$contractors item=contractor-|
		<li>|-$contractor->getName()-|</li>
	|-/foreach-|
	</ul>
	<ul>Lista corta
	|-foreach from=$preClasifiedContractors item=contractor-|
		<li>|-$contractor->getName()-|</li>
	|-/foreach-|
	</ul>
	</fieldset>
|-/if-|