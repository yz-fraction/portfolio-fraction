<article class="well">
	
	<div class="media">
		
		<img class="media-object pull-left" src="{cover}">
		
		
		<div class="media-body">
			
			<h4 class="media-heading">
				
				{title}
				
			</h4>
			
			{author}
			
		</div>
		
		
		<ul class="unstyled">
			
			{rubrics}
				
				<li>
					
					<?=anchor( '/rubric/{rubric_ID}/' , '<i class="icon-tag"></i> {rubric}' )?>
					
				</li>
				
			{/rubrics}
			
		</ul>
		
		
		<ul class="unstyled">
			
			<li>
				
				<?=anchor( '/book/{ID}/edit/' , '<i class="icon-edit"></i> '.lang('Edit') )?>
				
			</li>
			
			<li>
				
				<?=anchor( '/book/{ID}/delete/' , '<i class="icon-trash"></i> '.lang('Delete') )?>
				
			</li>
			
		</ul>
		
	</div>
	
</article>