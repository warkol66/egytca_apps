Event.observe(window, 'load', function() {
	// options
	var reflectionHeight = 0.5; // height of the reflection, relative to the image (0-1)
	var reflectionOpacity = 0.5; // starting opacity of the reflection (0-1)

	$$('img.wetfloor').each(function(image) {
		var wrapper = image.wrap(new Element('div'));
		wrapper.style.position = 'relative';
		
		var dim = image.getDimensions();
		var height = Math.round(dim.height * reflectionHeight);

		wrapper.style.paddingBottom = height + 'px';

		$R(1, height).each(function(y) {
			var div = wrapper.appendChild(new Element('div'));
			div.setStyle({
				width: dim.width + 'px',
				height: '1px',
				position: 'absolute',
				top: (dim.height + y - 1) + 'px',
				left: 0,
				backgroundImage: 'url(' + image.src + ')',
				backgroundPosition: '0 ' + (y - dim.height) + 'px',
				backgroundRepeat: 'no-repeat',
				opacity: (1 - (y / height)) * reflectionOpacity
			});
		});
	});
});