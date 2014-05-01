<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>AjaxPostBasic</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type='text/javascript' src="js/angular.min.js"></script>
		<script type='text/javascript' src="js/angular-sanitize.min.js"></script>
		<script type='text/javascript' src="script.js"></script>
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