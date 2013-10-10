<script type="text/javascript">
	|-if isset($parsed)-|
	$("li_|-$tweet->getId()-|").remove();
	$('lClose').simulate('click');
	|-/if-|
	$("resultDiv").innerHTML = "Tweet actualizado";
</script>
