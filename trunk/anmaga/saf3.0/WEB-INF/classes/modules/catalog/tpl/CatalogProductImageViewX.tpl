<script language="JavaScript" type="text/javascript">
	$('catalogShowWorking').innerHTML = '';
</script>
|-if $product->getImagePath() ne ""-|
<img src="|-$product->getImagePath()-|.jpg" />
|-else-|
<img src="images/noPhotoAvailable.png" />
|-/if-|