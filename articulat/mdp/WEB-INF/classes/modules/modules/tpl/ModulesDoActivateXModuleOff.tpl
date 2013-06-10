<div id="messageResult" class="resultFailure">Ha ocurrido un error. Ha intentado desactivar un módulo que necesita la desactivación de lo(s) siguiente(s) módulo(s):<ul>|-foreach from=$dependenciesName item=dependencyName-|<li>|-$dependencyName-|</li>|-/foreach-|</ul></div>
<script language="JavaScript">
	$('active_|-$moduleName-|').checked = true;
	$('messageMod').innerHTML = "";
</script>