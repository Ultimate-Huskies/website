<?php do_action('bbp_template_before_user_topics_created'); ?>
<div id="bbp-user-topics-started" class="span10">
	<div class="page-header">
		<h2 class="entry-title"><?php _e('Forum topics started', 'huskies-theme'); ?></h2>
	</div>
	
	<div class="user-section">
		<?php 
			if (bbp_get_user_topics_started()) :
				bbp_get_template_part('pagination', 'topics');
				bbp_get_template_part('loop', 'topics');
				bbp_get_template_part('pagination', 'topics');
			else : 
		?>
			<div class="alert alert-info">
				<?php bbp_is_user_home() ? _e('You have not created any topics.', 'huskies-theme') : _e( 'This user has not created any topics.', 'huskies-theme'); ?>
			</div>
		<?php endif; ?>
	</div>
</div>
	<?php do_action('bbp_template_after_user_topics_created'); ?>
