<div id="forums">
	<?php
		bootstrap_breadcrumb();
		do_action('bbp_template_before_single_topic');

		#TODO: work on that template
		if (post_password_required()) :
			bbp_get_template_part('form', 'protected');
		else :
			bbp_topic_tag_list();
		
			#TODO: work on that template
			if (bbp_show_lead_topic()) :
				bbp_get_template_part('content', 'single-topic-lead');
			endif;

			if (bbp_has_replies()) :
				bbp_get_template_part('pagination', 'replies');
				bbp_get_template_part('loop', 'replies');
				bbp_get_template_part('pagination', 'replies');
			endif;
			bbp_single_topic_description();
			echo '<hr class="fancy" />';

			bbp_get_template_part('form', 'reply');
		endif;

		do_action('bbp_template_after_single_topic');
	?>
</div>
