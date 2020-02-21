<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php get_header(); ?>

<div class="container">
	<h1>
		<?php echo anchor( site_url().'/record/view/'.$record[ 'ID' ].'/' , $record[ 'title' ] ) ; ?>
	</h1>

	<table class="table table-striped table-bordered table-hover">
		<caption>
			<?php echo anchor( site_url().'/episode/all/'.$record[ 'ID' ].'/' , 'Episodes' ) ; ?> / <?php echo $episode[ 'title' ] ; ?>
		</caption>


		<thead>
			<tr>
				<th>Air date</th>
				<th>Description</th>
			</tr>
		</thead>


		<tbody>
			<tr>
				<td>
					<?php echo $episode[ 'date_start' ] ; ?>
				</td>

				<td>
					<?php echo $episode[ 'body' ] ; ?>
				</td>
			</tr>
		</tbody>


	</table>
</div>

<?php get_footer();