<script type="text/javascript">
	|-if isset($parsed)-|
	$("li_|-$tweet->getId()-|").remove();
	$('lClose').simulate('click');
	|-elseif isset($discarded)-|
	$("tr_|-$tweet->getId()-|").remove();
	|-/if-|
	$("resultDiv").innerHTML = "Tweet actualizado";
</script>
