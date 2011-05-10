

<script type="text/javascript" language="javascript">
// <![CDATA[
	option = document.createElement('option');
	option.value = '|-$theme->getId()-|';
	option.innerHTML = '|-$theme->getName()-|';
	$('themeIdSelectDistribute').appendChild(option);
	$('themeCreationDiv').hide();
	$('themeCreationForm').reset();
	$('msgboxCreateButton').innerHTML = 'Motivo creado con exito.';

// ]]>
</script>
