var app = angular.module('movieDB', []);
app.controller('movieCtrl', function($scope, $http) {

	$scope.hiddenVar = true;
    
    $scope.getRecords = function() {
    	if ($scope.query=="") {
    		$scope.hiddenVar = true;
    		return;
    	}
    	$scope.hiddenVar = false;
    	$http({
    		url: "getAllRecords.php", 
		    method: "GET",
		    params: {query: $scope.query}
    	}).success(function(response){
	        $scope.actors = response.actorRecords;
	        $scope.movies = response.movieRecords;
	        $scope.actorObj = $scope.actors[0];
	        $scope.movieObj = $scope.movies[0];
	        $scope.actorKeys = Object.keys($scope.actors[0][0]);
	        $scope.movieKeys = Object.keys($scope.movies[0][0]);
    	});
    };
});