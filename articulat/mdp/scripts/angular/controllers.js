'use strict';

/* Controllers */

var egytcaControllers = angular.module('egytcaControllers', []);

egytcaControllers.controller('TweetListCtrl', ['$scope', 'Tweet',
	function($scope, Tweet) {
		
		$scope.tweets = Tweet.query();

		$scope.order = 'Createdat';
		
		$scope.delete = function(tweet) {
			if (confirm('borrar?')) { 
				tweet.$delete({id: tweet.Id}, function() {
					var index = $scope.tweets.indexOf(tweet);
					if (index > -1)
						$scope.tweets.splice(index, 1);
				});
			}
		};
	}
]);

egytcaControllers.controller('TweetDetailCtrl', ['$scope', '$http', '$routeParams', 'Tweet',
	function($scope, $http, $routeParams, Tweet) {
		$scope.tweet = Tweet.get({ id: $routeParams.tweetId });

		$scope.save = function(tweet){
			$http.post('Main.php?do=angulardemoTweetDoEdit', { 'id': tweet.Id, 'params[text]': tweet.Text });
			//tweet.$save({'id': tweet.Id, 'params[text]': tweet.Text});
		};
	}
]);
