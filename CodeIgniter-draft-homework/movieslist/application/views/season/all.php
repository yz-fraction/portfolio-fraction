<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php get_header(); ?>

<div class="container">
	<ol class="list-unstyled">
		<?php foreach ( $seasons as $value ): ?>
		<li>
			<?php echo anchor( site_url() . '/season/view/' . $value[ 'season_ID' ] . '/' , $value[ 'seasons_number' ] ) ; ?>
		</li>
	<?php endforeach ?>
	</ol>
</div>

<?php get_footer();