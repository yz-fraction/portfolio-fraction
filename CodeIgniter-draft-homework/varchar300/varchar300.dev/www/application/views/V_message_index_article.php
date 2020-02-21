<article>
		
		<?if (isset( $messages ) ) foreach( $messages as $key => $value ): ?>
		
		<blockquote>
			
			<p>
				<?=$value['message']?>&nbsp;
			</p>
				
			
			<small>
				
				<a href="/user/<?=$value['user_id']?>/" title="">
					
					<?=$value['name']?>
					
				</a>
				 
				<a href="/messages/<?=$value['id']?>/" class="inactive">
					
					<i class="icon-share" title="<?=lang('icon__view_message')?>"></i>
					
				</a>
				
			</small>
			
			<?if ( $this->ion_auth->logged_in() ) : ?>
			<a class="btn btn-danger btn-mini pull-right"
				 href="/messages/delete/<?=$value['id']?>/"
				 title="control_delete">
				
				<i class="icon-trash icon-white"></i>
				
				 Delete
			</a>
			<?endif?>
			
		</blockquote>
		
		<?endforeach?>
		
		<?=$this->pagination->create_links()?>
	
</article>