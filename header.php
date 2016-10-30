<head>
        <meta charset="utf-8">
        <title>Movie Database</title>
        <link rel="stylesheet" href="libs/css/bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="libs/css/bootstrap-3.3.7-dist/css/bootstrap-theme.css">
        <link rel="stylesheet" href="views/shubh.css">
        <!-- <script src="jquery.min.js"></script>
        <script src="bootstrap.min.js"></script> -->
</head>

<script type="text/javascript" href="libs/css/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="libs/js/jquery-3.1.1.min.js"></script>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top textColor">
    <a class="navbar-brand" href="/~cs143" style="color: aliceblue;"><b>Query Analyzer (Home)</b></a>
        <ul class="nav navbar-nav">
            <li><a href="addActor.php" style="color: aliceblue;">Add Actor/Director</a></li>
            <li><a href="addMovie.php" style="color: aliceblue;">Add Movie Info</a></li>
            <li><a href="addMovieActorRelation.php" style="color: aliceblue;">Add Movie/Actor</a></li> 
            <li><a href="addMovieDirectorRelation.php" style="color: aliceblue;">Add Movie/Director</a></li> 
        </ul>
        <ul>
            <form method="GET" action="getAllRecords.php" class="navbar-form navbar-right searchBar" role="search">
                <div class="input-group stylish-input-group">
                    <input type="text" name="query" class="form-control searchBox" placeholder="Search for Celebrities, Movies and much more....." style="width: 606px;">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default" style="background-color: gainsboro;">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </form>
        </ul>
    </div>
    <div class="container" style="margin-top:50px">