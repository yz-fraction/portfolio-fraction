<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php get_header(); ?>

<div class="container">
	<h1>
		<?php echo anchor( site_url().'/record/view/'.$record[ 'ID' ].'/' , $record[ 'title' ] ) ; ?>
	</h1>

	<table>
		<caption>
			<?php echo anchor( site_url().'/season/all/'.$record[ 'ID' ].'/' , 'Seasons' ) ; ?> / <?php echo $season[ 'season_name' ] ; ?>
			<small>
				<small>
				(<?php echo $season[ 'season_start' ] ; ?>&ndash;<?php echo $season[ 'season_finish' ] ; ?>)
			</small>
			</small>
		</caption>


		<thead>
			<tr>
				<th>Episode</th>
				<th>Title</th>
				<th>Air date</th>
			</tr>
		</thead>


		<tbody>
			<?php $i = 1 ; foreach( $episodes as $episode_value ) : ?>
			<tr>
				<td>
					<i>
						<?php echo $i ; ?>
					</i>
				</td>
				<td>
					<?php echo anchor( site_url().'/episode/view/'.$episode_value[ 'ID' ].'/' , $episode_value[ 'title' ] ) ; ?>
				</td>
				<td>
					<?php echo $episode_value[ 'date_start' ] ; ?>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<?php echo $episode_value[ 'body' ] ; ?>
				</td>
			</tr>

			<?php $i++ ; endforeach ; ?>
		</tbody>

	</table>

<?php get_footer();