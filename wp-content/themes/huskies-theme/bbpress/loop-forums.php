<?php do_action('bbp_template_before_forums_loop'); ?>

<table class="table table-striped" id="forums-list-<?php bbp_forum_id(); ?>">
	<thead>
		<tr>
			<th></th>
			<th class="hidden-phone"><?php _e('Topics','huskies-theme'); ?></th>
			<th class="hidden-phone"><?php bbp_show_lead_topic() ? _e('Replies', 'huskies-theme') : _e('Posts', 'huskies-theme'); ?></th>
			<th><?php _e('Freshness', 'huskies-theme'); ?></th>
		</tr>
	</thead>

	<tbody>
		<?php 
			while (bbp_forums()) : bbp_the_forum(); 
				bbp_get_template_part('loop', 'single-forum'); 
			endwhile; ?>
	</tbody>
</table>

<?php do_action( 'bbp_template_after_forums_loop' ); ?>
