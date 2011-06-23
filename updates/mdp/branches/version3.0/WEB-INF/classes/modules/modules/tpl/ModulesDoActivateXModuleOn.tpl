<div id="messageResult" class="resultFailure">Ha ocurrido un error. No se puede desactivar el módulo, primero necesita desactivar los módulos dependientes:<ul>|-foreach from=$dependenciesName item=dependencyName-|<li>|-$dependencyName-|</li>|-/foreach-|</ul></div>
<script language="JavaScript">
	$('active_|-$moduleName-|').checked = false;
	$('messageMod').innerHTML = "";
</script>