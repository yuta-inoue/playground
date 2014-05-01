var app = angular.module("Ngrepeatreplace", ["ngSanitize"]);
app.controller('NgrepeatreplaceContoroller', function ($scope) {

	var obj = function(){
		var obj = {
			val: "hogehoge",
			children : [
				{val: 0},
				{val: 1},
				{val: 2},
				{val: 3}
			]
		};
		return obj;
	};

	$scope.objects = [obj()];
	
	$scope.addParent = function() {
		console.log(this);
		console.log(obj());
		this.objects.push(obj());
	};
	$scope.removeParent = function(indexVal) {
		//console.log(indexVal);
		this.objects.splice(indexVal, 1);
	};
	$scope.replaceParent = function(indexVal) {
		var temp;
		//console.log(this);
		//console.log(this.questions[indexVal]);
		temp = this.objects[indexVal];
		this.objects[indexVal] = this.objects[indexVal + 1];
		this.objects[indexVal + 1] = temp;
	};

	$scope.addChild = function() {
		console.log(this);
		this.object.children.push({val: this.$id});
	};
	$scope.removeChild = function(indexVal) {
		this.object.children.splice(indexVal, 1);
	};
	$scope.replaceChild = function(indexVal) {
		var temp;
		console.log(this);
		//console.log(this.object.children[indexVal]);
		temp = this.object.children[indexVal];
		this.object.children[indexVal] = this.object.children[indexVal + 1];
		this.object.children[indexVal + 1] = temp;
	};
});