<script type="text/javascript">
	|-if isset($parsed)-|
	$("li_|-$tweet->getId()-|").remove();
	$('lClose').simulate('click');
	|-elseif isset($discarded)-|
	$("tr_|-$tweet->getId()-|").remove();
	|-/if-|
	$("resultDiv").innerHTML = "<span class='resultSuccess'>Tweet actualizado</span>";
</script>
