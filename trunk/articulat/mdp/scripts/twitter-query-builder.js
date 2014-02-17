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
		this.query += ' '+this.getValueFor('any-of-these').replace(/ /g, ' OR ');
	},
	
	addExactFrase: function() {
		this.query += ' "'+this.getValueFor('exact-frase')+'"';
	},
	
	addFromAccounts: function() {
		this.query += ' '+this.prepend('from:', 'from-accounts');
	},
	
	addHashtags: function() {
		this.query += ' '+this.prepend('#', 'hashtags');
	},
	
	addLang: function() {
		this.query += ' '+this.prepend('lang:', 'lang');
	},
	
	addMentions: function() {
		this.query += ' '+this.prepend('@', 'mentions');
	},
	
//	addNear: function() {
//		this.query += ' near:"'+this.getValueFor('near')+'" within:15mi';
//	},
	
	addNoneOfThese: function() {
		this.query += ' '+this.prepend('-', 'none-of-these');
	},
	
	addToAccounts: function() {
		this.query += ' '+this.prepend('to:', 'to-accounts');
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
//		this.addIfNotEmpty('near');
		return this.query.trim();
	},
	
	getValueFor: function(field) {
		return this.origin.getElementsByClassName(field)[0].value.trim();
	},
	
	prepend: function(text, field) {
		return text + this.getValueFor(field).replace(/ /g, ' '+text);
	}
};
