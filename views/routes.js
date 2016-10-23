var app = angular.module("movieDB", ["ngRoute"]);

app.config(function($routeProvider) {
  $routeProvider
  .when("/", {
    templateUrl : "index.php", controller: 'movieCtrl'
  })
  .when("/showInfo", {
    templateUrl : "info.php"
  })
  .when("/header", {
    templateUrl : "info.html"
  });
});
