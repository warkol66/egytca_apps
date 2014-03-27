'use strict';

/* Controllers */

var egytcaControllers = angular.module('egytcaControllers', []);

egytcaControllers.controller('TweetListCtrl', ['$scope', 'Tweet',
	function($scope, Tweet) {
		
		$scope.tweets = Tweet.query();
		
		$scope.order = 'Createdat';
		
		$scope.delete = function(tweet) {
			if (confirm('borrar?')) {
				tweet.$delete(function() {
					var index = $scope.tweets.indexOf(tweet);
					if (index > -1)
						$scope.tweets.splice(index, 1);
				});
			}
		};
	}
]);

egytcaControllers.controller('TweetDetailCtrl', ['$scope', '$routeParams', 'Tweet',
	function($scope, $routeParams, Tweet) {
		$scope.tweet = Tweet.get({ id: $routeParams.tweetId });
		
		$scope.save = function(tweet) {
			tweet.$save();
		};
	}
]);
