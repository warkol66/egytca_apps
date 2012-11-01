<script src="scripts/prototype.js" type="text/javascript"></script>
<script src="scripts/scriptaculous.js" type="text/javascript"></script>
<script src="scripts/cropper.js" type="text/javascript"></script>

<script type="text/javascript" charset="utf-8">
	
	var x1 = '0';
	var y1 = '0';
	var width = '|-$displayedWidth-|';
	var height = '|-$displayedHeight-|';
	
	function enableCrop() {
		$('div_non_cropable').hide();
		$('div_cropable').show();
	}
	
	function disableCrop() {
		$('div_non_cropable').show();
		$('div_cropable').hide();
	}
	
	function applyCrop(onsuccess) {
		new Ajax.Request(
			'Main.php?do=headlinesDoCropImageX',
			{
				method: 'post',
				parameters: {
					|-if $isAttachment-|
						id: |-$id-|,
						source: "attachment",
					|-else-|
						headlineId: '|-$id-|',
						imageFile: '|-$image-|',
						|-if $temp neq ''-|temp: '1',|-/if-|
					|-/if-|
					relativeX: x1,
					relativeY: y1,
					relativeWidth: width,
					relativeHeight: height,
					displayedWidth: '|-$displayedWidth-|',
					displayedHeight: '|-$displayedHeight-|'
				},
				onSuccess: onsuccess
			}
		);
	}
	
	function onEndCrop( coords, dimensions ) {
		x1 = coords.x1;
		y1 = coords.y1;
		width = dimensions.width;
		height = dimensions.height;
	}
	
	function Coords(x1, y1, x2, y2) {
		this.x1=x1;
		this.y1=y1;
		this.x2=x2;
		this.y2=y2;
	}
	
	Event.observe( 
		window, 
		'load', 
		function() { 
			new Cropper.Img( 
				'cropableImage',
				{
					onEndCrop: onEndCrop,
					onloadCoords: new Coords(0, 0, '|-$displayedWidth-|', '|-$displayedHeight-|')
				}
			);
		}
	);
	
	Event.observe(window, 'load', disableCrop);
</script>

|-if $isAttachment-|
	|-assign var="src" value="Main.php?do=headlinesAttachmentGetData&id="|cat:$id-|
|-else-|
	|-assign var="src" value="Main.php?do=headlinesGetClipping&image="|cat:$image-|
	|-if $temp neq ''-||-assign var="src" value=$src|cat:"&temp=1"-||-/if-|
|-/if-|
<div id="div_cropable" style="display:none">
	<img src="|-$src-|" id="cropableImage" width="|-$displayedWidth-|" height="|-$displayedHeight-|" />
</div>

<div id="div_non_cropable">
	<img src="|-$src-|" id="nonCropableImage" width="|-$displayedWidth-|" height="|-$displayedHeight-|" />
</div>
