<script language="JavaScript" type="text/javascript">
	$('objectivesShowWorking').innerHTML = '';
</script>
|-include file="ObjectivesForm.tpl"-|

<!-- Manejo de documentos -->
|-if $configModule->get("objectives","useDocuments")-|
	|-include file="DocumentsListInclude.tpl" entity="Objective" entityId=$objective->getId()-|
|-/if-| 
