<!DOCTYPE html>
<html>
	<head>
		<title>Masa's Free Space</title>
		{% for file in css %}
			<link rel="stylesheet" type="text/css" href="/css/{{ file }}.css">
		{% endfor %}
		{% for val in meta %}
			{{ val }}
		{% endfor %}
	</head>
	<body>
		<h1>front/views/index.volt</h1>
		{{content()}}
		
		<script type="text/javascript" src="/js/angular.min.js"></script>
		<script type="text/javascript" src="/js/angular-animate.min.js"></script>
		<script type="text/javascript" src="/js/angular-sanitize.min.js"></script>
		{% for file in js %}
			<script type="text/javascript" src="/js/{{ file }}.js"></script>
		{% endfor %}
	</body>
</html>
