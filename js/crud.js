var myApp = angular.module("myApp",[]);
myApp.controller("myController",function($scope){

	$scope.messageInfo="";

	$scope.newUser = {};

	$scope.users=[ 
		{username: "Moymo", fullname: "Monico Palaboy", email:"inquirer@gmail.com"},
		{username: "Duko", fullname: "Pedro Penduko", email:"abante@gmail.com"},
	];

	$scope.saveUser = function(){
		$scope.users.push($scope.newUser);
		$scope.newUser = {};
		$scope.messageInfo="Records Saved";	
	};

	$scope.selectUser=function(user){ 
		$scope.clickedUser=user;	
	};

	$scope.updateUser=function(){
		$scope.messageInfo="Record was edited";
	};

	$scope.deleteUser = function(){
		$scope.users.splice($scope.users.indexOf($scope.clickedUser),1);
		$scope.messageInfo="Record has been deleted";
	};


});