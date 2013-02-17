<?php do_action('bbp_template_before_topics_loop'); ?>

<table class="table table-striped" id="bbp-forum-<?php bbp_forum_id(); ?>">
	<thead>
		<tr>
			<th></th>
			<th class="hidden-phone"><?php _e('Voices', 'huskies-theme'); ?></th>
			<th class="hidden-phone"><?php bbp_show_lead_topic() ? _e('Replies', 'huskies-theme') : _e('Posts', 'huskies-theme'); ?></th>
			<th><?php _e('Freshness', 'huskies-theme'); ?></th>
		</tr>
	</thead>

	<tbody>
		<?php 
			while (bbp_topics()) : bbp_the_topic();
				bbp_get_template_part('loop', 'single-topic');
			endwhile; 
		?>
	</tbody>
</table>

<?php do_action('bbp_template_after_topics_loop'); ?>
