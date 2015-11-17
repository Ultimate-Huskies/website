<div class="span10">
	<div class="page-header">
		<h2><?php _e('Edit your profile', 'huskies-theme'); ?></h2>
	</div>

	<form id="your-profile" action="<?php bbp_user_profile_edit_url(bbp_get_displayed_user_id()); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
		<?php 
			do_action('bbp_user_edit_before');
			do_action('bbp_user_edit_before_name');
		?>

		<div class="control-group">
			<label class="control-label" for="first_name"><?php _e('First Name', 'huskies-theme'); ?></label>
			<div class="controls">
				<input type="text" name="first_name" id="first_name" value="<?php echo esc_attr(bbp_get_displayed_user_field('first_name')); ?>" tabindex="<?php bbp_tab_index(); ?>" />
			</div>
		</div>

		<div class="control-group">
	    <label class="control-label" for="last_name"><?php _e('Last Name', 'huskies-theme'); ?></label>
	    <div class="controls">
	      <input type="text" name="last_name" id="last_name" value="<?php echo esc_attr(bbp_get_displayed_user_field('last_name')); ?>" tabindex="<?php bbp_tab_index(); ?>" />
	    </div>
	  </div>

	  <div class="control-group">
			<label class="control-label" for="nickname"><?php _e('Nickname', 'huskies-theme'); ?></label>
			<div class="controls">
				<input type="text" name="nickname" id="nickname" value="<?php echo esc_attr(bbp_get_displayed_user_field('nickname')); ?>" tabindex="<?php bbp_tab_index(); ?>" />
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="display_name"><?php _e('Display Name', 'huskies-theme'); ?></label>
			<div class="controls">
				<?php bbp_edit_user_display_name(); ?>
			</div>
		</div>
		<?php do_action('bbp_user_edit_after_name'); ?>

		<div class="page-header">
			<h4><?php _e('Contact Info', 'huskies-theme'); ?></h4>
		</div>
		<?php do_action('bbp_user_edit_before_contact'); ?>

		<div class="control-group">
			<label class="control-label" for="url"><?php _e('Website', 'huskies-theme') ?></label>
			<div class="controls">
				<input type="text" name="url" id="url" value="<?php echo esc_attr(bbp_get_displayed_user_field('user_url')); ?>" tabindex="<?php bbp_tab_index(); ?>" />
			</div>
		</div>

		<?php foreach ( bbp_edit_user_contact_methods() as $name => $desc ) : ?>
			<div class="control-group">
				<label class="control-label" for="<?php echo $name; ?>"><?php echo apply_filters('user_'.$name.'_label', $desc); ?></label>
				<div class="controls">
					<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_attr(bbp_get_displayed_user_field($name)); ?>" tabindex="<?php bbp_tab_index(); ?>" />
				</div>
			</div>
		<?php endforeach; ?>
		<?php do_action('bbp_user_edit_after_contact'); ?>

		<div class="page-header">
			<h4><?php bbp_is_user_home_edit() ? _e('About yourself', 'huskies-theme') : _e('About the user', 'huskies-theme'); ?></h4>
		</div>
		<?php do_action('bbp_user_edit_before_about'); ?>
		<div class="control-group">
			<label class="control-label" for="description"><?php _e('Biographical Info', 'huskies-theme'); ?></label>
			<div class="controls">
				<textarea name="description" id="description" tabindex="<?php bbp_tab_index(); ?>"><?php echo esc_attr(bbp_get_displayed_user_field('description')); ?></textarea>
				<span class="help-block label label-info">
					<strong><?php _e('Hint:', 'huskies-theme'); ?></strong>
					<?php _e('This description about yourself is available for every site visitor', 'huskies-theme'); ?>
				</span>
			</div>
		</div>
		<?php do_action('bbp_user_edit_after_about'); ?>

		<div class="page-header">
			<h4><?php _e('Account', 'huskies-theme'); ?></h4>
		</div>
		<?php do_action('bbp_user_edit_before_account'); ?>
		<div class="control-group">
			<label class="control-label" for="user_login"><?php _e('Username', 'huskies-theme'); ?></label>
			<div class="controls">
				<input type="text" name="user_login" id="user_login" value="<?php echo esc_attr(bbp_get_displayed_user_field('user_login')); ?>" disabled="disabled" tabindex="<?php bbp_tab_index(); ?>" />
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="email"><?php _e('Email', 'huskies-theme'); ?></label>
			<div class="controls">
				<input type="text" name="email" id="email" value="<?php echo esc_attr(bbp_get_displayed_user_field('user_email')); ?>" tabindex="<?php bbp_tab_index(); ?>" />
				<?php
					// Handle address change requests
					$new_email = get_option(bbp_get_displayed_user_id().'_new_email');
					if ($new_email && $new_email != bbp_get_displayed_user_field('user_email')) : ?>
					<span class="help-block">
						<?php printf(__('There is a pending email address change to <code>%1$s</code>. <a href="%2$s">Cancel</a>', 'huskies-theme'), $new_email['newemail'], esc_url(self_admin_url('user.php?dismiss='.bbp_get_current_user_id().'_new_email'))); ?>
					</span>
				<?php endif; ?>
			</div>
		</div>

		<div id="password" class="control-group">
			<label class="control-label" for="pass1"><?php _e('New Password', 'huskies-theme'); ?></label>
			<div class="controls">
				<input type="password" name="pass1" id="pass1" value="" autocomplete="off" tabindex="<?php bbp_tab_index(); ?>" placeholder="<?php _e('If you would like to change the password type a new one', 'huskies-theme'); ?>" />
				<input type="password" name="pass2" id="pass2" value="" autocomplete="off" tabindex="<?php bbp_tab_index(); ?>" placeholder="<?php _e('Type your new password again', 'huskies-theme'); ?>" />
				<div id="pass-strength-result" class="label"></div>
				<span class="help-block label label-info">
					<?php _e('Your password should be at least ten characters long. Use upper and lower case letters, numbers, and symbols to make it even stronger.', 'huskies-theme'); ?>
				</span>
			</div>
		</div>

		<?php if (current_user_can('edit_users') && ! bbp_is_user_home_edit()) : ?>
			<div class="page-header">
				<h4><?php _e('User Role', 'huskies-theme') ?></h4>
			</div>
			<?php 
				do_action ('bbp_user_edit_before_role');
				bbp_get_template_part('form', 'user-roles');
				do_action( 'bbp_user_edit_after_role' );
			?>
		<?php endif; ?>

		<div id="plugin_additions">
      <div class="file-template">
        <div class="file-wrapper">
          <input type="file" name="simple-local-avatar" id="simple-local-avatar">
          <span class="btn"><?php _e('Choose', 'huskies-theme'); ?></span>
          <span class="file_chosen uneditable-input"></span>
        </div>
      </div>
			<?php do_action('bbp_user_edit_after'); ?>
		</div>

		<div class="form-actions">
			<?php bbp_edit_user_form_fields(); ?>
			<button type="submit" tabindex="<?php bbp_tab_index(); ?>" id="bbp_user_edit_submit" name="bbp_user_edit_submit" class="btn btn-success"><?php bbp_is_user_home_edit() ? _e('Update Profile', 'huskies-theme') : _e('Update User', 'huskies-theme'); ?></button>
		</div>
	</form>
</div>
