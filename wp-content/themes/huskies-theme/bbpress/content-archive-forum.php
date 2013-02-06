<div id="forums">
	<?php do_action('bbp_template_before_forums_index'); ?>

	<?php 
    if (bbp_has_forums()) : 
      bootstrap_breadcrumb();
		  bbp_get_template_part('loop','forums');
	  else :
      bbp_get_template_part('feedback','no-forums');
    endif; 
  ?>

	<?php do_action('bbp_template_after_forums_index'); ?>
</div>
