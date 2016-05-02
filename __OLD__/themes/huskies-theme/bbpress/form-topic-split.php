<div id="forums">
	<?php 
		bootstrap_breadcrumb();
		if (is_user_logged_in() && current_user_can('edit_topic', bbp_get_topic_id())) : 
	?>
		<div id="split-topic-<?php bbp_topic_id(); ?>" class="bbp-topic-split">
			<div class="page-header">
				<h4><?php printf(__('Split topic "%s"', 'huskies-theme'), bbp_get_topic_title()); ?></h4>
			</div>

			<div class="alert">
				<?php _e('<strong>WARNING:</strong> This process cannot be undone.', 'huskies-theme'); ?>
			</div>

			<form id="split_topic" name="split_topic" method="post" action="<?php the_permalink(); ?>">
				<div class="alert alert-info">
					<strong><?php _e('Split Information', 'huskies-theme'); ?></strong>
					<p><?php _e('When you split a topic, you are slicing it in half starting with the reply you just selected. Choose to use that reply as a new topic with a new title, or merge those replies into an existing topic.', 'huskies-theme'); ?></p>
					<p><?php _e('If you use the existing topic option, replies within both topics will be merged chronologically. The order of the merged replies is based on the time and date they were posted.', 'huskies-theme'); ?></p>
				</div>

				<div class="row-fluid destination">
					<div class="span6">
						<label for="bbp_topic_split_option_reply" class="radio">
							<input name="bbp_topic_split_option" id="bbp_topic_split_option_reply" type="radio" checked="checked" value="reply" tabindex="<?php bbp_tab_index(); ?>" />
							<?php printf(__('New topic in <strong>%s</strong> titled:', 'huskies-theme'), bbp_get_forum_title(bbp_get_topic_forum_id( bbp_get_topic_id()))); ?>
						</label>
						
						<input type="text" id="bbp_topic_split_destination_title" value="<?php printf(__('Split: %s', 'huskies-theme'), bbp_get_topic_title()); ?>" tabindex="<?php bbp_tab_index(); ?>" name="bbp_topic_split_destination_title" />
					</div>
					
					<?php if (bbp_has_topics(array('show_stickies' => false, 'post_parent' => bbp_get_topic_forum_id( bbp_get_topic_id()), 'post__not_in' => array(bbp_get_topic_id())))) : ?>
						<div class="span6">
							<label for="bbp_topic_split_option_existing" class="radio">
								<input name="bbp_topic_split_option" id="bbp_topic_split_option_existing" type="radio" value="existing" tabindex="<?php bbp_tab_index(); ?>" />
								<?php _e('Use an existing topic in this forum:', 'huskies-theme'); ?>
							</label>

							<?php
								bbp_dropdown(array(
									'post_type'   => bbp_get_topic_post_type(),
									'post_parent' => bbp_get_topic_forum_id( bbp_get_topic_id() ),
									'selected'    => -1,
									'exclude'     => bbp_get_topic_id(),
									'select_id'   => 'bbp_destination_topic',
									'none_found'  => __('No other topics found!', 'huskies-theme')
								));
							?>
						</div>
					<?php endif; ?>
				</div>

				<fieldset class="bbp-form">
					<legend><?php _e('Topic Extras', 'huskies-theme'); ?></legend>
					<div class="row-fluid">
						<div class="span4">
							<label for="bbp_topic_favoriters" class="checkbox">
								<input name="bbp_topic_favoriters" id="bbp_topic_favoriters" type="checkbox" value="1" checked="checked" tabindex="<?php bbp_tab_index(); ?>" />
								<?php _e('Copy favoriters to the new topic', 'huskies-theme'); ?>
							</label>
						</div>
												
						<?php if (bbp_is_subscriptions_active()) : ?>
							<div class="span4">
								<label for="bbp_topic_subscribers" class="checkbox">
									<input name="bbp_topic_subscribers" id="bbp_topic_subscribers" type="checkbox" value="1" checked="checked" tabindex="<?php bbp_tab_index(); ?>" />
									<?php _e('Copy subscribers to the new topic', 'huskies-theme'); ?>
								</label>
							</div>
						<?php endif; ?>

						<?php if (bbp_allow_topic_tags()) : ?>
							<div class="span4">
								<label for="bbp_topic_tags">
									<input name="bbp_topic_tags" id="bbp_topic_tags" type="checkbox" value="1" checked="checked" tabindex="<?php bbp_tab_index(); ?>" />
									<?php _e('Copy topic tags to the new topic', 'huskies-theme'); ?>
								</label>
							</div>
						<?php endif; ?>
					</div>
				</fieldset>

				<div class="form-actions">
					<button type="submit" tabindex="<?php bbp_tab_index(); ?>" id="bbp_merge_topic_submit" name="bbp_merge_topic_submit" class="btn btn-success"><?php _e('Split topic', 'huskies-theme'); ?></button>
				</div>
				<?php bbp_split_topic_form_fields(); ?>
			</form>
		</div>
	<?php else : ?>
		<div id="no-topic-<?php bbp_topic_id(); ?>" class="alert">
			<?php is_user_logged_in() ? _e('You do not have the permissions to edit this topic!', 'huskies-theme') : _e('You cannot edit this topic.', 'huskies-theme'); ?>
		</div>
	<?php endif; ?>
</div>
