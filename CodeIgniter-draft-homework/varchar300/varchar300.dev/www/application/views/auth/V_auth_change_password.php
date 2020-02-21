<article class="well">
	
	<?php echo heading( lang('Change_password') , 1 ); ?>
	
	<p>
		<span class="label">
			<?php echo lang('Fields_info'); ?>
		</span>
	</p>
	
	<p>
		<span class="label label-info">
			<?php echo lang('Fields_info_about_reload'); ?>
		</span>
	</p>
	
	<?php echo $message;?>
	
	
	<?php echo form_open("auth/change_password/" , $form_password );?>
		
		<?php echo form_fieldset( lang('Password_old') ); ?>
			
			<?php echo form_input( $password_old ); ?>
			
			<?php echo form_error('password_old'); ?>
			
		<?php echo form_fieldset_close();  ?>
			
			
		<?php echo form_fieldset( lang('Password_new') ); ?>
			
			<?php echo form_input( $password_new ); ?>
			
			<?php echo form_error('password_new'); ?>
			
		<?php echo form_fieldset_close();  ?>
		
		
		<?php echo form_fieldset( lang('Password_new_confirm') ); ?>
			
			<?php echo form_input( $password_new_confirm ); ?>
			
			<?php echo form_error('password_new_confirm'); ?>
			
		<?php echo form_fieldset_close();  ?>
		
		
		<?php echo form_submit( $submit ); ?>
		
	<?php echo form_close();?>
	
</article>