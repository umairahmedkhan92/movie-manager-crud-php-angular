// define application
angular.module("movieApp", []).controller("movieController", function($scope,$http){
    $scope.movies = [];
    $scope.movieData = {};
    // function to get records from the database
    $scope.getMovies = function(){
        $http.get("/movie/view")
        .success(function(response){
            if(response.status == 'OK'){
                $scope.movies = response.records;
            }
        });
    };
    
    // function to insert or update movie data to the database
    $scope.saveMovie = function(type){
        var data = $.param({
            'data':$scope.movieData,
            'type':type
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post("/movie/"+type, data, config).success(function(response){
            if(response.status == 'OK'){
                if(type == 'edit'){
                    $scope.movies[$scope.index].id = $scope.movieData.id;
                    $scope.movies[$scope.index].title = $scope.movieData.title;
                    $scope.movies[$scope.index].format = $scope.movieData.format;
                    $scope.movies[$scope.index].length = $scope.movieData.length;
                    $scope.movies[$scope.index].release_year = $scope.movieData.release_year;
                    $scope.movies[$scope.index].rating = $scope.movieData.rating;
                }else{
                    $scope.movies.push({
                        id:response.data.id,
                        title:response.data.title,
                        format:response.data.format,
                        length:response.data.length,
                        release_year:response.data.release_year,
                        rating:response.data.rating
                    });
                    
                }
                $scope.movieForm.$setPristine();
                $scope.movieData = {};
                $('.formData').slideUp();
                $scope.messageSuccess(response.msg);
            }else{
                $scope.messageError(response.msg);
            }
        });
    };
    
    // function to add movie data
    $scope.addMovie = function(isValid){
        if(isValid){
            $scope.saveMovie('add');
        }
    };
    
    // function to edit movie data
    $scope.editMovie = function(movie){
        $scope.movieData = {
            id:movie.id,
            title:movie.title,
            format:movie.format,
            length:parseInt(movie.length),
            release_year:parseInt(movie.release_year),
            rating:movie.rating
        };
        $scope.index = $scope.movies.indexOf(movie);
        $('.formData').slideDown();
    };
    
    // function to update movie data
    $scope.updateMovie = function(isValid){
        if(isValid){
            $scope.saveMovie('edit');
        }
    };
    
    // function to delete movie data from the database
    $scope.deleteMovie = function(movie){
        var conf = confirm('Are you sure you want to delete the movie?');
        if(conf === true){
            var data = $.param({
                'id': movie.id
            });
            var config = {
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }    
            };
            $http.post("/movie/delete",data,config).success(function(response){
                if(response.status == 'OK'){
                    var index = $scope.movies.indexOf(movie);
                    $scope.movies.splice(index,1);
                    $scope.messageSuccess(response.msg);
                }else{
                    $scope.messageError(response.msg);
                }
            });
        }
    };
    
    // function to display success message
    $scope.messageSuccess = function(msg){
        $('.alert-success > p').html(msg);
        $('.alert-success').show();
        $('.alert-success').delay(5000).slideUp(function(){
            $('.alert-success > p').html('');
        });
    };
    
    // function to display error message
    $scope.messageError = function(msg){
        $('.alert-danger > p').html(msg);
        $('.alert-danger').show();
        $('.alert-danger').delay(5000).slideUp(function(){
            $('.alert-danger > p').html('');
        });
    };

    $scope.convertLength = function(length){
        var hours = Math.floor(length / 60);          
        var minutes = length % 60;

        if(hours > 0){
            length = hours+' hr '+minutes+' m';
        }
        else{
            length = minutes+' m';
        }

        return length;
    }
});