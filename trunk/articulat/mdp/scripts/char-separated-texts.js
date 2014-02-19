'use strict';

var CharSeparatedTexts = function(texts, separator) {
	this.separator = separator || ' ';
	this.texts = texts.split(this.separator);
};

CharSeparatedTexts.prototype = {
	
	/**
	 * 
	 * @param String prefix
	 * @param Boolean force if true adds the prefix even if it already exists
	 * @returns CharSeparatedTexts
	 */
	addPrefix: function(prefix, force) {
		force = force || false;
		var regexp = new RegExp('^'+prefix+'.*$');
		this.texts = this.texts.map(function(text) {
			if (force || !text.match(regexp))
				return prefix+text;
			else
				return text;
		});
		return this;
	},
	
	join: function(string) {
		return this.texts.join(string);
	},
	
	removePrefix: function(prefix) {
		var regexp = new RegExp('^'+prefix+'(.*)$');
		this.texts = this.texts.map(function(text) {
			return text.replace(regexp, '$1');
		});
		return this;
	}
};
