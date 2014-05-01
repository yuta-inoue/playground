<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>NgRepeatReplaceContents</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type='text/javascript' src="js/angular.min.js"></script>
		<script type='text/javascript' src="js/angular-sanitize.min.js"></script>
		<script type='text/javascript' src="script.js"></script>
	</head>
	
	<body>
		<div ng-app="Ngrepeatreplace">
			<div ng-controller="NgrepeatreplaceContoroller">
				<h1>NgRepeatReplaceContents</h1>
				<strong>this.$id is {{this.$id}} , $$childTail.$id is {{$$childTail.$id}}</strong>
				<div><a href="" ng-click="addParent()">Add Parent</a></div>
				<div ng-repeat="object in objects">
					<div class="box">
						<strong>$index is {{$index}} , this.$id is {{this.$id}}</strong>
						<div><a href="" ng-click="addChild()">Add Child</a></div>
						<div class="box" ng-repeat="child in object.children">
							<strong>[{{$index}}]</strong> , child.val is {{child.val}}
							<div>
								<a href="" ng-click="removeChild($index)">Remove Child</a>
								<hr>
								<div ng-if="!$last">
									<a href="" ng-click="replaceChild($index)">{{$index}} ⇔ {{$index + 1}} Replace Child</a>
								</div>
							</div>
						</div>
						<div><a href="" ng-click="removeParent($index)">Remove Parent</a></div>
						<input type="text" ng-model="object.val">
					</div>
					<div ng-if="!$last">
						<a href="" ng-click="replaceParent($index)">{{$index}} ⇔ {{$index + 1}} Replace Parent</a>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>