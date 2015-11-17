<?php do_action('bbp_template_before_pagination_loop'); ?>

<div class="pagination pagination-centered">
	<div class="hidden-phone">
		<?php bbp_forum_pagination_count(); ?>
	</div>
  <?php bbp_forum_pagination_links(); ?>
</div>

<?php do_action('bbp_template_after_pagination_loop'); ?>
