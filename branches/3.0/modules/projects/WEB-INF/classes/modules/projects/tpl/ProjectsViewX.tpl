<script language="JavaScript" type="text/javascript">
	$('projectsShowWorking').innerHTML = '';
</script>
|-include file="ProjectsForm.tpl"-|

<!-- Manejo de documentos -->
|-if $configModule->get("projects","useDocuments")-|
	|-include file="DocumentsListInclude.tpl" entity="Project" entityId=$project->getId()-|
|-/if-| 
<!-- Manejo de contratistas -->
|-if $configModule->get("projects", "useContractors")-|
	|-include file="ProjectsContractorsListInclude.tpl"-|
|-/if-|
