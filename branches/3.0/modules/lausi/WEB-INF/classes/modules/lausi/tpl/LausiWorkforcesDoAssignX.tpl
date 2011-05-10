|-assign var=date value=$advert->getPublishDate()-|
|-include file="LausiWorkforcesAssigmentsInclude.tpl" date=$date-|
<script type="text/javascript">
	var msgbox = 'msgBox' + |-$advert->getId()-|; 
	$(msgbox).innerHTML = '<span class="resultSuccess">Actualizado</span>';
	var counter = parseInt($('counter').innerHTML);
	|-if $cleared neq ''-|
		$('counter').innerHTML = counter + 1;
	|-else-|
		$('counter').innerHTML = counter - 1;
	|-/if-|
</script>