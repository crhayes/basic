<html>
<head>
	<title><?= $title ?></title>
</head>
<body>
	<h1>Page Title</h1>
	<? $section('content') ?>
		<p>This is the template content.</p>
	<? $end() ?>

	<? $include('partials/footer.php') ?>
</body>
</html>