<?if ( ! $this->input->is_ajax_request_form() ): ?>
<article class="well">
	
	<?if ( ! isset( $form ) ) :?>
		
		<?=heading( lang('form_message_submitted') , 3 , 'class="h1_done"' )?>
		
	<?else:?>
		
		<?=form_open('messages/add/' , $form )?>
			
			<?=form_fieldset( lang('Message') )?>
				
				<?=form_textarea( $form_message )?>
				
				<?=form_error('message')?>
				
			<?=form_fieldset_close();  ?>
			
			
			<?=form_submit( $form_submit )?>
			
		<?=form_close()?>

	<?endif?>
</article>

<?else:?>

<?endif?>
