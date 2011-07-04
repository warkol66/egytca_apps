var TextCounter = Class.create();
TextCounter.prototype = {
	initialize: function(textareaid, inputid, maxLength) {
		this.maxLength = maxLength;
		this.textarea = $(textareaid);
		this.input = $(inputid);
		this.input.value = maxLength;
		this.input.readonly = true;
		this.input.disabled = true;
		Event.observe(this.textarea, 'keyup', this.checkChars.bindAsEventListener(this));
		Event.observe(this.textarea, 'keydown', this.checkChars.bindAsEventListener(this));
		this.checkChars();
	},
	checkChars: function(e) {
		var includeBreaksInCount = false; // false = don't count a return (\r or \n) in the count.
		var charCount = this.textarea.value.length;
		var breaks = 0;
		if (!includeBreaksInCount) {
			var lines = this.textarea.value.split('\n');
			breaks = lines.length;
			// check for /r at the end of the lines (IE)
			for (var i=0; i<lines.length; i++) {
				var line = lines[ i ];
				if (line.charCodeAt(line.length-1) == 13)
					breaks++;
			}
		}
		// check if over limit
		if ((charCount-breaks) > this.maxLength)
			this.textarea.value = this.textarea.value.substring(0, (this.maxLength + breaks) );

		// update counter
		if (this.input) {
			if ((charCount-breaks) > this.maxLength)
				this.input.value = 0;
			else
				this.input.value = (this.maxLength + breaks) - charCount;
		}
	}
}
