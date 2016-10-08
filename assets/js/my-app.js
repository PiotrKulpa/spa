var app = angular.module('Zespol', []);


//Filtr umożliwiający wstawienie scope jako link url
app.filter('trustAsResourceUrl', ['$sce', function($sce) {
    return function(val) {
        return $sce.trustAsResourceUrl(val);
    };
}]);


app.controller('MusicCtrl', function($scope, $http){
	
	$http.get("http://tolmax.type.pl/assets/php/music.php")
    .then(function (response) {$scope.names = response.data.records;});

    

  

	$scope.mysrctest = "http://tolmax.type.pl/uploads/music/01.Rehab.mp3";
	$scope.myCategory = {
        "Id rosnąco" : {wartosc : "id"},
        "Id malejąco" : {wartosc : "-id"},
        "Tytuł rosnąco" : {wartosc : "title"},
		"Tytuł malejąco" : {wartosc : "-title"}
    }


 
});

//Filtr zamieniajacy podłogi na spacje dla bezpieczenstwa bazy danych mtitle przechowuje nazwy z podłogami
app.filter('myFormat', function() {
    return function(x) {
        var i, c, txt = "";
        for (i = 0; i < x.length; i++) {
            c = x[i].replace(/_/g, " ");
            
            txt += c;
        }
        return txt;
    };
});

/////////

app.controller('VideoCtrl', function($scope, $http){
	
	$http.get("http://tolmax.type.pl/assets/php/video.php")
    .then(function (response) {$scope.names = response.data.records;});
	
	
	$scope.myCategory = {
        "Id rosnąco" : {wartosc : "id"},
        "Id malejąco" : {wartosc : "-id"},
        "Tytuł rosnąco" : {wartosc : "title"},
		"Tytuł malejąco" : {wartosc : "-title"}
    }


 
});

app.controller('PhotosCtrl', function($scope, $http){
	
	$http.get("http://tolmax.type.pl/assets/php/photos.php")
    .then(function (response) {$scope.names = response.data.records;});
	
	
	$scope.myCategory = {
        "Id rosnąco" : {wartosc : "id"},
        "Id malejąco" : {wartosc : "-id"},
        "Tytuł rosnąco" : {wartosc : "title"},
		"Tytuł malejąco" : {wartosc : "-title"}
    }
 
});






