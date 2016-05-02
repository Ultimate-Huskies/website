<?php do_action('bbp_template_before_user_profile'); ?>
<div id="user-profile" class="span10">
	<div class="page-header">
		<h2 class="entry-title"><?php _e('Profile', 'huskies-theme'); ?></h2>
	</div>

	<div class="user-section">
		<dl class="dl-horizontal user-details">
		  <dt><?php is_user_logged_in() ? _e('Display name', 'huskies-theme') : _e('Name', 'huskies-theme'); ?></dt>
		  <dd><?php bbp_displayed_user_field('display_name'); ?></dd>
		  <?php 
        if (is_user_logged_in()) : 
          $first_name = bbp_get_displayed_user_field('first_name');
          $last_name = bbp_get_displayed_user_field('last_name');
          $nickname = bbp_get_displayed_user_field('nickname');
      ?>
	  		<dt><?php _e('First name', 'huskies-theme'); ?></dt>
				<dd><?php echo strlen($first_name) > 0 ? $first_name : '&nbsp;' ?></dd>

				<dt><?php _e('Last name', 'huskies-theme'); ?></dt>
				<dd><?php echo strlen($last_name) > 0 ? $last_name : '&nbsp;' ?></dd>
				
				<dt><?php _e('Nickname', 'huskies-theme'); ?></dt>
				<dd><?php echo strlen($nickname) > 0 ? $nickname : '&nbsp;' ?></dd>
			<?php endif; ?>

			<?php if (bbp_get_displayed_user_field('description')) : ?>
				<hr />
				<dt><?php _e('Description', 'huskies-theme'); ?></dt>
				<dd><?php bbp_displayed_user_field('description'); ?></dd>
			<?php endif; ?>

			<hr />
			<dt><?php _e('Signature', 'huskies-theme'); ?><dt>
			<dd><?php bbp_displayed_user_field('signature'); ?></dd>
		</dl>

		<?php 
      if (is_user_logged_in()) : 
        $website = bbp_get_displayed_user_field('user_url');
    ?>
			<div class="page-header clearfix">
				<h4><?php _e('Contact informations', 'huskies-theme'); ?></h4>
			</div>
			<dl class="dl-horizontal user-contacts">
				<dt><?php _e('Website', 'huskies-theme') ?></dt>
				<dd><a href="<?php echo esc_attr($website); ?>"> <?php echo strlen($website) > 0 ? $website : '&nbsp;' ?></a></dt>
				<?php foreach (bbp_edit_user_contact_methods() as $name => $desc) : ?>
					<dt><?php echo $desc ?></dt>
					<dd>
            <?php 
              $text = bbp_get_displayed_user_field($name); 
              echo strlen($text) > 0 ? $text : '&nbsp;';
            ?>
          </dd>
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
