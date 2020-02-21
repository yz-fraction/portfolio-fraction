<article class="well">

	<?=heading( lang('Login') , 1 , 'class=""' )?>
    
	<p>
		<span class="label">
			<?=lang('Please_login_with_email_and_password')?>
		</span>
	</p>
	<p>
		<span class="label label-info">
			vladimir@example.com
		</span>
	</p>
	<p>
		<span class="label label-info">
			Passw0rd
		</span>
	</p>
	
	<div id="infoMessage"><?=$message;?></div>
	
    <?=form_open("auth/login");?>
		
		<?=form_fieldset( lang('Email') )?>
			
			<div class="input-prepend">
				<span class="add-on">
					<i class="icon-envelope"></i>
				</span><?=form_input($identity );?>
			</div>
			
			<?=form_error('identity')?>
			
		<?=form_fieldset_close();  ?>
		
		
		<?=form_fieldset( lang('Password') )?>
			
			<div class="input-prepend">
				<span class="add-on">
					<i class="icon-lock"></i>
				</span><?=form_input($password);?>
			</div>
			
			<?=form_error('password')?>
			
		<?=form_fieldset_close();  ?>
		
		
		<?=form_fieldset( lang('Remember_me') )?>
			
			<label for="remember" class="checkbox">
				
				<?=form_checkbox('remember', '1', FALSE, 'id="remember"');?>
				
			</label>
		  
		<?=form_fieldset_close();  ?>
		
		
		<?=form_submit( 'submit', lang('form_auth_login_submit') , 'class="btn"');?>
		
    <?=form_close();?>

</article>
