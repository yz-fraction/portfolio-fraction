<article class="">
	<dl class="dl-horizontal">
		<?if (isset( $users ) ) foreach( $users as $key => $value ): ?>
		<dt>
			<a href="/user/<?=$value['user_id']?>/" title="">
				<?=$value['name']?></a>
			
			<?if ( $this->ion_auth->logged_in() &&
					   $value['user_id'] != $this->ion_auth->current_UID()  ) : ?>
				<a href="/users/delete/<?=$value['user_id']?>/"
					class="control_delete"
					title="control_delete">
					<i class="icon-trash"></i>
				</a>
			<?endif?>
		</dt>
			<dd>
				<?=$value['city']?>
			</dd>
		<?endforeach?>
	</dl>
	
	<?=$this->pagination->create_links()?>
	
</article>