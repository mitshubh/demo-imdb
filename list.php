<div ng-show="!hiddenVar" class="jumbotron">
	<h2>Actors Matched ::</h2>
    <table class="table table-striped" >
    <thead>
        <tr>
            <th ng-repeat="col in actorKeys">{{col}}</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="key in actorObj">
            <td ng-repeat="col in key"><a href="showInfo/{{key.id}}">{{col}}</a></td>
        </tr>
    </tbody>
	</table>
	<h2>Movies Matched ::</h2>
<table class="table table-striped" >
    <thead>
        <tr>
            <th ng-repeat="col in movieKeys">{{col}}</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="key in movieObj">
            <td ng-repeat="col in key"><a href="showInfo?id={{key.id}}">{{col}}</a></td>
        </tr>
    </tbody>
	</table>
</div>