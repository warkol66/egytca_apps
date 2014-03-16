var system = require('system');

if (system.args.length < 3 || system.args.length > 4) {
	console.log('Usage: render.js URL filename [width*height]');
	phantom.exit(1);
}

var page = require('webpage').create();
var address = system.args[1];
var output = system.args[2];
if (system.args.length > 3) {
	var size = system.args[3].split('*');
	if (size.length === 2)
		page.viewportSize = { width: size[0], height: size[1] };
}

page.open(address, function (status) {
	if (status !== 'success') {
		console.log('Unable to load the address!');
		phantom.exit();
	} else {
		window.setTimeout(function () {
			page.evaluate(function() {
				document.body.bgColor = 'white';
			});
			page.render(output);
			phantom.exit();
		}, 200);
	}
});
