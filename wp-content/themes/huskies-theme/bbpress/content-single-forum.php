<div id="forums">
	<?php 
		bootstrap_breadcrumb();
		do_action('bbp_template_before_single_forum');

		//TODO: work an password required template
		if (post_password_required()) :
			bbp_get_template_part('form', 'protected');
		else :
			//TODO: work an subforum style template
			if (bbp_get_forum_subforum_count() && bbp_has_forums()) :
				bbp_get_template_part('loop', 'forums');
			endif;

			if (!bbp_is_forum_category() && bbp_has_topics()) :
				bbp_get_template_part('pagination', 'topics');
				bbp_get_template_part('loop', 'topics');
				bbp_get_template_part('pagination', 'topics');

				bbp_single_forum_description(array(
					'before'    => '<div class="alert alert-info alert-block hidden-phone forum-description">',
					'after'     => '</div>',
					'size'      => 48,
				));
				echo '<hr class="fancy" />';

				bbp_get_template_part('form', 'topic');
			elseif (!bbp_is_forum_category()) :
				bbp_get_template_part('feedback', 'no-topics');
				bbp_get_template_part('form', 'topic' );
			endif;
		endif;
		do_action('bbp_template_after_single_forum'); 
	?>
</div>
