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
	
	function applyCrop() {
		var form = new Element('form',
			{method: 'post', action: 'Main.php?do=headlinesCropImage'});
			
		form.insert(new Element('input',
			{name: 'relative_x', value: $('x1').value, type: 'hidden'}));
		form.insert(new Element('input',
			{name: 'relative_y', value: $('y1').value, type: 'hidden'}));
		form.insert(new Element('input',
			{name: 'relative_width', value: $('width').value, type: 'hidden'}));
		form.insert(new Element('input',
			{name: 'relative_height', value: $('height').value, type: 'hidden'}));
			
		form.insert(new Element('input',
			{name: 'displayed_width', value: '|-$displayedWidth-|', type: 'hidden'}));
		form.insert(new Element('input',
			{name: 'displayed_height', value: '|-$displayedHeight-|', type: 'hidden'}));
			
		$(document.body).insert(form);
		form.submit();
	}
	
	function onEndCrop( coords, dimensions ) {
		$( 'x1' ).value = coords.x1;
		$( 'y1' ).value = coords.y1;
		$( 'x2' ).value = coords.x2;
		$( 'y2' ).value = coords.y2;
		$( 'width' ).value = dimensions.width;
		$( 'height' ).value = dimensions.height;
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
</script>

<div id="div_cropable">
	<img src="|-$imageFileName-|" id="cropableImage" width="|-$displayedWidth-|" height="|-$displayedHeight-|" />
</div>

<input type='button' value='save' onClick='applyCrop()' />

	<p>
		<label for="x1">x1:</label>
		<input type="text" name="x1" id="x1" />
	</p>
	<p>
		<label for="y1">y1:</label>
		<input type="text" name="y1" id="y1" />
	</p>
	<p>
		<label for="x2">x2:</label>
		<input type="text" name="x2" id="x2" />
	</p>
	<p>
		<label for="y2">y2:</label>
		<input type="text" name="y2" id="y2" />
	</p>
	<p>
		<label for="width">width:</label>
		<input type="text" name="width" id="width" />
	</p>
	<p>
		<label for="height">height</label>
		<input type="text" name="height" id="height" />
	</p> 
	
|-/if-|