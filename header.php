</!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
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

	<div ng-show="hiddenVar">
         <div class="init-readme">
            <h2>Real time Movie Database Query System</h2>
            Built by Shubham Mittal using AngularJS, PHP & MySQL
            <br>
        </div>

    </div>
</body>
</html>