<aside class="well article">
	
	<?if (isset( $socium ) ): ?>
		
		<?=heading( $name.' '.$surname , 3 , 'class="h1_done"' )?>
		
		
		<?if ( $this->ion_auth->logged_in() && $this->ion_auth->current_UID() == $this->uri->segment(2) ): ?>
			
			<span class="label label-info">
				<?=lang('Its_you')?>
			</span>
			
		<?endif?>
		
		
		<dl class="dl-horizontal">
			<dt class="">
				<?=lang('Age')?>
			</dt>
				<dd>
					<?=$age?>
				</dd>
			<dt class="">
				<?=lang('City')?>
			</dt>
				<dd>
					<?=$city?>
				</dd>
			<dt class="">
				<?=lang('Country')?>
			</dt>
				<dd>
					<?=$country?>
				</dd>
			<dt class="">
				<?=lang('Socium')?>
			</dt>
				<dd>
					<?=$socium?>
				</dd>
		</dl>
	<?endif?>
	
</aside>