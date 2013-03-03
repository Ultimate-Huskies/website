<div id="post-<?php bbp_reply_id(); ?>" <?php bbp_reply_class(); ?>>
	<?php if (!bbp_is_single_user_replies()) : ?>
		<div class="meta pull-left">
			<?php 
				do_action('bbp_theme_before_reply_author_details');
				bbp_reply_author_link(array(
					'sep' => '', 
					'show_role' => true,
					'type' => 'avatar'
				));

				if (is_super_admin()) :
					do_action('bbp_theme_before_reply_author_admin_details');
			?>
				<div class="bbp-reply-ip"><?php bbp_author_ip(bbp_get_reply_id()); ?></div>
			<?php
					do_action('bbp_theme_after_reply_author_admin_details');
				endif;

				do_action('bbp_theme_after_reply_author_details');
			?>

			<dl class="bbp-user-post-count dl-horizontal hidden-phone">
			  <dt><?php _e('Topics :', 'huskies-theme'); ?></dt>
			  <dd><?php echo bbp_get_user_topic_count_raw(bbp_get_reply_author_id(bbp_get_reply_id())); ?></dd>
			  <dt><?php _e('Replies:', 'huskies-theme'); ?></dt>
			  <dd><?php echo bbp_get_user_reply_count_raw(bbp_get_reply_author_id(bbp_get_reply_id())); ?></dd>
			</dl>
		</div>
	<?php endif; ?>

	<div class="media-body">
		<div class="page-header">
			<h4 class="media-heading">
				<?php if (!bbp_is_single_user_replies()) : ?>
					<a href="<?php bbp_reply_author_url(bbp_get_reply_id()); ?>"><?php bbp_reply_author_display_name(bbp_get_reply_id()); ?></a>
				<?php endif; ?>
				<small>
					<?php 
						bbp_reply_post_date(); 
						if (bbp_is_single_user_replies()) :
					?>
						<?php _e('in reply to: ', 'huskies-theme'); ?>
						<a class="topic-permalink" href="<?php bbp_topic_permalink(bbp_get_reply_topic_id()); ?>"><?php bbp_topic_title(bbp_get_reply_topic_id()); ?></a>
					<?php endif; ?>
				</small>
			</h4>

			<?php 
				do_action('bbp_theme_before_reply_admin_links');
				bbp_reply_admin_links();
				do_action('bbp_theme_after_reply_admin_links');
			?>
		</div>

		<?php 
			do_action('bbp_theme_before_reply_content');
			bbp_reply_content();
			do_action('bbp_theme_after_reply_content');
		?>
	</div>
</div>
