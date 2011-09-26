<script src="scripts/prototype.js" type="text/javascript"></script>
<script src="scripts/scriptaculous.js" type="text/javascript"></script>
<script src="scripts/cropper.js" type="text/javascript"></script>

<script type="text/javascript" charset="utf-8">
	
	var x1, y1, width, height;
	
	function enableCrop() {
		$('div_non_cropable').hide();
		$('div_cropable').show();
	}
	
	function disableCrop() {
		$('div_non_cropable').show();
		$('div_cropable').hide();
	}
	
	function applyCrop() {
		new Ajax.Request(
			'Main.php?do=headlinesDoCropImageX',
			{
				method: 'post',
				parameters: {
					headlineId: '|-$id-|',
					imageFile: '|-$image-|',
					|-if $temp neq ''-|temp: '1',|-/if-|
					relativeX: x1,
					relativeY: y1,
					relativeWidth: width,
					relativeHeight: height,
					displayedWidth: '|-$displayedWidth-|',
					displayedHeight: '|-$displayedHeight-|'
				}
			}
		);
	}
	
	function onEndCrop( coords, dimensions ) {
		x1 = coords.x1;
		y1 = coords.y1;
		width = dimensions.width;
		height = dimensions.height;
	}
	
	Event.observe( 
		window, 
		'load', 
		function() { 
			new Cropper.Img( 
				'cropableImage',
				{
					onEndCrop: onEndCrop 
				}
			);
		}
	);
	
	Event.observe(window, 'load', disableCrop);
</script>

<div id="div_cropable" style="display:none">
	<img src="Main.php?do=headlinesGetClipping&image=|-$image-||-if $temp neq ''-|&temp=1|-/if-|" id="cropableImage" width="|-$displayedWidth-|" height="|-$displayedHeight-|" />
</div>

<div id="div_non_cropable">
	<img src="Main.php?do=headlinesGetClipping&image=|-$image-||-if $temp neq ''-|&temp=1|-/if-|" id="nonCropableImage" width="|-$displayedWidth-|" height="|-$displayedHeight-|" />
</div>
