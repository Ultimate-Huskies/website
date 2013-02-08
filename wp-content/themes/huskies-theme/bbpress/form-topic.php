<?php if (!bbp_is_single_forum()) : ?>
<div id="forums">
	<?php bootstrap_breadcrumb(); ?>
<?php endif; ?>

<?php 
	if (bbp_is_topic_edit()) :
		bbp_topic_tag_list(bbp_get_topic_id());
		bbp_single_topic_description(array(
			'topic_id' => bbp_get_topic_id(),
			'before'    => '<div class="alert alert-info alert-block hidden-phone forum-description">',
			'after'     => '</div>',
			'size'      => 48,
		));
	endif; 
?>

<?php if (bbp_current_user_can_access_create_topic_form()) : ?>
	<div id="new-topic-<?php bbp_topic_id(); ?>" class="topic-form well well-small">
		<div class="page-header">
			<h3>
				<?php
					do_action('bbp_theme_before_topic_form_title');
					if (bbp_is_topic_edit()) printf(__('Now Editing &ldquo;%s&rdquo;', 'huskies-theme'), bbp_get_topic_title());
					else bbp_is_single_forum() ? printf(__('Create New Topic in &ldquo;%s&rdquo;', 'huskies-theme'), bbp_get_forum_title()) : _e('Create New Topic', 'huskies-theme');
					do_action('bbp_theme_after_topic_form_title');
				?>
			</h3>
		</div>
		<?php do_action('bbp_theme_before_topic_form_notices'); ?>

		<?php if (!bbp_is_topic_edit() && bbp_is_forum_closed()) : ?>
			<div class="alert">
				<h4><?php _e('Closed'); ?></h4>
				<?php _e('This forum is marked as closed to new topics, however your posting capabilities still allow you to do so.', 'huskies-theme'); ?>
			</div>
		<?php endif; ?>

		<?php do_action('bbp_template_notices'); ?>

		<form id="new-post" name="new-post" method="post" action="<?php the_permalink(); ?>">
			<?php 
				do_action('bbp_theme_before_topic_form');
				//TODO: styling template if needed
				bbp_get_template_part('form', 'anonymous');
			?>

			<div class="topic-name row-fluid">
				<div class="input-prepend span12 input-append">
          <span class="add-on" title="<?php _e('Name of the topic', 'huskies-theme'); ?>"><i class="icon-bullhorn"></i></span>
          <input type="text" id="bbp_topic_title" value="<?php bbp_form_topic_title(); ?>" tabindex="<?php bbp_tab_index(); ?>" name="bbp_topic_title" maxlength="<?php bbp_title_max_length(); ?>" placeholder="<?php printf(__('Topic Title (Maximum Length %d):', 'huskies-theme'), bbp_get_title_max_length()); ?>"/>
          <span class="add-on" title="<?php _e('required field', 'huskies-theme'); ?>"><i class="icon-asterisk"></i></span>
        </div>
			</div>

			<?php 
				do_action('bbp_theme_before_topic_form_content'); 
				
				if (!function_exists('wp_editor')) : 
			?>
				<div class="input-block-level row-fluid">
          <textarea id="bbp_topic_content" tabindex="<?php bbp_tab_index(); ?>" name="bbp_topic_content" class="span12" placeholder="<?php _e('topic content', 'huskies-theme'); ?>"><?php bbp_form_topic_content(); ?></textarea>
        </div>
			<?php 
				else :
					bbp_the_content(array(
						'context' 			=> 'topic',
						'before'        => '<div class="the-content-wrapper row-fluid">',
						'editor_class'  => 'the-content',
					));
				endif; 
				
				do_action('bbp_theme_after_topic_form_content'); 
			?>

			<?php if (!current_user_can('unfiltered_html')) : ?>
				<dl class="bbpress_form_allowed_tags dl-horizontal hidden-phone">
          <dt>
            <?php _e('You may use these', 'huskies-theme'); ?>
            <abbr title="HyperText Markup Language">HTML</abbr>
            <?php _e('tags and attributes', 'huskies-theme'); ?>:
          </dt>
          <dd><code><?php bbp_allowed_tags(); ?></code></dd>
        </dl>
      <?php else : ?>
				<div class="alert alert-info">
					<?php _e('Your account has the ability to post unrestricted HTML content.', 'huskies-theme'); ?>
				</div>
			<?php endif; ?>

			<div class="topic-meta-input row-fluid">
	    	<?php 
	    		if (bbp_allow_topic_tags() && current_user_can('assign_topic_tags')) :
						do_action('bbp_theme_before_topic_form_tags'); 
				?>
					<div class="input-prepend span4 topic-tags">
	          <span class="add-on" title="<?php _e('Topic Tags', 'huskies-theme'); ?>"><i class="icon-tags"></i></span>
	          <input type="text" id="bbp_topic_tags" value="<?php bbp_form_topic_tags(); ?>" tabindex="<?php bbp_tab_index(); ?>" name="bbp_topic_tags" placeholder="<?php _e('Tags for this topic', 'huskies-theme'); ?>" <?php disabled(bbp_is_topic_spam()); ?>/>
	        </div>
				<?php 
						do_action('bbp_theme_after_topic_form_tags');
					endif; 

					if (!bbp_is_single_forum()) :
						do_action('bbp_theme_before_topic_form_forum'); 
				?>
					<div class="span4 forum-select">
						<label for="bbp_forum_id"><?php _e('Forum:', 'huskies-theme'); ?></label>
						<?php bbp_dropdown(array('selected' => bbp_get_form_topic_forum())); ?>
					</div>
				<?php 
						do_action('bbp_theme_after_topic_form_forum');	
					endif;
					
					if (current_user_can('moderate')) :
						do_action('bbp_theme_before_topic_form_type');
				?>
					<div class="span4 topic-type">
						<label for="bbp_stick_topic"><?php _e('Topic Type:', 'huskies-theme'); ?></label>
							<?php bbp_topic_type_select(); ?>
					</div>
				<?php
						do_action('bbp_theme_after_topic_form_type');
					endif;
				
					if (bbp_is_subscriptions_active() && !bbp_is_anonymous() && (!bbp_is_topic_edit() || (bbp_is_topic_edit() && !bbp_is_topic_anonymous()))) : 
						do_action('bbp_theme_before_topic_form_subscriptions');
				?>
					<div class="span4 notify">
						<label class="checkbox">
							<input name="bbp_topic_subscription" id="bbp_topic_subscription" type="checkbox" value="bbp_subscribe" <?php bbp_form_topic_subscribed(); ?> tabindex="<?php bbp_tab_index(); ?>" />
							<?php 
								if (bbp_is_topic_edit() && (get_the_author_meta('ID') != bbp_get_current_user_id())) : 
									_e('Notify the author of follow-up replies via email', 'huskies-theme');
								else :
									_e('Notify me of follow-up replies via email', 'huskies-theme');
								endif;
							?>
						</label>
					</div>
				<?php 
						do_action('bbp_theme_after_topic_form_subscriptions');
					endif;
				?>
			</div>

			<?php 
				if (bbp_allow_revisions() && bbp_is_topic_edit()) : 
					do_action('bbp_theme_before_topic_form_revisions');
			?>
				<fieldset class="form-revision">
					<legend><?php _e('Revision', 'huskies-theme'); ?></legend>
					<div class="row-fluid">
						<div class="span4 check-revision">
							<label class="checkbox" for="bbp_log_topic_edit">
								<input name="bbp_log_topic_edit" id="bbp_log_topic_edit" type="checkbox" value="1" <?php bbp_form_topic_log_edit(); ?> tabindex="<?php bbp_tab_index(); ?>" />
								<?php _e('Keep a log of this edit', 'huskies-theme'); ?>
							</label>
						</div>

						<div class="span8 reason-revision">
							<label for="bbp_topic_edit_reason"><?php printf(__('Optional reason for editing:', 'huskies-theme'), bbp_get_current_user_name()); ?></label>
							<input type="text" value="<?php bbp_form_topic_edit_reason(); ?>" tabindex="<?php bbp_tab_index(); ?>" name="bbp_topic_edit_reason" id="bbp_topic_edit_reason" />
						</div>							
					</div>
				</fieldset>
			<?php 
					do_action('bbp_theme_after_topic_form_revisions');
				endif; 

				do_action('bbp_theme_before_topic_form_submit_wrapper');
			?>
			 <div class="comment_form_submit form-actions">
			 	<?php do_action('bbp_theme_before_topic_form_submit_button'); ?>
        <input type="submit" id="bbp_topic_submit" name="bbp_topic_submit" class="btn btn-success" value="<?php bbp_is_topic_edit() ? _e('Edit Topic', 'huskies-theme') : _e('Create Topic', 'huskies-theme'); ?>" tabindex="<?php bbp_tab_index(); ?>"/>
        <?php do_action('bbp_theme_after_topic_form_submit_button'); ?>
        <input type="reset" class="btn" value="<?php _e('Clear', 'huskies-theme'); ?>">
      </div>
      <?php 
      	do_action('bbp_theme_after_topic_form_submit_wrapper'); 
      	bbp_topic_form_fields();
      	do_action('bbp_theme_after_topic_form');
     	?>
    </form>
	</div>
<?php elseif (bbp_is_forum_closed()) : ?>
	<div id="no-topic-<?php bbp_topic_id(); ?>" class="alert alert-info">
		<?php printf(__('The forum &#8216;%s&#8217; is closed to new topics and replies.', 'huskies-theme'), bbp_get_forum_title()); ?>
	</div>
<?php else : ?>
	<div id="no-topic-<?php bbp_topic_id(); ?>" class="alert">
		<?php is_user_logged_in() ? _e('You cannot create new topics.', 'huskies-theme') : _e('You must be logged in to create new topics.', 'huskies-theme'); ?></p>
	</div>
<?php endif; ?>

<?php if (!bbp_is_single_forum()) : ?>
	</div>
<?php endif; ?>
