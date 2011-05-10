<script type="text/javascript" language="javascript" charset="utf-8">
	|-if count($contractorIds) > 0  || count($preclasifiedIds)-|
		$('msgField').innerHTML = '<span class="resultSuccess">Se ha eliminado el contratista de la lista.</span>'
	|-else-|
		$('msgField').innerHTML = '<span class="resultFailure">No habían contratistas que eliminar.</span>'
	|-/if-|
</script>

|-include file="ProjectsContractorsListSection1Include.tpl"-|