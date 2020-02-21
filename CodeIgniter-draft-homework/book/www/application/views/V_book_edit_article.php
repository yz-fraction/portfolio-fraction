<article class="well" data-action="{URL_ru}">
	
	<? if ( isset( $insert_success ) ) : ?>
	<div class="alert alert-success">
		
		<button type="button" class="close" data-dismiss="alert">×</button>
		
		<strong><?=lang('form_success')?></strong>
		
		 <?=$insert_success?>
		
	</div>
	
	<div class="alert alert-info">
		
		<button type="button" class="close" data-dismiss="alert">×</button>
		
		<strong><?=lang('form_incidentally')?></strong>
		
		 <?=lang('form_add_more')?>
		
	</div>
	<?endif?>
	
	<? if ( isset( $insert_error ) ) : ?>
	<div class="alert alert-error">
		
		<button type="button" class="close" data-dismiss="alert">×</button>
		
		<strong><?=lang('form_error')?></strong>
		
		 <?=$insert_error?>
		
	</div>
	<?endif?>
	
	<? if ( isset( $update_success ) ) : ?>
	<div class="alert alert-success">
		
		<button type="button" class="close" data-dismiss="alert">×</button>
		
		<strong><?=lang('form_success')?></strong>
		
		 <?=$update_success?>
		
	</div>
	<?endif?>
	
	<? if ( isset( $update_error ) ) : ?>
	<div class="alert alert-error">
		
		<button type="button" class="close" data-dismiss="alert">×</button>
		
		<strong><?=lang('form_error')?></strong>
		
		 <?=$update_error?>
		
	</div>
	<?endif?>
	
	<? if ( isset( $upload_error ) AND $upload_error ) : ?>
	<div class="alert alert-error">
		
		<button type="button" class="close" data-dismiss="alert">×</button>
		
		<strong><?=lang('form_error')?></strong>
		
		 <?=$upload_error?>
		
	</div>
	<?endif?>
	
	<? if ( isset( $upload_success ) AND $upload_success ) : ?>
	<div class="alert alert-success">
		
		<button type="button" class="close" data-dismiss="alert">×</button>
		
		<strong><?=lang('form_success')?></strong>
		
		 <?=lang('upload_success')?>
		
	</div>
	<?endif?>
		
		<div class="media">
			
			<?=form_open_multipart( '' , $form )?>
				
				<?=form_hidden( 'ID' , $ID )?>
				
				<?=form_hidden( 'action' , $ID )?>
				
				<a class="pull-left" href="/book/<?=$ID?>/">
					
					<img class="media-object" src="<?=$cover?>">
					
				</a>
				
				<div class="media-body">
					
					<?=form_input( $title )?>
					
				</div>
				
				<?=form_input( $author )?>
				
				<?=form_error('title')?>
				<?=form_error('author')?>
				
				<div class="control-group">
					
					<?=form_upload( $userfile )?>
					
				</div>
				
				
				<div class="control-group">
					
					<label class="checkbox">
						
						<ul id="rubrics" class="unstyled">
							
							<?foreach( $rubrics as $key => $value ):?>
								
								<li>
									
									<?=form_checkbox( 'rubrics[]' , $value['ID'] , $value['checked'] )?>
									
									<?=$value['rubric']?>
									
								</li>
								
							<?endforeach?>
							
						</ul>
						
					</label>
					
					<?=form_error('rubrics[]')?>
					
				</div>
				
				
				<div class="control-group">
					
					<?=form_submit( $submit )?>
					
					<button id="UploadButton" class="UploadButton btn hide">
						
						<?=lang('upload_Poster_upload')?>
						
					</button>
					
				</div>
				
				<div id="loading" class="progress progress-striped active hide">
					<div class="bar" style="width: 100%"></div>
				</div>
				
				
			<?=form_close()?>
			
			
			
		</div>
	
	
</article>