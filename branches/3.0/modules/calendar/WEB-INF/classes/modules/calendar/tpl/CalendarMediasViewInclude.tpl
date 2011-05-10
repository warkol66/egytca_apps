<!-- slideshow -->
<div id="OuterContainer">
	<div id="Container">
		<img id="Photo" src="images/c.gif" alt="Photo: Couloir" />
		<div id="LinkContainer">
			<a href="#" id="PrevLink" title="Anterior"><span>Anterior</span></a>
			<a href="#" id="NextLink" title="Siguiente"><span>Siguiente</span></a>
		</div>
		<div id="Loading"><img src="images/loading_animated2.gif" width="48" height="47" alt="Cargando ..." /></div>
	</div>
</div>
<div id="CaptionContainer">
	<span id="Counter">&nbsp;</span><span id="Caption">&nbsp;</span>
</div>

<script type="text/javascript">
// <![CDATA[
// Photo directory for this gallery
var photoDir = "Main.php?do=calendarMediasGetImage&id=";

// Define each photo's name, height, width, and caption
var photoArray = new Array(
	// Source, Width, Height, Caption
	|-foreach from=$calendarEvent->getImages() item=image name=images-|
	new Array("|-$image->getId()-|", "|-$image->getWidth()-|", "|-$image->getHeight()-|", "|-$image->getTitle()-|: |-$image->getDescription()-|")|-if !$smarty.foreach.images.last-|,|-/if-|
	Titulo: |-$image->getTitle-|
	|-/foreach-|
	);

// Number of photos in this gallery
var photoNum = photoArray.length;		
		
// Add window.onload event to initialize
Behaviour.addLoadEvent(init);
Behaviour.apply();
function init() {
	var myPhoto = new Slideshow(photoId);
	myPhoto.initSwap();
	soundManagerInit();
}		
Behaviour.register(myrules);
// ]]>
</script>
