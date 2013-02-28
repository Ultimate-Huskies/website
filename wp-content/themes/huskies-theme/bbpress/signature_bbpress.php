<div class="page-header">
  <h4><?php _e("forum signature", "huskies-theme"); ?></h4>
</div>
<div class="control-group">
  <?php do_action('bbp_user_edit_before_signature'); ?>
  <label class="control-label" for="signature"><?php _e("Signature", "huskies-theme"); ?></label>
  <div class="controls">
      <textarea name="signature" id="signature" tabindex="<?php bbp_tab_index(); ?>"><?php echo esc_attr(bbp_get_displayed_user_field('signature')); ?></textarea>
      <span class="help-block label label-info">
        <?php echo sprintf(__("Signature length is limited to %s characters.", "huskies-theme"), $this->max_length); ?>
      </span>
  </div>
  <?php do_action('bbp_user_edit_after_signature'); ?>
</div>
