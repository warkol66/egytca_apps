|-foreach from=$bonds key=key item=bond-|
     |-$bond-|(|-count(array_keys($usersBonds, $key))-|)&nbsp;
|-/foreach-|
|-if isset($existent)-|
<script>
	$('#msgBond').html('<span>Ya seleccionó esta opción</span>');
</script>
|-/if-|
