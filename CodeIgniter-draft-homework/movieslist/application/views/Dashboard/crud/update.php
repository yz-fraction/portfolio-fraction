<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php get_header(); ?>

<div class="container">
	
	<!--TV-show-->
	<?php echo form_open_multipart( 'recordCRUD/update/'.$record[ 'ID' ] , array( 'class' => 'form-horizontal' ) ); ?>
		<div class="form-group">
			<?php echo form_fieldset( 'Update' ) ; ?>
			<?php echo form_input( 'title' , $record[ 'title' ] , array( 'class' => 'form-control' , 'placeholder' => 'Title' ) ) ; ?>
			<?php echo form_textarea( 'body' , $record[ 'body' ] , array( 'class' => 'form-control' , 'placeholder' => 'Вуіскшзешщт' ) ) ; ?>
			<input class="form-control" type="file" name="userfile" size="20" />
			<?php echo form_submit( '' , 'Update' , array( 'class' => 'btn btn-success' ) ) ; ?>
			<?php echo form_fieldset_close() ; ?>
		</div>
	<?php echo form_close(); ?>


	<!--Season-->
	<?php echo form_open( 'seasonCRUD/create' , array( 'class' => 'form-horizontal' ) ) ; ?>
		<div class="container">
			<?php echo form_fieldset( '<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Season' ) ; ?>
				<?php if( ! empty( $seasons ) ) { end( $seasons ) ; echo form_dropdown( '' , $seasons , key( $seasons ) ) ; } ?>
				<?php echo form_hidden( 'record_ID' , $record[ 'ID' ] ) ; ?>
				<?php echo form_submit( '' , 'Add new season' , array( 'class' => 'btn btn-primary' ) ) ; ?>
			<?php echo form_fieldset_close() ; ?>
		</div>
	<?php echo form_close(); ?>


	<!--Episode-->
	<?php echo form_open( 'episodeCRUD/create' , array( 'class' => 'form-horizontal' ) ) ; ?>
		<div class="form-group">
			<?php echo form_fieldset( '<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Episode' ) ; ?>
			<?php echo form_input( 'title' , '' , array( 'class' => 'form-control' , 'placeholder' => 'Title' ) ) ; ?>
			<?php echo form_textarea( 'body' , '' , array( 'class' => 'form-control' , 'placeholder' => 'Description' ) ) ; ?>
			<div class="form-group">
				<label class="col-sm-2 control-label">Season:</label>
				<div class="col-sm-10">
					<?php if( ! empty( $seasons ) ) { end( $seasons ) ; echo form_dropdown( 'season_ID' , $seasons , key( $seasons ) ) ; } ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Air date:</label>
				<div class="col-sm-10">
					<input name="date_start" type="date" />
				</div>
			</div>
			
			
			<?php echo form_hidden( 'record_ID' , $record[ 'ID' ] ) ; ?>
			<?php echo form_submit( '' , 'Add new episode' , array( 'class' => 'btn btn-primary' ) ) ; ?>
			<?php echo form_fieldset_close() ; ?>
		</div>
	<?php echo form_close(); ?>
</div>

<?php get_footer();