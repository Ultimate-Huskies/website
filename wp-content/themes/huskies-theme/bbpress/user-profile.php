<?php do_action('bbp_template_before_user_profile'); ?>
<div id="user-profile" class="span10">
	<div class="page-header">
		<h2 class="entry-title"><?php _e('Profile', 'huskies-theme'); ?></h2>
	</div>

	<div class="user-section">
		<dl class="dl-horizontal user-details">
		  <dt><?php is_user_logged_in() ? _e('Display name', 'huskies-theme') : _e('Name', 'huskies-theme'); ?></dt>
		  <dd><?php bbp_displayed_user_field('display_name'); ?></dd>
		  <?php if (is_user_logged_in()) : ?>
		  	<?php if (bbp_get_displayed_user_field('first_name')) : ?>
		  		<dt><?php _e('First name', 'huskies-theme'); ?></dt>
					<dd><?php bbp_displayed_user_field('first_name'); ?></dd>
				<?php endif; ?>
				<?php if (bbp_get_displayed_user_field('last_name')) : ?>
					<dt><?php _e('Last name', 'huskies-theme'); ?></dt>
					<dd><?php bbp_displayed_user_field('last_name'); ?></dd>
				<?php endif; ?>
				<?php if (bbp_get_displayed_user_field('nickname')) : ?>
					<dt><?php _e('Nickname', 'huskies-theme'); ?></dt>
					<dd><?php bbp_displayed_user_field('nickname'); ?></dd>
				<?php endif; ?>
			<?php endif; ?>

			<hr />
			<?php if (bbp_get_displayed_user_field('description')) : ?>
				<dt><?php _e('Description', 'huskies-theme'); ?></dt>
				<dd><?php bbp_displayed_user_field('description'); ?></dd>
			<?php endif; ?>
		</dl>

		<?php if (is_user_logged_in()) : ?>
			<div class="page-header clearfix">
				<h4><?php _e('Contact informations', 'huskies-theme'); ?></h4>
			</div>
			<dl class="dl-horizontal user-contacts">
				<dt><?php _e('Website', 'huskies-theme') ?></dt>
				<dd><a href="<?php echo esc_attr(bbp_get_displayed_user_field('user_url')); ?>"> <?php bbp_displayed_user_field('user_url'); ?></a></dt>
				<?php foreach (bbp_edit_user_contact_methods() as $name => $desc) : ?>
					<dt><?php echo $desc ?></dt>
					<dd><?php bbp_get_displayed_user_field($name); ?></dd>
				<?php endforeach; ?>
			</dl>

			<div class="page-header clearfix">
				<h4><?php _e('Activity', 'huskies-theme'); ?></h4>
			</div>
			<dl class="dl-horizontal user-contacts">
				<dt><?php _e('Topics Started', 'huskies-theme'); ?></dt>
				<dd><?php echo bbp_get_user_topic_count_raw(); ?></dd>
				<dt><?php _e('Replies Created', 'huskies-theme'); ?></dt>
				<dd><?php echo bbp_get_user_reply_count_raw(); ?></dd>

				<hr />
				<dt><?php _e('Forum Role', 'huskies-theme'); ?></dt>
				<dd><?php bbp_user_display_role(); ?></dd>
			</dl>
		<?php endif; ?>
	</div>
</div>
<?php do_action('bbp_template_after_user_profile'); ?>
