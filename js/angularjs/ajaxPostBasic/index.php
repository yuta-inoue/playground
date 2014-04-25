<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>AjaxPostBasic</title>
		<script type='text/javascript' src="js/angular.min.js"></script>
		<script type='text/javascript' src="js/angular-sanitize.min.js"></script>
		<script type='text/javascript' src="js/angular-animate.min.js"></script>
		<script type='text/javascript' src="js/script.js"></script>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	
	<body>
		<div ng-app="Basicpost">
			<div ng-controller="BasicpostController">
				<h1>AjaxPostBasic</h1>
				<form name="form" method="post" action="">
					textField : <input ng-model="textField" type="text">{{textField}}<br>
					textField2 : <input ng-model="textField2" type="text">{{textField2}}<br>
					<button type="button" ng-click="doSend();">DoSend</button>
				</form>
				<pre>
					{{result}}
				</pre>
			</div>
		</div>
	</body>
</html>