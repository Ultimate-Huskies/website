<div id="forums">
	<?php 
		bootstrap_breadcrumb();
		if (bbp_is_topic_tag()) bbp_topic_tag_description();
		do_action('bbp_template_before_topics_index');

		if (bbp_has_topics()) :
			bbp_get_template_part('pagination', 'topics');
			bbp_get_template_part('loop', 'topics');
			bbp_get_template_part('pagination', 'topics');
		else :
			bbp_get_template_part('feedback', 'no-topics');
		endif;

		do_action('bbp_template_after_topics_index'); 
	?>
</div>
