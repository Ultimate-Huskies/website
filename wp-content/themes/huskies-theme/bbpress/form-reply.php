<?php if (bbp_is_reply_edit()) : ?>
	<div id="forums">
	<?php bootstrap_breadcrumb(); ?>
<?php endif; ?>

<?php if (bbp_current_user_can_access_create_reply_form()) : ?>
	<div id="new-reply-<?php bbp_topic_id(); ?>" class="reply-form well well-small">
		<div class="page-header">
			<h3>
				<?php !bbp_is_reply_edit() ? printf(__('Reply To: %s', 'huskies-theme'), bbp_get_topic_title()) : bbp_topic_title(); ?>
			</h3>
		</div>

		<?php 
			do_action('bbp_theme_before_reply_form_notices');
			if (!bbp_is_topic_open() && !bbp_is_reply_edit()) :
		?>
			<div class="alert">
				<h4><?php _e('Closed', 'huskies-theme'); ?></h4>
				<?php _e('This topic is marked as closed to new replies, however your posting capabilities still allow you to do so.', 'huskies-theme'); ?>
			</div>
		<?php endif; ?>

		<form id="new-post" name="new-post" method="post" action="<?php the_permalink(); ?>">
			<?php 
				do_action('bbp_theme_before_reply_form');
				do_action('bbp_template_notices');
				bbp_get_template_part('form', 'anonymous');
				do_action('bbp_theme_before_reply_form_content');

				if (!function_exists('wp_editor')) :
			?>
				<div class="input-block-level row-fluid">
          <textarea id="bbp_reply_content" tabindex="<?php bbp_tab_index(); ?>" name="bbp_reply_content" class="span12" placeholder="<?php _e('Reply content', 'huskies-theme'); ?>"><?php bbp_form_reply_content(); ?></textarea>
        </div>
      <?php 
      	else :
					bbp_the_content(array(
						'context' 			=> 'reply',
						'before'        => '<div class="the-content-wrapper row-fluid">',
						'editor_class'  => 'the-content',
					));
				endif; 
				
				do_action('bbp_theme_after_reply_form_content'); 
				
				if (!current_user_can('unfiltered_html')) : 
			?>
					<dl class="bbpress_form_allowed_tags dl-horizontal hidden-phone">
	          <dt>
	            <?php _e('You may use these', 'huskies-theme'); ?>
	            <abbr title="HyperText Markup Language">HTML</abbr>
	            <?php _e('tags and attributes', 'huskies-theme'); ?>:
	          </dt>
	          <dd><code><?php bbp_allowed_tags(); ?></code></dd>
	        </dl>
	    <?php else: ?>
	    		<div class="alert alert-info">
						<?php _e('Your account has the ability to post unrestricted HTML content.', 'huskies-theme'); ?>
					</div>
			<?php endif; ?>

			<div class="topic-meta-input row-fluid">
				<?php 
					if (bbp_allow_topic_tags() && current_user_can('assign_topic_tags')) : 
						do_action('bbp_theme_before_reply_form_tags');
				?>
					<div class="input-prepend span4 topic-tags">
	          <span class="add-on" title="<?php _e('Tags', 'huskies-theme'); ?>"><i class="icon-tags"></i></span>
	          <input type="text" id="bbp_topic_tags" value="<?php bbp_form_topic_tags(); ?>" tabindex="<?php bbp_tab_index(); ?>" name="bbp_topic_tags" placeholder="<?php _e('Tags for this topic', 'huskies-theme'); ?>" <?php disabled(bbp_is_topic_spam()); ?>/>
	        </div>
	      <?php 
	      		do_action('bbp_theme_after_reply_form_tags');
	      	endif;

	      	if (bbp_is_subscriptions_active() && !bbp_is_anonymous() && (!bbp_is_reply_edit() || (bbp_is_reply_edit() && !bbp_is_reply_anonymous()))) : 
						do_action('bbp_theme_before_reply_form_subscription');
				?>
					<div class="span4 notify">
						<label class="checkbox">
							<input name="bbp_topic_subscription" id="bbp_topic_subscription" type="checkbox" value="bbp_subscribe" <?php bbp_form_topic_subscribed(); ?> tabindex="<?php bbp_tab_index(); ?>" />
							<?php 
								if (bbp_is_reply_edit() && (get_the_author_meta('ID') != bbp_get_current_user_id())) : 
									_e('Notify the author of follow-up replies via email', 'huskies-theme');
								else :
									_e('Notify me of follow-up replies via email', 'huskies-theme');
								endif;
							?>
						</label>
					</div>
				<?php 
						do_action('bbp_theme_after_reply_form_subscription');
					endif;
				?>
			</div>

			<?php 
				if (bbp_allow_revisions() && bbp_is_reply_edit()) : 
					do_action('bbp_theme_before_reply_form_revisions');
			?>
				<fieldset class="form-revision">
					<legend><?php _e('Revision', 'huskies-theme'); ?></legend>
					<div class="row-fluid">
						<div class="span4 check-revision">
							<label class="checkbox" for="bbp_log_reply_edit">
								<input name="bbp_log_reply_edit" id="bbp_log_topic_edit" type="checkbox" value="1" <?php bbp_form_topic_log_edit(); ?> tabindex="<?php bbp_tab_index(); ?>" />
								<?php _e('Keep a log of this edit', 'huskies-theme'); ?>
							</label>
						</div>

						<div class="span8 reason-revision">
							<label for="bbp_reply_edit_reason"><?php printf(__('Optional reason for editing:', 'huskies-theme'), bbp_get_current_user_name()); ?></label>
							<input type="text" value="<?php bbp_form_reply_edit_reason(); ?>" tabindex="<?php bbp_tab_index(); ?>" name="bbp_reply_edit_reason" id="bbp_reply_edit_reason" />
						</div>							
					</div>
				</fieldset>
			<?php 
					do_action('bbp_theme_after_reply_form_revisions');
				endif; 
					
				do_action('bbp_theme_before_reply_form_submit_wrapper');
			?>
			 <div class="comment_form_submit form-actions">
			 	<?php do_action('bbp_theme_before_reply_form_submit_button'); ?>
        <input type="submit" id="bbp_reply_submit" name="bbp_reply_submit" class="btn btn-success" value="<?php bbp_is_reply_edit() ? _e('Edit Reply', 'huskies-theme') : _e('Create Reply', 'huskies-theme'); ?>" tabindex="<?php bbp_tab_index(); ?>"/>
        <?php do_action('bbp_theme_after_reply_form_submit_button'); ?>
        <input type="reset" class="btn" value="<?php _e('Clear', 'huskies-theme'); ?>">
      </div>
      <?php 
      	do_action('bbp_theme_after_reply_form_submit_wrapper'); 
      	bbp_reply_form_fields();
      	do_action('bbp_theme_after_reply_form');
     	?>
    </form>
	</div>
<?php elseif (bbp_is_topic_closed()) : ?>
	<div id="no-topic-<?php bbp_topic_id(); ?>" class="alert alert-info">
		<?php printf(__('The topic &#8216;%s&#8217; is closed to new replies.', 'huskies-theme'), bbp_get_topic_title()); ?>
	</div>
<?php elseif (bbp_is_forum_closed(bbp_get_topic_forum_id())) : ?>
	<div id="no-reply-<?php bbp_topic_id(); ?>" class="alert alert-info">
		<?php printf(__('The forum &#8216;%s&#8217; is closed to new topics and replies.', 'huskies-theme'), bbp_get_forum_title(bbp_get_topic_forum_id())); ?>
	</div>
<?php else : ?>
	<div id="no-reply-<?php bbp_topic_id(); ?>" class="alert">
		<?php is_user_logged_in() ? _e('You cannot reply to this topic.', 'huskies-theme') : _e('You must be logged in to reply to this topic.', 'huskies-theme'); ?></p>
	</div>
<?php endif; ?>

<?php if (bbp_is_reply_edit()) : ?>
</div>
<?php endif; ?>
