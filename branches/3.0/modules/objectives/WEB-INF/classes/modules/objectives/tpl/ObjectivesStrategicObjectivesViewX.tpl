<script language="JavaScript" type="text/javascript">
	$('objectivesShowWorking').innerHTML = '';
</script>
|-include file="ObjectivesStrategicObjectivesForm.tpl"-|

<!-- Manejo de documentos -->
|-if $configModule->get("objectives","useDocuments")-|
	|-include file="DocumentsListInclude.tpl" entity="StrategicObjective" entityId=$objective->getId()-|
|-/if-| 
