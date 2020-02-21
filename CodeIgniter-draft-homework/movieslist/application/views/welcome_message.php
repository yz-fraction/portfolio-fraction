<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php get_header(); ?>

<div class="container">
	<div class="jumbotron">
		<h1>Welcome to Movies list!</h1>
	</div>
		
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>
					<span class="glyphicon glyphicon-star" aria-hidden="true"></span> Title
				</th>
				<th>
					<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Description
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $records as $value ): ?>
			<tr>
				<td><?php echo anchor( site_url() . '/record/view/' . $value->ID . '/' , $value->title ) ; ?></td>
				<td><?php echo $value->body ; ?></td>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>

</div>

<?php get_footer();