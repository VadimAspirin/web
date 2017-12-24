
angular.module("gameNameModule", ["ngRoute", "ngResource"])

.config(function($routeProvider, $locationProvider){

	$locationProvider.hashPrefix('');

	$routeProvider
		.when('/',
		{
			templateUrl: './assets/start.html'
		})
		.when('/start',
		{
			templateUrl: './assets/start.html'
		})
		.when('/about',
		{
			templateUrl: './assets/about.html'
		})
		.when('/top_list',
		{
			templateUrl: './assets/top_list.html',
			controller: "usersCtrl"
		})
		.when('/game',
		{
			templateUrl: './assets/game.html',
			controller: "gameCtrl"
		})
		.when('/500',
		{
			templateUrl: './assets/500.html'
		})
		.otherwise(
		{
			templateUrl: './assets/404.html'
		});
})

.controller("usersCtrl", function($scope, $resource, $location){

	$resource("?controller=user").query({}, function(data){
		$scope.users = data;
	}, function(){
		$location.path('/500');
	});
})

.controller("menuCtrl", function($scope, $resource, $location){

	$resource("?controller=menu").query({}, function(data){
		$scope.items = data;
	}, function(){
		$location.path('/500');
	});
	
	$scope.checkCurrentPath = function() {
		return $location.path();
	}
})

.directive("menu", function(){

	return {
		restrict: 'E',
		replace: true,
		scope: {},
		templateUrl: "./assets/menu.html",
		controller: "menuCtrl"
	}
})

.factory("commonVariables", function($timeout) {

        function commonVariables() {
            var self = this;
            
            self.maxX = 955;
			self.maxY = 520;
            
            self.level = 1;
			self.isGameOver = false;
            
            self.game_object_x;
			self.game_object_y;
			self.game_object_x_length;
			self.game_object_y_length;
        }

        return new commonVariables();

    })

.controller("gameCtrl", function($scope, $interval, $timeout, commonVariables, $resource, $location){
	
	$scope.service = commonVariables;
	
	$scope.score = 0;
	
	var maxlvl = 3;
	$scope.enemyLengthX = 25;
	$scope.enemyLengthY = 25;
	
	var createEnemies = function(){
	
		$scope.enemies = []
		$interval(function(){
			//var iterations = Math.random() * (5 - 1) + 1; // количество за раз
			var iterations = Math.random() * 7 + commonVariables.level; // количество за раз
			for(var i = 0; i < iterations; i++)
				$scope.enemies.push({x: Math.random() * (commonVariables.maxX - 0) + 0, y: 0, visibility: "visible"});
			i++;
		}, 2000, 5 * commonVariables.level); // arg1 - время между шагами , arg2 - шагов на level
	}
	
	$timeout(createEnemies(), 10);
	
	var enemiesAnim = $interval(function(){
		
		$scope.enemies.forEach(function(item, index, object) {
			
			if(item.y < 520) {
				item.y += 10; // расстояние
				
				if(checkCrash(item.x, item.y)){ // game over
					commonVariables.isGameOver = true;
					$interval.cancel(enemiesAnim);
				}
				
			} else {
				item.visibility = "hidden";
				object.splice(index, 1);
				
				adderScore();
				
				if($scope.enemies.length == 0){
					if(commonVariables.level < maxlvl){
						commonVariables.level++;
						createEnemies();
					}else{
						commonVariables.isGameOver = true;
						$interval.cancel(enemiesAnim);
					}
				}
			}
		});
	}, 100); // скорость
	
	var checkCrash = function(xEnemy, yEnemy){
		
		return !(commonVariables.game_object_y > yEnemy + $scope.enemyLengthY || 
				commonVariables.game_object_y + commonVariables.game_object_y_length < yEnemy || 
				commonVariables.game_object_x + commonVariables.game_object_x_length < xEnemy || 
				commonVariables.game_object_x > xEnemy + $scope.enemyLengthX);
	}
	
	var adderScore = function(){
		$scope.score += 10 * commonVariables.level;
	}
	
	$scope.sendUser = function(userName){
		
		$resource("?controller=user").save({}, { id: "0", name: userName, score: $scope.score}, function(){
			$location.path('/top_list');
		}, function(){
			$location.path('/500');
		});
	}
	
})

.directive('keypressevent', function($document) {
	return {
		restrict: 'E',
		replace: true,
		scope: true,
		link: function postLink(scope, element, attrs){
			$document.on('keydown', function(event){
				scope.$apply(scope.keyPressed(event));
			});
		}
	};
})

.controller("game_objectCtrl", function($scope, commonVariables, $resource, $location, $interval){

	$scope.speed = 1;
	$scope.img = "./img/game_object_1.png";
	
	var spaceships;
	$resource("?controller=game_object").query({}, function(data){
		spaceships = data;
	}, function(){
		$location.path('/500');
	});
	
	$scope.service = commonVariables;
	
	commonVariables.game_object_x = 500;
	commonVariables.game_object_y = 275;
	commonVariables.game_object_x_length = 50;
	commonVariables.game_object_y_length = 100;
	
	var currentLvl;
	var updateSpaceship = $interval(function(){
		if(commonVariables.isGameOver)
			$interval.cancel(updateSpaceship);
		if(currentLvl != commonVariables.level){
			currentLvl = commonVariables.level;
			$scope.speed = spaceships[currentLvl-1].speed;
			$scope.img = spaceships[currentLvl-1].image;
		}
		
		
	}, 800);
	
	$scope.keyCode = 0;
	$scope.keyPressed = function(event) {
		$scope.keyCode = event.which;
		
		if(event.which == 38){
			if(commonVariables.game_object_y - 2 * $scope.speed >= 0)
				commonVariables.game_object_y -= 2 * $scope.speed;
		}else if(event.which == 40){
			if(commonVariables.game_object_y + 2 * $scope.speed <= commonVariables.maxY - commonVariables.game_object_y_length)
				commonVariables.game_object_y += 2 * $scope.speed;
		}else if(event.which == 37){
			if(commonVariables.game_object_x - 2 * $scope.speed >= 0)
				commonVariables.game_object_x -= 2 * $scope.speed;
		}else if(event.which == 39){
			if(commonVariables.game_object_x + 2 * $scope.speed <= commonVariables.maxX - commonVariables.game_object_x_length)
				commonVariables.game_object_x += 2 * $scope.speed;
		}
	};
})

.directive("gameobject", function(){

	return {
		restrict: 'E',
		replace: true,
		scope: {},
		templateUrl: "./assets/game_object.html",
		controller: "game_objectCtrl"
	}
})
