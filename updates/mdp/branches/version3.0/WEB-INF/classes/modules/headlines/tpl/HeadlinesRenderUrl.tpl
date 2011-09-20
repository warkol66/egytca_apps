|-if $error_message neq ''-|
	|-$error_message-|
|-else-|
	
<!---- displayed image size ---->
|-assign var='displayedWidth' value='500'-|
|-assign var='displayedHeight' value='333'-|
<!------------------------------>
	
Operación OK. Imagen guardada en |-$imageFileName-|<br>

<script src="scripts/prototype.js" type="text/javascript"></script>
<script src="scripts/scriptaculous.js" type="text/javascript"></script>
<script src="scripts/cropper.js" type="text/javascript"></script>

<script type="text/javascript" charset="utf-8">
	
	var workFinished = false;
	var x1, y1, width, height;
	
	function tempImageRemoval() {
		if (!workFinished)
			new Ajax.Request(
				'Main.php?do=headlinesRemoveTempImageX',
				{
					method: 'post',
					parameters: {filename: '|-$imageFileName-|'}
				}
			);
	}
	
	function applyCrop() {
		var form = new Element('form',
			{method: 'post', action: 'Main.php?do=headlinesCropImage'});
			
		form.insert(new Element('input',
			{name: 'headlineId', value: '|-$id-|', type: 'hidden'}));
		form.insert(new Element('input',
			{name: 'image_file', value: '|-$imageFileName-|', type: 'hidden'}));
			
		form.insert(new Element('input',
			{name: 'relative_x', value: x1, type: 'hidden'}));
		form.insert(new Element('input',
			{name: 'relative_y', value: y1, type: 'hidden'}));
		form.insert(new Element('input',
			{name: 'relative_width', value: width, type: 'hidden'}));
		form.insert(new Element('input',
			{name: 'relative_height', value: height, type: 'hidden'}));
			
		form.insert(new Element('input',
			{name: 'displayed_width', value: '|-$displayedWidth-|', type: 'hidden'}));
		form.insert(new Element('input',
			{name: 'displayed_height', value: '|-$displayedHeight-|', type: 'hidden'}));
			
		$(document.body).insert(form);
		
		workFinished = true;
		form.submit();
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
	
	Event.observe(window, 'unload', tempImageRemoval);
</script>

<div id="div_cropable">
	<img src="|-$imageFileName-|" id="cropableImage" width="|-$displayedWidth-|" height="|-$displayedHeight-|" />
</div>

<p>
<input type='button' value='save' onClick='applyCrop()' />
</p>
	
|-/if-|