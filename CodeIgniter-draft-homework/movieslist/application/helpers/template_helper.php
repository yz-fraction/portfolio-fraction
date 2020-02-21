<?php

function get_header() {

	$file_path	= dirname( dirname(__FILE__) ) . '/views/header.php' ;
	
	is_file( $file_path ) AND file_exists( $file_path ) AND is_readable( $file_path ) AND require_once $file_path ;
}

function get_footer() {

	$file_path	= dirname( dirname(__FILE__) ) . '/views/footer.php' ;
	
	is_file( $file_path ) AND file_exists( $file_path ) AND is_readable( $file_path ) AND require_once $file_path ;
}


function ci_die() {?>
	<html>
		<head>
			<title>Error</title>
			<meta charset="UTF-8">
			<style>
				html {font-size:100.01%;} 
				body {background: white;padding: 0;font-size:62.5%;} 
				.container {font-family: serif;position: relative;background: white;/*height: initial;*/width: initial;margin: 0 auto;padding: 0;resize: both;overflow: auto;text-align: center;} 
				.inlineblock {background: white;color: black;font-size: 4.8em;font-weight: normal;width: initial;height: initial;margin: 0;margin-top: 2em;padding: 0;} 
				.slogan, .ps {font-size: .35em;font-weight: normal;}
			</style>
		</head>
		<body>
			<div class="container">
				<h1 class="inlineblock">Oops.
					<p class="slogan">An error occurred.</p>
					<i class="ps">(Code: 42)</i>
				</h1>
			</div>
		</body>
	</html>
	<?php exit;
}

