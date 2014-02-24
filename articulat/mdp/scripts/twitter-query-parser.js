'use strict';

var TwitterQueryParser = function() {};

TwitterQueryParser.prototype = {
	
	orSymbol: 'OR',
	
	orTypes: [
		'anyWord',
		'hashtag',
		'fromAccount',
		'toAccount',
		'mention'
	],
	
	symbols: [],
	
	groupedSymbols: [],
	
	results: {},
	
	
	cleanAnyWord: function(symbol) {
		return symbol;
	},
	
	cleanBannedWord: function(symbol) {
		return symbol.replace(/^-(.*)/, '$1');
	},
	
	cleanExactFrase: function(symbol) {
		return symbol.replace(/^"(.+)"$/, '$1');
	},
	
	cleanFromAccount: function(symbol) {
		return symbol.replace(/^from:(.*)/, '$1');
	},
	
	cleanHashtag: function(symbol) {
		return symbol.replace(/^#(.*)/, '$1');
	},
	
	cleanLang: function(symbol) {
		return symbol.replace(/^lang:(.*)/, '$1');
	},
	
	cleanMention: function(symbol) {
		return symbol.replace(/^@(.*)/, '$1');
	},
	
	cleanToAccount: function(symbol) {
		return symbol.replace(/^to:(.*)/, '$1');
	},
	
	cleanWord: function(symbol) {
		return symbol;
	},
	
	isBannedWord: function(symbol) {
		return symbol.match(/^-/);
	},
	
	isExactFrase: function(symbol) {
		return symbol.match(/^".+"$/);
	},
	
	isFromAccount: function(symbol) {
		return symbol.match(/^from:/);
	},
	
	isHashtag: function(symbol) {
		return symbol.match(/^#/);
	},
	
	isLang: function(symbol) {
		return symbol.match(/^lang:/);
	},
	
	isMention: function(symbol) {
		return symbol.match(/^@/);
	},
	
	isOr: function(symbol) {
		return symbol.match(this.orSymbol);
	},
	
	isToAccount: function(symbol) {
		return symbol.match(/^to:/);
	},
	
	
	cleanByType: function(symbol, type) {
		return this[this.cleanFnForType(type)](symbol);
	},
	
	cleanFnForType: function(type) {
		return 'clean' + type.substring(0, 1).toUpperCase() + type.substring(1);
	},
	
	cleanGroupByType: function(group, type) {
		return group.map(function(e) {
			return this[this.cleanFnForType(type)](e);
		}, this);
	},
	
	getResults: function() {
		var copy = {};
		for (var key in this.results)
			copy[key] = this.results[key];
		return copy;
	},
	
	getResultsStrings: function() {
		var strings = {};
		for (var key in this.results)
			strings[key] = this.results[key].join(' ');
		return strings;
	},
	
	parse: function(query) {
		
		this.reset()
			.parseSymbols(query)
			.groupSymbols()
			.partialize();
		
		return this;
	},
	
	parseSymbols: function(query) {
		this.symbols = query.match(/[^\s"]+"[^"]*"|[^\s"]+|"[^"]*"/g);
		return this;
	},
	
	groupSymbols: function() {
		
		this.groupedSymbols = [];
		var symbols = this.symbols.slice(0);
		var groupedSymbol = '';
		var loopCount = 0; // infinite loop prevention
		
		while (symbols.length > 0 && loopCount < 1000) { // 1000 seems OK
			
			var symbol = symbols.shift();
			
			if (this.isOr(symbol)) {
				throw 'invalid query';
			} else {
				groupedSymbol += symbol;
				if (symbols.length > 0 && this.isOr(symbols[0])) {
					groupedSymbol += ' '+symbols.shift()+' ';
				} else {
					this.groupedSymbols.push(groupedSymbol);
					groupedSymbol = '';
				}
			}
		}
		
		if (groupedSymbol !== '') {
			this.groupedSymbols.push(groupedSymbol);
			groupedSymbol = '';
		}
		
		return this;
	},
	
	partialize: function() {
		
		var grouped = [];
		var single = [];
		
		this.groupedSymbols.forEach(function (e) {
			
			var elem = e.split(' '+this.orSymbol+' ');
			
			if (elem.length > 1) {
				grouped.push(elem);
			} else {
				single.push(e);
			}
			
		}, this);
		
		this.qweGroup(grouped);
		this.qwe(single);
		
		return this;
	},
	
	qwe: function(elems) {
		
		elems.forEach(function(e) {
			
			var type = this.typeFor(e);
			
			if (this.orTypes.indexOf(type) == -1) {
				this.results[type].push(this.cleanByType(e, type));
			} else {
				if (this.results[type].length == 0) {
					this.results[type].push(this.cleanByType(e, type));
				}
				else
					this.results.word.push(e);
			}
		}, this);
	},
	
	qweGroup: function(groups) {
		
		groups.forEach(function(group) {
			
			var type = this.groupTypeFor(group);
			
			if (type === false || this.orTypes.indexOf(type) == -1) {
				this.results.word.push(group.join(' '+this.orSymbol+' '));
			} else {
				this.results[type] = this.cleanGroupByType(group, type);
			}
		}, this);
	},
	
	reset: function() {
		this.symbols = [];
		this.groupedSymbols = [];
		this.results = {
			word: [],
			bannedWord: [],
			anyWord: [],
			exactFrase: [],
			fromAccount: [],
			toAccount: [],
			hashtag: [],
			lang: [],
			mention: []
		};
		return this;
	},
	
	typeFor: function(symbol) {
		
		if (this.isBannedWord(symbol))
			return 'bannedWord';
		else if (this.isExactFrase(symbol))
			return 'exactFrase';
		else if (this.isFromAccount(symbol))
			return 'fromAccount';
		else if (this.isHashtag(symbol))
			return 'hashtag';
		else if (this.isLang(symbol))
			return 'lang';
		else if (this.isMention(symbol))
			return 'mention';
		else if (this.isToAccount(symbol))
			return 'toAccount';
		else return 'word';
	},
	
	groupTypeFor: function(group) {
		
		var type = null;
		group.forEach(function(e) {
			
			switch(type) {
				case null:
					type = this.typeFor(e);
					break;
				case false:
					break;
				default:
					if (type != this.typeFor(e))
						type = false;
					break;
			}
		}, this);
		
		/*
		 * Si el tipo es word es algo del estilo (word1 OR word2 OR ...)
		 * que corresponde al tipo anyWord.
		 */
		return type == 'word' ? 'anyWord' : type;
	}
};


//var query = 'word1 word2 word3 "exact frase" anyword1 OR anyword2 OR anyword3' +
//	' -noneword1 -noneword2 --noneword3 #hashtag1 OR #hashtag2 OR #hashtag3' +
//	' lang:en from:fromacc1 OR from:fromacc2 OR from:from:fromacc3' +
//	' -vaEnWords OR -vaEnWordsTambien'+
//	' to:toacc1 OR to:toacc2 OR to:to:toacc3 @mention1 OR @mention2 OR @mention3' +
//	' near:"argentina buenos aires" within:15mi :)	 :(	 ? #esteVaEnWords' +
//	' include:retweets "" @vamosEnWords OR #vamosEnWords OR';
//
//var tqp = new TwitterQueryParser();
//var rs = tqp.parse(query).getResultsStrings();
//console.log(rs)
