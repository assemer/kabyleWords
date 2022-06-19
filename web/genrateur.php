<?php

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="dist/css/style.css">
</head>
<body>

	<div class="main">
		<h2>Kabyle Phrase Generator </h2>
		<div class="searchbox">
<textarea type="text" spellcheck="false" id='textPlace' placeholder="Search Words">
			</textarea>
			<button class="btn" onclick="GenerateText(document.getElementById('textPlace'))">GenerateText</button>
		</div>
	</div>

</body>
</html>

<script type="text/javascript " src="dist/js/app.js"></script>