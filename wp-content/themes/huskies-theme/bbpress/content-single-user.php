<div id="forums">
	<?php 
		if (!is_user_logged_in()) : 
			bbp_get_template_part('feedback', 'no-forums');
		else :
			do_action('bbp_template_notices'); 
	?>
		<div id="user-wrapper" class="row-fluid">
			<?php bbp_get_template_part('user', 'details'); ?>

			<?php 
				if (bbp_is_favorites()) 					bbp_get_template_part('user', 'favorites');
				if (bbp_is_subscriptions()) 			bbp_get_template_part('user', 'subscriptions');
				if (bbp_is_single_user_topics())  bbp_get_template_part('user', 'topics-created');
				if (bbp_is_single_user_replies()) bbp_get_template_part('user', 'replies-created');
				if (bbp_is_single_user_edit()) 	  bbp_get_template_part('form', 'user-edit');
				if (bbp_is_single_user_profile()) bbp_get_template_part('user', 'profile');
			?>
		</div>
<?php endif; ?>
</div>
