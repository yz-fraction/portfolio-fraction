<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php get_header(); ?>

<div class="container">
	<h1>
		<?php echo $title ; ?>
	</h1>
	<p>
		<?php echo $body ; ?>
	</p>
	<small>
		<?php echo $date_start ; ?>&ndash;<?php echo $date_finish ; ?>
	</small>
	
	<img class="img-responsive img-rounded" src="<?php echo base_url() . '/uploads/' . $poster_filename ; ?>" />
	
</div>

<?php get_footer();