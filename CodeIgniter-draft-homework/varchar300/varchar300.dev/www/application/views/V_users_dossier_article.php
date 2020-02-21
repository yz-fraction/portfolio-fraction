<article class="well">
	
	<?if ( isset( $messages ) ) foreach( $messages as $key => $value ): ?>
	
	<dl class="dl-horizontal tooltip_title">
		
		<dt  class=""
			 rel="tooltip"
			 title="<?=$value['date']?>">
			
			<?=$value['date']?>
			
		</dt>
		
		<dd>
			
			<?=$value['message']?>
			
		</dd>
		
	</dl>
	<?endforeach?>
	
</article>