|-if $formTemplateName ne ''-|
	|-include file=$formTemplateName action="showLog"-|
|-/if-|

<script type="text/javascript" language="javascript">
	$('resultFrameIndicatorsMsgField').innerHTML  = '';
	|-if $objectId eq 0 -|
		$('lbOn').hide();
	|-else-|
		$('lbOn').show();
	|-/if-|
</script>

