<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php get_header(); ?>

<div class="container">

	<table class="table table-striped table-bordered table-hover">
		<caption>
			List
		</caption>
		<thead>
			<tr>
				<th>
					Title
				</th>
				<th>
					Description
				</th>
				<th>
					cRUD
				</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach ( $records as $value ): ?>
			<tr>
				<td>
					<?php echo $value->title ; ?>
					
					<img class="img-responsive img-rounded" src="<?php echo base_url() . '/uploads/' . $value->poster_filename ; ?>" />
				</td>

				<td>
					<?php echo $value->body ; ?>
				</td>

				<td>
					<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> 
						<?php echo anchor( site_url() . '/recordCRUD/read/' . $value->ID , 'read' ) ; ?>
					
					<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
						<?php echo anchor( site_url() . '/recordCRUD/update/' . $value->ID , 'update' ) ; ?>
					
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 
						<?php echo anchor( site_url() . '/recordCRUD/delete/' . $value->ID , 'delete' ) ; ?>
				</td>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>


	<?php echo form_open_multipart( 'recordCRUD/create' , array( 'class' => 'form-horizontal' ) ); ?>
	<div class="form-group">
		<fieldset>
			<legend>
				<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> TV-show
			</legend>
			<input class="form-control" name="title" value="" type="text" placeholder="Title" />
			<textarea class="form-control" name="body" rows="10" cols="40" placeholder="Text"></textarea>
			<input class="form-control" type="file" name="userfile" size="20" />
			<input class="form-control btn btn-primary" value="Add new" type="submit" />
		</fieldset>
	</div>
	<?php echo form_close(); ?>

</div>

<?php get_footer();