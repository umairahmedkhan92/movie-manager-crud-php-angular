<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Umair Movie Manager</title>

	<!-- Bootstrap -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/assets/app.css">
</head>
<body ng-app="movieApp">
	<?php include("navigation/header.php") ?>
	<div class="container" ng-controller="movieController" ng-init="getMovies()">
		<h1>Movies</h1>
		<div class="row">
			<button class="btn btn-primary pull-right" onclick="$('.formData').slideToggle();"><i class="glyphicon glyphicon-plus"></i> Add Movie</button>

			<div class="panel panel-default movies-content">
				<div class="alert alert-danger none"><p></p></div>
				<div class="alert alert-success none"><p></p></div>
				<div class="panel-body none formData">
					<form class="form" name="movieForm">
						<div class="form-group">
							<label>*Title</label>
							<input type="text" class="form-control" name="title" ng-model="movieData.title"  required/>
						</div>
						<div class="form-group">
							<label>*Format</label>
							<select class="form-control" name="format" ng-model="movieData.format"  required>
								<option value="">Select a Format</option>
								<option value="VHS">VHS</option>
								<option value="DVD">DVD</option>
								<option value="Streaming">Streaming</option>
							</select>
						</div>
						<div class="form-group">
							<label>*Length (in Minutes)</label>
							<input type="number" class="form-control" name="length" ng-model="movieData.length" min="1" max="499" required/>
						</div>
						<div class="form-group">
							<label>*Release Year</label>
							<input type="number" class="form-control" name="release_year" ng-model="movieData.release_year" min="1801" max="2099" required/>
						</div>
						<div class="form-group">
							<label>Rating</label><br>
							<span style="font-size: 15px">
							1	
							<i class="glyphicon glyphicon-arrow-left"></i> 
							<i class="glyphicon glyphicon-minus"></i>
							<i class="glyphicon glyphicon-arrow-right"></i> 
							5
							</span>
							<br>
							<input type="radio" value="1" name="rating" ng-model="movieData.rating"/>
							<input type="radio" value="2" name="rating" ng-model="movieData.rating"/>
							<input type="radio" value="3" name="rating" ng-model="movieData.rating"/>
							<input type="radio" value="4" name="rating" ng-model="movieData.rating"/>
							<input type="radio" value="5" name="rating" ng-model="movieData.rating"/>
						</div>
						<a href="javascript:void(0);" class="btn btn-danger" onclick="$('.formData').slideUp();">Cancel</a>
						<button type="submit" class="btn btn-success" ng-hide="movieData.id" ng-click="addMovie(movieForm.$valid)">Add Movie</a>
						<button type="submit" class="btn btn-success" ng-hide="!movieData.id" ng-click="updateMovie(movieForm.$valid)">Update Movie</a>
					</form>
				</div>
				<table id="movieTable" class="table table-striped">
					<tr>
						<th>#</th>
						<th ng-click="sortType = 'title'; sortReverse = !sortReverse">Title <i class="glyphicon glyphicon-sort"></i></th>
						<th ng-click="sortType = 'format'; sortReverse = !sortReverse">Format <i class="glyphicon glyphicon-sort"></i></th>
						<th ng-click="sortType = 'length'; sortReverse = !sortReverse">Length <i class="glyphicon glyphicon-sort"></i></th>
						<th ng-click="sortType = 'release_year'; sortReverse = !sortReverse">Release Year <i class="glyphicon glyphicon-sort"></i></th>
						<th ng-click="sortType = 'rating'; sortReverse = !sortReverse">Rating <i class="glyphicon glyphicon-sort"></i></th>
						<th></th>
					</tr>
					<tr ng-repeat="movie in movies | orderBy:sortType:sortReverse">
						<td>{{$index + 1}}</td>
						<td>{{movie.title}}</td>
						<td>{{movie.format}}</td>
						<td>{{convertLength(movie.length)}}</td>
						<td>{{movie.release_year}}</td>
						<td>{{movie.rating}}</td>
						<td>
							<a href="javascript:void(0);" class="glyphicon glyphicon-edit" ng-click="editMovie(movie)"></a>
							<a href="javascript:void(0);" class="glyphicon glyphicon-trash" ng-click="deleteMovie(movie)"></a>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
	<script src="/assets/app.js" type="text/javascript"></script>
</body>
</html>
