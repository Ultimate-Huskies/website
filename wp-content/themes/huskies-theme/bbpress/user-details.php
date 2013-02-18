<?php do_action('bbp_template_before_user_details'); ?>
<div class="span2">
	<div id="single-user-details">
		<legend>
			<?php echo get_avatar(bbp_get_displayed_user_field('user_email'), apply_filters('bbp_single_user_details_avatar_size', 100)); ?>
			<?php bbp_displayed_user_field('display_name'); ?>
		</legend>

		<ul class="nav nav-list user-navigation">
			<?php if (is_user_logged_in()) : ?><li class="nav-header"><?php _e('Public Links', 'huskies-theme'); ?></li><?php endif; ?>
			<li class="<?php if (bbp_is_single_user_profile()) :?>active<?php endif; ?>" title="<?php printf(__("%s's Profile", 'huskies-theme'), esc_attr(bbp_get_displayed_user_field('display_name'))); ?>">
				<a href="<?php bbp_user_profile_url(); ?>" rel="me">
					<?php _e('Profile', 'huskies-theme'); ?>
				</a>
			</li>

			<?php if (is_user_logged_in()) : ?>
				<li class="<?php if (bbp_is_single_user_topics()) :?>active<?php endif; ?>" title="<?php printf(__("%s's Topics Started", 'huskies-theme'), esc_attr(bbp_get_displayed_user_field('display_name'))); ?>">
					<a href="<?php bbp_user_topics_created_url(); ?>">
						<?php _e('Topics created', 'huskies-theme'); ?>
					</a>
				</li>

				<li class="<?php if (bbp_is_single_user_replies()) :?>active<?php endif; ?>" title="<?php printf(__("%s's Replies Created", 'huskies-theme'), esc_attr(bbp_get_displayed_user_field('display_name'))); ?>">
					<a href="<?php bbp_user_replies_created_url(); ?>">
						<?php _e('Replies created', 'huskies-theme'); ?>
					</a>
				</li>

				<?php if (bbp_is_favorites_active()) : ?>
					<li class="<?php if (bbp_is_favorites()) :?>active<?php endif; ?>" title="<?php printf(__("%s's Favorites", 'huskies-theme'), esc_attr(bbp_get_displayed_user_field('display_name'))); ?>">
						<a href="<?php bbp_favorites_permalink(); ?>">
							<?php _e('Favorites', 'huskies-theme'); ?>
						</a>							
					</li>
				<?php endif; ?>
				<?php if (bbp_is_user_home() || current_user_can('edit_users')) : ?>
					<li class="nav-header"><?php _e('Private Links', 'huskies-theme'); ?></li>
					<?php if (bbp_is_subscriptions_active()) : ?>
						<li class="<?php if (bbp_is_subscriptions()) :?>active<?php endif; ?>" title="<?php printf(__("%s's Subscriptions", 'huskies-theme'), esc_attr(bbp_get_displayed_user_field('display_name'))); ?>">
								<a href="<?php bbp_subscriptions_permalink(); ?>">
									<?php _e('Subscriptions', 'huskies-theme'); ?>
								</a>							
						</li>
					<?php endif; ?>

					<li class="<?php if (bbp_is_single_user_edit()) :?>active<?php endif; ?>" title="<?php printf(__('Edit Profile of User %s', 'huskies-theme'), esc_attr(bbp_get_displayed_user_field('display_name'))); ?>">
						<a href="<?php bbp_user_profile_edit_url(); ?>">
							<?php _e('Edit', 'huskies-theme'); ?>
						</a>
					</li>
				<?php endif; ?>
			<?php endif; ?>
		</ul>
	</div>
</div>
<?php do_action('bbp_template_after_user_details'); ?>
