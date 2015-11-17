<?php do_action('bbp_template_before_user_favorites'); ?>
<div id="bbp-user-favorites" class="span10">
	<div class="page-header">
		<h2 class="entry-title"><?php _e('Favorite forum topics', 'huskies-theme'); ?></h2>
	</div>
	
	<div class="user-section">
		<?php 
			if (bbp_get_user_favorites()) :
				bbp_get_template_part('pagination', 'topics');
				bbp_get_template_part('loop', 'topics');
				bbp_get_template_part('pagination', 'topics');
			else : 
		?>
			<div class="alert alert-info">
				<?php bbp_is_user_home() ? _e('You currently have no favorite topics.', 'huskies-theme') : _e('This user has no favorite topics.', 'huskies-theme'); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php do_action('bbp_template_after_user_favorites'); ?>
