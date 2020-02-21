<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php get_header(); ?>

<div class="container">
	<h1>
		<?php echo $record[ 'title' ] ; ?>
	</h1>
	<p>
		<?php echo $record[ 'body' ] ; ?>
	</p>
	
	<img class="img-responsive img-rounded" src="<?php echo base_url() . '/uploads/' . $record[ 'poster_filename' ] ; ?>" />
	
	<dl class="dl-horizontal">
		<dt>
			Date start:
		</dt>
		<dd>
			<?php echo $record[ 'season_start' ] ; ?>
		</dd>

		<dt>
			Date finish:
		</dt>
		<dd>
			<?php echo $record[ 'season_finish' ] ; ?>
		</dd>

		<dt>
			<?php echo anchor( site_url() . '/season/all/' . $record[ 'ID' ] . '/' , 'Seasons:' ) ; ?>
		</dt>
		<dd>
			<?php echo $record[ 'seasons_count' ] ; ?>
		</dd>

		<dt>
			<?php echo anchor( site_url() . '/episode/all/' . $record[ 'ID' ] . '/' , 'Episodes:' ) ; ?>
		</dt>
		<dd>
			<?php echo $record[ 'episodes_count' ] ; ?>
		</dd>
	</dl>

	<?php foreach( $seasons as $season_key => $season_value ) : ?>
	<table class="table table-striped table-bordered">
		<caption>
			<?php echo anchor( site_url() . '/season/view/' . $season_value[ 'season_ID' ] . '/' , 'Season '.$season_value[ 'seasons_number' ] ) ; ?>
			<small>
				(<?php echo $season_value[ 'date_start' ] ; ?>&ndash;<?php echo $season_value[ 'date_finish' ] ; ?>)
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
			<?php $i = 1 ; foreach( $episodes as $episode_value ) : if( $season_value[ 'season_ID' ] == $episode_value[ 'season_ID' ] ) : ?>
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

			<?php $i++ ; endif ; endforeach ; ?>
		</tbody>


	</table>
	<?php endforeach ; ?>
</div>

<?php get_footer();