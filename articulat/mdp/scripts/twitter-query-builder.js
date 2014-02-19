'use strict';

var TwitterQueryBuilder = function(origin, destination) {
	
	this.origin = origin;
	this.destination = destination;
	
	this.origin.onsubmit = function() { return false; };
};

TwitterQueryBuilder.prototype = {
	
	query: '',
	
	addAllOfThese: function() {
		this.query += ' '+this.getValueFor('all-of-these');
	},
	
	addAnyOfThese: function() {
		var cst = new CharSeparatedTexts(this.getValueFor('any-of-these'));
		this.query += ' '+cst.join(' OR ');
	},
	
	addExactFrase: function() {
		this.query += ' "'+this.getValueFor('exact-frase')+'"';
	},
	
	addFromAccounts: function() {
		var cst = new CharSeparatedTexts(this.getValueFor('from-accounts'));
		this.query += ' '+cst.addPrefix('from:', true).join(' OR ');
	},
	
	addHashtags: function() {
		var cst = new CharSeparatedTexts(this.getValueFor('hashtags'));
		this.query += ' '+cst.addPrefix('#').join(' OR ');
	},
	
	addLang: function() {
		this.query += ' lang:'+this.getValueFor('lang');
	},
	
	addMentions: function() {
		var cst = new CharSeparatedTexts(this.getValueFor('mentions'));
		this.query += ' '+cst.addPrefix('@').join(' OR ');
	},
	
	addNoneOfThese: function() {
		var cst = new CharSeparatedTexts(this.getValueFor('none-of-these'));
		this.query += ' '+cst.addPrefix('-', true).join(' ');
	},
	
	addToAccounts: function() {
		var cst = new CharSeparatedTexts(this.getValueFor('to-accounts'));
		this.query += ' '+cst.addPrefix('to:', true).join(' OR ');
	},
	
	
	addField: function(value) {
		var pascalCaseField = value.split('-').map(function(e) {
			return e.substring(0, 1).toUpperCase() + e.substring(1).toLowerCase();
		}).join('');
		var fn = 'add'+pascalCaseField;
		this[fn].call(this, value);
	},
	
	addIfNotEmpty: function(field) {
		var value = this.getValueFor(field);
		if (value !== '')
			this.addField(field);
	},
	
	apply: function() {
		this.destination.value = this.build();
	},
	
	build: function() {
		this.query = '';
		this.addIfNotEmpty('all-of-these');
		this.addIfNotEmpty('exact-frase');
		this.addIfNotEmpty('any-of-these');
		this.addIfNotEmpty('none-of-these');
		this.addIfNotEmpty('hashtags');
		this.addIfNotEmpty('from-accounts');
		this.addIfNotEmpty('to-accounts');
		this.addIfNotEmpty('mentions');
		this.addIfNotEmpty('lang');
		return this.query.trim();
	},
	
	getValueFor: function(field) {
		return this.origin.getElementsByClassName(field)[0].value.trim();
	}
};
