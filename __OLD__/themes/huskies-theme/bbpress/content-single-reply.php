<div id="forums">
	<?php 
    bootstrap_breadcrumb();
    do_action('bbp_template_before_single_reply');

    # TODO:Work on that template
    if (post_password_required()) :
      bbp_get_template_part('form', 'protected');
    else :
      bbp_get_template_part('loop', 'single-reply');
    endif;

	  do_action('bbp_template_after_single_reply');
  ?>

</div>
