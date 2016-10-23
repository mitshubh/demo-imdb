<!DOCTYPE html>
<html ng-app="movieDB">
<head>
	<meta charset="utf-8">
	<title>Entity Information</title>
	<link rel="stylesheet" href="libs/css/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="libs/css/bootstrap-3.3.7-dist/css/bootstrap-theme.css">
	<link rel="stylesheet" href="views/shubh.css">
</head>
<script type="text/javascript" href="libs/css/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="libs/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="libs/js/angular.min.js"></script>
<script type="text/javascript" src="libs/js/angular-route.min.js"></script>
<script type="text/javascript" src="views/shubh.js"></script>
<body ng-controller="movieCtrl">
	<div class="fixed-nav-bar">
        <div class="col-sm-6 col-sm-offset-3">
            <form method="GET" ng-submit="getRecords()">
                <div class="input-group stylish-input-group">
                    <input type="text" ng-model="query" class="form-control" placeholder="Search for Celebrities, Movies and much more..." >
                    <span class="input-group-addon">
                        <button type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>  
                    </span>
                </div>
            </form>
        </div>
	</div>

</body>	
</html>