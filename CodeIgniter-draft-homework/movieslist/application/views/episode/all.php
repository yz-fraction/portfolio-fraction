<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php get_header(); ?>

<div class="container">
	<h1>
		<?php echo anchor( site_url().'/record/view/'.$record[ 'ID' ].'/' , $record[ 'title' ] ) ; ?>
	</h1>
	<ol>
		<?php foreach ( $episodes as $value ): ?>
		<li>
			<?php echo anchor( site_url() . '/episode/view/' . $value[ 'ID' ] . '/' , $value[ 'title' ] ) ; ?>
		</li>
	<?php endforeach ?>
	</ol>
</div>

<?php get_footer();