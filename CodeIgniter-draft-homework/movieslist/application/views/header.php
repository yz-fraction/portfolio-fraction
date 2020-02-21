<?php
# Variables.
$CI =& get_instance();
$dashboard_URI	= array(
	'dashboard' ,
	'recordCRUD'
) ;
$class_dashboard	= in_array( $CI->uri->segment(1) , $dashboard_URI ) ? ' navbar-inverse' : '' ;

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	
	<body>
		<nav class="navbar navbar-default<?php echo $class_dashboard ; ?>">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<?php if( $CI->uri->segment(1) ) : ?>
					<a class="navbar-brand" href="<?php echo site_url() ; ?>">../</a>
				<?php else : ?>
					<span class="navbar-brand">/</spana>
				<?php endif ; ?>
			  </div>

			  <!-- Collect the nav links, forms, and other content for toggling -->
			  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				
				<ul class="nav navbar-nav navbar-right">
				  <li>
					
					<a href="<?php echo site_url() . '/dashboard/' ; ?>"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard</a>
				  </li>
				</ul>
			  </div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
		