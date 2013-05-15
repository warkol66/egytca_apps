<p>Resultados: |-foreach from=$bonds key=key item=bond-|
   -&nbsp;|-$bond|regex_replace:"/ /":"&nbsp;"-|&nbsp;(|-count(array_keys($usersBonds, $key))-|)
|-/foreach-|
|-if isset($existent)-|
<script>
	$('#msgBond').html('<span class="resultSuccess">Ya seleccionó esta opción</span>');
</script>
|-/if-|
