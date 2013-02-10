<?php 
	do_action('bbp_template_before_user_subscriptions');
	if (bbp_is_subscriptions_active()) :
		if (bbp_is_user_home() || current_user_can('edit_users')) : 
?>
			<div id="bbp-user-subscriptions" class="span10">
				<div class="page-header">
					<h2 class="entry-title"><?php _e('Subscribed forum topics', 'huskies-theme'); ?></h2>
				</div>

				<div class="user-section">
					<?php 
						if (bbp_get_user_subscriptions()) :
							bbp_get_template_part('pagination', 'topics');
							bbp_get_template_part('loop', 'topics');
							bbp_get_template_part('pagination', 'topics');
						else : 
					?>
						<div class="alert alert-info">
							<?php bbp_is_user_home() ? _e('You are not currently subscribed to any topics.', 'huskies-theme' ) : _e('This user is not currently subscribed to any topics.', 'huskies-theme'); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
<?php 
		endif;
	endif;
	do_action('bbp_template_after_user_subscriptions');
?>
