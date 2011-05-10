<script type="text/javascript" language="javascript" charset="utf-8">
// <![CDATA[
	$('msgbox').innerHTML = 'La Asignacion se ha realizado correctamente.';
	var form = document.getElementById('|-$formId-|');
	form.remove();
	

	|-if isset($theme)-|
		//actualizacion de cantidad de motivos en interfaz
		if ($('themeDistributedCount') != null)
			$('themeDistributedCount').innerHTML = '|-$theme->getSheetsDistributed()-| afiches (|-$theme->getSheetsToBeDistributed()-| Afiches Pendientes a Distribuir)';
	|-/if-|
	
// ]]>
</script>

<script type="text/javascript">
	
	|- if isset($mode) and $mode eq 'circuit'-|
		lausiUpdateDistributeCountCircuit();
	|-/if-|

	|- if isset($mode) and $mode eq 'region'-|	
		lausiUpdateDistributeCountRegion();
	|-/if-|
	
	|-if not isset($mode)-|
		lausiUpdateDistributeCount();
	|-/if-|
	
</script>


