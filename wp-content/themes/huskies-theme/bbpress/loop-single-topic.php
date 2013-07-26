<tr id="topic-<?php bbp_topic_id(); ?>" <?php bbp_topic_class(); ?>>
	<td>
		<?php if (bbp_is_user_home()) : ?>
			<?php if (bbp_is_favorites()) : ?>
				<span class="topic-action pull-right">
					<?php 
						do_action('bbp_theme_before_topic_favorites_action');
						bbp_user_favorites_link(
							array(),
							array(
								'pre'  => '[ ',
								'mid'  => '<i class="icon-remove" title="'.__('Remove from your favorites', 'huskies-theme').'"></i>',
								'post' => ' ]'
							)
						);
						do_action('bbp_theme_after_topic_favorites_action');
					?>
				</span>
			<?php elseif (bbp_is_subscriptions()) : ?>
				<span class="topic-action pull-right">
					<?php 
						do_action('bbp_theme_before_topic_subscription_action');
						bbp_user_subscribe_link(array(
							'before' => '[ ', 
							'after' => ' ]',
							'unsubscribe' => '<i class="icon-remove" title="'.__('Remove from your subscriptions', 'huskies-theme').'"></i>'
						));
						do_action('bbp_theme_after_topic_subscription_action');
					?>
				</span>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action('bbp_theme_before_topic_title'); ?>
		<h4><a class="bbp-topic-permalink" href="<?php bbp_topic_permalink(); ?>"><?php bbp_topic_title(); ?></a></h4>
		<?php do_action( 'bbp_theme_after_topic_title' ); ?>

		<?php do_action('bbp_theme_before_topic_meta'); ?>
		<div class="topic-meta">
			<?php do_action('bbp_theme_before_topic_started_by'); ?>
			<span class="topic-started-by"><?php printf(__('Started by %1$s', 'huskies-theme'), bbp_get_topic_author_link(array('type' => 'name'))); ?></span>
			<?php do_action('bbp_theme_after_topic_started_by'); ?>
			<?php 
				if (!bbp_is_single_forum() || (bbp_get_topic_forum_id() != bbp_get_forum_id())) :
					do_action('bbp_theme_before_topic_started_in'); 
			?>
				<span class="topic-started-in"><?php printf(__('in <a href="%1$s">%2$s</a>', 'huskies-theme'), bbp_get_forum_permalink(bbp_get_topic_forum_id()), bbp_get_forum_title(bbp_get_topic_forum_id())); ?></span>
			<?php 
					do_action('bbp_theme_after_topic_started_in');
				endif; 
			?>
			<?php bootstrap_topic_pagination(); ?>
		</div>

		<div class="visible-desktop">
	    <span class="bbp-admin-links">
	      <?php 
	        echo   bbp_get_topic_edit_link().' | '.
	              bbp_get_topic_close_link().' | '.
	              bbp_get_topic_stick_link().' | '.
	              bbp_get_topic_merge_link().' | '.
	              bbp_get_topic_trash_link().' | '.
	              bbp_get_topic_spam_link (); 
	      ?>
	    </span>
	  </div>

		<?php 
			do_action('bbp_theme_after_topic_meta');
			bbp_topic_row_actions(); 
		?>
	</td>

	<td class="hidden-phone"><?php bbp_topic_voice_count(); ?></td>

	<td class="hidden-phone">
		<?php 
			$count = bbp_show_lead_topic() ? bbp_get_topic_reply_count() : bbp_get_topic_post_count(); 
			echo $count;
		?>
	</td>

	<td>
		<?php 
			do_action('bbp_theme_before_topic_freshness_link');
			bbp_topic_freshness_link();
			do_action('bbp_theme_after_topic_freshness_link');
	  ?>

	  <?php if ($count > 0) : ?>
			<p class="bbp-topic-meta">
				<?php _e('by', 'huskies-theme'); ?>
				<?php do_action('bbp_theme_before_topic_freshness_author'); ?>
				<span class="bbp-topic-freshness-author"><?php bbp_author_link(array('post_id' => bbp_get_topic_last_active_id(), 'type' => 'name')); ?></span>
				<?php do_action('bbp_theme_after_topic_freshness_author'); ?>
			</p>
		<?php endif; ?>
	</td>
</tr>
