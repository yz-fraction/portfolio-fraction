<article id="article" class="">
 
	<section class="well">
		
		{books}
			
			<div class="media">
				
				<a class="pull-left" href="/book/{ID}/">
					
					<img class="media-object" src="{cover}">
					
				</a>
				
				<div class="media-body">
					
					<?=anchor( 'book/{ID}/' , heading( '{title}' , 5  , 'class="media-heading"' ) , array('title' => lang('The best news!') ) )?>
					
					{author}
					
				</div>
				
			</div>
			
		{/books}
		
	</section>
		
		<?=$this->pagination->create_links()?>
	
</article>