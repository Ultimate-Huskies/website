<tr id="bbp-forum-<?php bbp_forum_id(); ?>" <?php bbp_forum_class(); ?>>
	<td>
		<?php do_action('bbp_theme_before_forum_title'); ?>
		<h4><a class="bbp-forum-title" href="<?php bbp_forum_permalink(); ?>" ><?php bbp_forum_title(); ?></a></h4>
		<?php do_action('bbp_theme_after_forum_title'); ?>
		
		<?php 
			do_action('bbp_theme_before_forum_sub_forums');
			bbp_list_forums();
			do_action('bbp_theme_after_forum_sub_forums'); 
		?>

		<?php do_action('bbp_theme_before_forum_description'); ?>
		<div><?php the_content(); ?></div>
		<?php do_action('bbp_theme_after_forum_description'); ?>

		<?php bbp_forum_row_actions(); ?>
	</td>

	<td class="hidden-phone"><?php bbp_forum_topic_count(); ?></td>

	<td class="hidden-phone">
		<?php 
			$count = bbp_show_lead_topic() ? bbp_get_forum_reply_count() : bbp_get_forum_post_count(); 
			echo $count;
		?>
	</td>

	<td>
		<?php 
			do_action('bbp_theme_before_forum_freshness_link');
			bbp_forum_freshness_link();
			do_action('bbp_theme_after_forum_freshness_link');
	  ?>

	  <?php if ($count > 0) : ?>
			<p class="bbp-topic-meta">
				<?php _e('by', 'huskies-theme'); ?>
				<?php do_action('bbp_theme_before_topic_author'); ?>
				<span class="bbp-topic-freshness-author"><?php bbp_author_link(array('post_id' => bbp_get_forum_last_active_id(), 'type' => 'name')); ?></span>
				<?php do_action('bbp_theme_after_topic_author'); ?>
			</p>
		<?php endif; ?>
	</td>
</tr>
