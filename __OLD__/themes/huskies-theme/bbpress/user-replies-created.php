<?php do_action('bbp_template_before_user_replies'); ?>
<div id="bbp-user-replies-created" class="span10">
	<div class="page-header">
		<h2 class="entry-title"><?php _e('Forum replies created', 'huskies-theme'); ?></h2>
	</div>
	
	<div class="user-section">
		<?php 
			if (bbp_get_user_replies_created()) :
				bbp_get_template_part('pagination', 'replies');
				bbp_get_template_part('loop', 'replies');
				bbp_get_template_part('pagination', 'replies');
			else : 
		?>
			<div class="alert alert-info">
				<?php bbp_is_user_home() ? _e('You have not replied to any topics.', 'huskies-theme') : _e('This user has not replied to any topics.', 'huskies-theme'); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php do_action('bbp_template_after_user_replies'); ?>
