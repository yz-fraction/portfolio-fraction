<article class="well">
	<?php if ( isset( $form_email_submitted ) ) : ?>
		
		<?php echo heading( lang('form_email_submitted') , 3 , 'class="h1_done"' ); ?>
		
	
	<?php else: ?>
		
		
		<?php echo heading( lang('Change_email') , 1 ); ?>
		<p>
			<span class="label">
				<?php echo lang('Fields_info'); ?>
			</span>
		</p>
		
		<?php echo $message;?>
		
		<?php if ( isset( $form_email_submitted ) ) : ?>
		<p>
			<span class="label label-success">
				<?php echo $form_email_submitted; ?>
			</span>
		</p>
		
		<?php endif; ?>
		
		
		
		<?php echo form_open("auth/change_email/", $form_email );?>
			
			
			<?php echo form_fieldset( lang('Email') ); ?>
				
				<div class="input-prepend">
					<span class="add-on">
						<i class="icon-envelope"></i>
					</span><?php echo form_input( $email ); ?>
				</div>
				
				<?php echo form_error('email'); ?>
				
			<?php echo form_fieldset_close();  ?>
			
			
			<?php echo form_fieldset( lang('Password_current') ); ?>
				
				<?php echo form_input( $password ); ?>
				
				<?php echo form_error('password'); ?>
				
			<?php echo form_fieldset_close();  ?>
			
			
			<?php echo form_submit( $submit ); ?>
			
		<?php echo form_close();?>
	
	
	<?php endif; ?>
</article>