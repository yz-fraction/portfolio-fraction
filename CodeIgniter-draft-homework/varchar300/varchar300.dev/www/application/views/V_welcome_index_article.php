<article id="article" class="">
	
	<section class="span5">
		
		<?=heading( lang('welcome__Heading_left') )?>
		
		
		<p>
			
			<?=lang('welcome__Paragraph_left')?>
			
		</p>
		
	</section>
 
 
	<section class="span6">
		
		<?=heading( lang('welcome__Heading_right') )?>
		
		{messages}
			
			<blockquote>
				
				<p>
					
					{message}
					
				</p>
				
				
				<small>
					
					<a href="/user/{user_id}/" title="">
						
						{name}
						
					</a>
					
					<!--<i class="icon-time" title="{date}"></i>-->
					
				</small>
				
			</blockquote>
			
		{/messages}
		
	</section>
	
</article>