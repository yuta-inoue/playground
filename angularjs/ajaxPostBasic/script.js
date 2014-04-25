var app = angular.module("Basicpost", ["ngSanitize"]);
app.controller('BasicpostController', function ($scope , $http , $templateCache) {

	var fileData = "";

	var doSendBasic = function(){
		var url = "receive.php";
		var params = {"textField" : $scope.textField , "textField2" : $scope.textField2};
		console.log(params);
		$http({method: "POST" , url: url , data: params , cache: $templateCache}).
			success(function(data, status) {
				console.log("****** this is working ******");
				console.log(data);
				$scope.result = data;
			}).
			error(function(data, status) {
				console.log("Error");
			}
		);
	};

	$scope.textField = "";
	$scope.textField2 = "";
	$scope.result = null;
	$scope.doSend = function(){
		doSendBasic();
	};
});