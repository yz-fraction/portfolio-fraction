<article class="well">
	
	<?if (isset( $message ) ): ?>
		
		<?=heading( lang('Made_good_deed') . ' ' .
							anchor( 'user/'.$user_id , $user_name_surname , array('title' => '') ) . '.' ,
							2 , 'class=""' )?>
		
		<dl class="dl-horizontal tooltip_title">
			<dt class=""
				 rel="tooltip"
				 title="<?=$date?>">
				<?=$date?>
			</dt>
				<dd>
					<?=$message?>
				</dd>
		</dl>
		
	<?endif?>
	
</article>