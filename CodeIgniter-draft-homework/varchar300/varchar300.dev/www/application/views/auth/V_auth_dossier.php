<article class="well">
	<?php if ( $action == 'form_dossier_submitted' ) : ?>
		
		<?php echo heading( lang('form_dossier_submitted') , 3 , 'class="h1_done"' ); ?>
		
		
	<?php elseif ( $action == 'form_dossier_created' ) : ?>
		
		<?php echo heading( lang('form_dossier_created') , 3 , 'class="h1_done"' ); ?>
		
		
	<?php else: ?>

		<h1><?php echo $h1; ?></h1>
		
		<p>
			<span class="label">
				<?php echo lang('Fields_info'); ?>
			</span>
		</p>
		
		<?php if ( isset( $message ) ): ?>
			<?php echo $message; ?>
		<?php endif; ?>
		
		<?php echo form_open( '/auth/'.$action.'/' , $form ); ?>
			
			<?php if ( isset( $email ) ): ?>
				<?php echo form_fieldset( lang('Email') ); ?>
					
					<div class="input-prepend">
						<span class="add-on">
							<i class="icon-envelope"></i>
						</span><?php echo form_input( $email ); ?>
					</div>
					
					<?php echo form_error('email'); ?>
					
				<?php echo form_fieldset_close();  ?>
			<?php endif; ?>
			
			<?php echo form_fieldset( lang('Name') ); ?>
				
				<?php echo form_input( $name ); ?>
				
				<?php echo form_error('name'); ?>
				
			<?php echo form_fieldset_close();  ?>
			
			
			<?php echo form_fieldset( lang('Surname') ); ?>
				
				<?php echo form_input( $surname ); ?>
				
				<?php echo form_error('surname'); ?>
				
			<?php echo form_fieldset_close();  ?>
			
			
			<?php echo form_fieldset( lang('Sex') ); ?>
				
				<?php echo form_radio( $sex['male'] ); ?>
				<?php echo form_label( lang('Male') , 'users_edit_male' , $label_attr ); ?>
				&nbsp;
				<?php echo form_radio( $sex['female'] ); ?>
				<?php echo form_label( lang('Female') , 'users_edit_female' , $label_attr ); ?>
				
				<?php echo form_error('sex'); ?>
				
			<?php echo form_fieldset_close();  ?>
			
			
			<?php echo form_fieldset( lang('Year_of_birhday') ); ?>
				
				<?php echo form_input( $age ); ?>
				
				<?php echo form_error('age'); ?>
				
			<?php echo form_fieldset_close();  ?>
			
			
			<?php echo form_fieldset( lang('City') ); ?>
				
				<?php echo form_input( $city ); ?>
				
				<?php echo form_error('city'); ?>
				
			<?php echo form_fieldset_close();  ?>
			
			
			<?php echo form_fieldset( lang('Country') ); ?>
				
				<?php echo form_dropdown( 'country' , $countries , $country_id , $country ); ?>
				
				<?php echo form_error('country'); ?>
				
			<?php echo form_fieldset_close();  ?>
			
			
			<?php echo form_fieldset( lang('Socium') ); ?>
				
				<?php echo form_input( $socium ); ?>
				
				<?php echo form_error('socium'); ?>
				
			<?php echo form_fieldset_close();  ?>
			
			
			
			<?php if ( $this->uri->segment(2) == 'security_user' ): ?>
				
				
				<?php echo form_fieldset( lang('Password_old') ); ?>
					
					<?php echo form_input( $password_old ); ?>
					
					<?php echo form_error('password_old'); ?>
					
				<?php echo form_fieldset_close();  ?>
				
				
			<?php elseif ( $this->uri->segment(2) == 'create_user' ): ?>
				
				
				<?php echo form_fieldset( lang('Password') ); ?>
					
					<div class="input-prepend">
						<span class="add-on">
							<i class="icon-lock"></i>
						</span><?php echo form_input( $password ); ?>
					</div>
					
					<?php echo form_error('password'); ?>
					
				<?php echo form_fieldset_close();  ?>
				
				
				<?php echo form_fieldset( lang('Password_confirm') ); ?>
					
					<div class="input-prepend">
						<span class="add-on">
							<i class="icon-lock"></i>
						</span><?php echo form_input( $password_confirm ); ?>
					</div>
					
					<?php echo form_error('password_confirm'); ?>
					
				<?php echo form_fieldset_close();  ?>
				
			<?php endif; ?>
			
			<?php echo form_submit( $submit ); ?>
		
		<?php echo form_close(); ?>
	<?php endif; ?>

</article>
