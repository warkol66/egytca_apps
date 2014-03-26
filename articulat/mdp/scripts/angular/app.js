'use strict';

/* App Module */

var egytcaApp = angular.module('egytcaApp', [
	'ngRoute',
	'egytcaControllers',
	'egytcaServices'
]);

egytcaApp.config(['$routeProvider',
	function($routeProvider) {
		$routeProvider
			.when('/tweets', {
				templateUrl: 'partials/tweet-list.html',
				controller: 'TweetListCtrl'
			})
			.when('/tweets/:tweetId', {
				templateUrl: 'partials/tweet-detail.html',
				controller: 'TweetDetailCtrl'
			})
			.otherwise({
				redirectTo: '/tweets'
			});
	}
]);
