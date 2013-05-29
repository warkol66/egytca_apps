<p>Resultados: |-foreach from=$usersByBonds key=key item=users-|
		-&nbsp;|-$bonds[$key]|regex_replace:"/ /":"&nbsp;"-|<a href="javascript:void(null);" class="tooltipWide">
		<span>|-foreach from=$users item=user-|
			|-$user->getName() -|<br />
		|-/foreach-|</span>(|-count(array_keys($boardBonds, $key))-|)</a>
	|-/foreach-|</p>
|-if isset($existent)-|
<script>
	$('#msgBond').html('<span class="resultSuccess">Ya seleccionó esta opción</span>');
</script>
|-/if-|
