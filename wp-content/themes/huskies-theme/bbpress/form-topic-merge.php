<div id="forums">
	<?php 
		bootstrap_breadcrumb();
		if (is_user_logged_in() && current_user_can('edit_topic', bbp_get_topic_id())) : 
	?>
		<div id="merge-topic-<?php bbp_topic_id(); ?>" class="bbp-topic-merge">
			<div class="page-header">
				<h4><?php printf(__('Merge topic "%s"', 'huskies-theme'), bbp_get_topic_title()); ?></h4>
			</div>

			<div class="alert">
				<?php _e('<strong>WARNING:</strong> This process cannot be undone.', 'huskies-theme'); ?>
			</div>

			<form id="merge_topic" name="merge_topic" method="post" action="<?php the_permalink(); ?>">
				<div class="alert alert-info">
					<strong><?php _e('Merge Information', 'huskies-theme'); ?></strong>
					<p><?php _e('Select the topic to merge this one into. The destination topic will remain the lead topic, and this one will change into a reply.', 'huskies-theme'); ?></p>
					<p><?php _e('To keep this topic as the lead, go to the other topic and use the merge tool from there instead.', 'huskies-theme'); ?></p>
					<p><?php _e('All replies within both topics will be merged chronologically. The order of the merged replies is based on the time and date they were posted. If the destination topic was created after this one, it\'s post date will be updated to second earlier than this one.', 'huskies-theme'); ?></p>
				</div>

				<div class="row-fluid destination">
					<div class="span12">
						<?php if (bbp_has_topics(array('show_stickies' => false, 'post_parent' => bbp_get_topic_forum_id(bbp_get_topic_id()), 'post__not_in' => array(bbp_get_topic_id())))) : ?>
							<label for="bbp_destination_topic"><?php _e('Merge with this topic:', 'huskies-theme'); ?></label>
							<?php
								bbp_dropdown(array(
									'post_type'   => bbp_get_topic_post_type(),
									'post_parent' => bbp_get_topic_forum_id(bbp_get_topic_id()),
									'selected'    => -1,
									'exclude'     => bbp_get_topic_id(),
									'select_id'   => 'bbp_destination_topic',
									'none_found'  => __('No topics were found to which the topic could be merged to!', 'huskies-theme')
								));
							?>
						<?php else : ?>
							<label><?php _e('There are no other topics in this forum to merge with.', 'huskies-theme'); ?></label>
						<?php endif; ?>
					</div>
				</div>

				<fieldset class="extras">
					<legend><?php _e('Topic Extras', 'bbpress'); ?></legend>
					<div class="row-fluid">
						<div class="span4 favorites">
							<label for="bbp_topic_favoriters" class="checkbox">
								<?php _e('Merge topic favoriters', 'huskies-theme') ; ?>
								<input name="bbp_topic_favoriters" id="bbp_topic_favoriters" type="checkbox" value="1" checked="checked" tabindex="<?php bbp_tab_index(); ?>" />
							</label>
						</div>

						<?php if (bbp_is_subscriptions_active()) : ?>
							<div class="span4 subscripers">
								<label for="bbp_topic_subscribers" class="checkbox">
									<?php _e('Merge topic subscribers', 'huskies-theme'); ?>
									<input name="bbp_topic_subscribers" id="bbp_topic_subscribers" type="checkbox" value="1" checked="checked" tabindex="<?php bbp_tab_index(); ?>" />
								</label>
							</div>
						<?php endif; ?>
							
						<?php if (bbp_allow_topic_tags()) : ?>
							<div class="span4 tags">
								<label for="bbp_topic_tags" class="checkbox">
									<?php _e('Merge topic tags', 'huskies-theme'); ?>
									<input name="bbp_topic_tags" id="bbp_topic_tags" type="checkbox" value="1" checked="checked" tabindex="<?php bbp_tab_index(); ?>" />
								</label>
							</div>
						<?php endif; ?>
					</div>
				</fieldset>

				<div class="form-actions">
					<button type="submit" tabindex="<?php bbp_tab_index(); ?>" id="bbp_merge_topic_submit" name="bbp_merge_topic_submit" class="btn btn-success"><?php _e('Merge', 'huskies-theme'); ?></button>
				</div>

				<?php bbp_merge_topic_form_fields(); ?>
			</form>
		</div>
	<?php else : ?>
		<div id="no-topic-<?php bbp_topic_id(); ?>" class="alert">
			<?php is_user_logged_in() ? _e('You do not have the permissions to edit this topic!', 'huskies-theme') : _e('You cannot edit this topic.', 'huskies-theme'); ?></div>
		</div>
	<?php endif; ?>
</div>
