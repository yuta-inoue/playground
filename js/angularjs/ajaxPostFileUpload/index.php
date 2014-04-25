<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>AjaxPostFileUpload</title>
		<script type='text/javascript' src="js/angular.min.js"></script>
		<script type='text/javascript' src="js/angular-sanitize.min.js"></script>
		<script type='text/javascript' src="js/angular-animate.min.js"></script>
		<script type='text/javascript' src="js/script.js"></script>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	
	<body>
		<div ng-app="Fileupload">
			<div ng-controller="FileuploadController">
				<h1>AjaxPostFileUpload</h1>
				<form name="form" method="post" action="" enctype="multipart/form-data">
					<input ng-model="uploadfile" onchange="angular.element(this).scope().uploadFile(this.files)" id="uploadfile" class="hide" type="file">
					mes : <input ng-model="mes" type="text"><br>
					uploadfile : {{uploadfile}}<br>
					<br>
					<button ng-click="openInputFile()">SelectFile</button>
					<button type="button" ng-click="doSend();">DoSend</button>
				</form>
				<pre>
					{{result}}
				</pre>
			</div>
		</div>
	</body>
</html>