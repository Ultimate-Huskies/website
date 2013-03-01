<div class="bbp-attachments-upload-form">
  <div class="page-header">
    <h4>
      <?php _e("Attachments", "huskies-theme"); ?>:
      <small class="icon-info-sign" title="<?php 
        global $gdbbpress_attachments; 
        $file_size = $gdbbpress_attachments->get_file_size(false, bbp_get_forum_id());
        $file_number = $gdbbpress_attachments->get_max_files(false, bbp_get_forum_id());
        echo __("Maximum file size allowed is", "huskies-theme")." ".$file_size." KiB.</br>"." ".__('Maximum amount of upload files is', 'huskies-theme').' '.$file_number; 
      ?>" data-placement="right"></small>
      <?php 
        $allowed_types = get_allowed_mime_types();
        $html = '<ul>';
        foreach ($allowed_types as $key => $value) {
          $html .= '<li>'.str_replace('|', ' | ', $key).'</li>';
        }
        $html .= '</ul>';
      ?>
      <small class="icon-file-alt pull-right" data-title="<?php _e('Allowed file types', 'huskies-theme'); ?>" data-placement="left" data-content="<?php echo $html; ?>"></small>
    </h4>
  </div>
  <div class="bbp-attachments-form">
    <div class="file-wrapper">
      <input type="file" name="d4p_attachment[]" />
      <span class="btn"><?php _e('Choose', 'huskies-theme'); ?></span>
      <span class="file_chosen uneditable-input"></span>
    </div>
  </div>
  <a class="d4p-attachment-addfile" href="#"><?php _e("Add another file", "huskies-theme"); ?></a>
  <div class="file-template">
    <div class="file-wrapper">
      <input type="file" name="d4p_attachment[]" />
      <span class="btn"><?php _e('Choose', 'huskies-theme'); ?></span>
      <span class="file_chosen uneditable-input"></span>
    </div>
  </div>
</div>
