var app = angular.module("Fileupload", ["ngSanitize"]);
app.controller('FileuploadController', function ($scope , $http , $templateCache) {

	var fileData = "";

	var doSendUploadFile = function(){
		var params = new FormData();
		params.append("mes" , $scope.mes);
		params.append("uploadfile" , fileData);
		var url = "receive.php";
		console.log(params);
		$http(
			{
				method: "POST",
				url: url,
				data: params,
				withCredentials: true,
                headers: {'Content-Type': undefined },
				cache: $templateCache,
				transformRequest: angular.identity
			}).
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

	$scope.mes = "";
	$scope.result = null;

	$scope.uploadFile = function(files){
		console.log(files);
		fileData = (files[0]) ? files[0] : "";
	};

	$scope.doSend = function(){
		doSendUploadFile();
	};
	$scope.openInputFile = function(){
		var dom = document.getElementById("uploadfile");
		console.log(dom);
		dom.click();
	};
});