<?php 
  if (!is_active_sidebar('first_footer_widget') && 
      !is_active_sidebar('second_footer_widget') && 
      !is_active_sidebar('third_footer_widget'))
    return; ?>

<footer id="secondFooter" class="hidden-phone">
  <div class="container">
    <div class="row">
      <?php 
        if (is_active_sidebar('first_footer_widget'))
          dynamic_sidebar('first_footer_widget');

        if (is_active_sidebar('second_footer_widget')) 
          dynamic_sidebar('second_footer_widget');
        
        if (is_active_sidebar('third_footer_widget'))
          dynamic_sidebar('third_footer_widget');
      ?>
    </div>
  </div>
<footer>