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
<body class="background">
	<?php include("navigation/header.php") ?>
	
	 <header>
      <div class="container heading-main">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1 text-center">
            <h1>Umair Movie Manager</h1>
            <br />
            <p class="lead" data-wow-delay="0.5s">Demo Project showcasing basic CRUD operations using Angular JS and PHP Codeigniter</p>
            <br />
              
            <div class="row">
              <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                <div class="row">
                    <a href="/movie" class="btn btn-primary btn-lg scroll">Go to Movies!</a>
                </div><!--End Button Row-->  
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </header>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
