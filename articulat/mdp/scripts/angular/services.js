'use strict';

/* Services */

var egytcaServices = angular.module('egytcaServices', ['ngResource']);

egytcaServices.factory('Tweet', ['$resource',
	function($resource) {
		return $resource('Main.php', { id: '@Id' }, {
			query: {
				method: 'GET',
				params: { do: 'angulardemoTweetList' },
				isArray: true
			},
			get: {
				method: 'GET',
				params: { do: 'angulardemoTweetEdit' }
			},
			delete: {
				method: 'POST',
				params: { do: 'angulardemoTweetDoDelete' }
			},
			save: {
				method: 'POST',
				params: { do: 'angulardemoTweetDoEdit' },
				headers: { 'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8' },
				transformRequest: function(data, headersGetter) {
					return param({ params: sanitize(data) });
				}
			}
		});
	}
]);



/* ***************************************************** */
/* ******************* utilidades ********************** */
/* ***************************************************** */

var lcfirst = function(string) {
	return string.charAt(0).toLowerCase() + string.substr(1);
}

var sanitize = function(data) {
	var ret = {};
	for (var key in data) {
		if (!key.match(/^\$/))
			ret[lcfirst(key)] = data[key];
	}
	return ret;
}
	
/**
* converts an object to x-www-form-urlencoded serialization.
* @param {Object} obj
* @return {String}
*/ 
var param = function(obj) {
	
	var query = '', name, value, fullSubName, subName, subValue, innerObj, i;
	
	for (name in obj) {
		
		value = obj[name];
		
		if (value instanceof Array) {
			for (i = 0; i < value.length; ++i) {
				subValue = value[i];
				fullSubName = name + '[' + i + ']';
				innerObj = {};
				innerObj[fullSubName] = subValue;
				query += param(innerObj) + '&';
			}
		}
		else if (value instanceof Object) {
			for (subName in value) {
				subValue = value[subName];
				fullSubName = name + '[' + subName + ']';
				innerObj = {};
				innerObj[fullSubName] = subValue;
				query += param(innerObj) + '&';
			}
		}
		else if (value !== undefined && value !== null) {
			query += encodeURIComponent(name) + '=' + encodeURIComponent(value) + '&';
		}
	}
	
	return query.length ? query.substr(0, query.length - 1) : query;
};
