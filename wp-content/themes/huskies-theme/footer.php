      <div class="container" id="firstFooter">
        <a class="pull-left" href="<?php print IMPRINT_URL; ?>"><?php _e('imprint', 'huskies-theme') ?></a>
        <p>
          &copy; <?php echo date('Y'); ?> 
          <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
          <?php _e('powered by', 'huskies-theme'); ?> <a href="http://wordpress.org/"><?php _e('wordpress', 'huskies-theme'); ?></a>
        </p>
        <a href="#footer" class="pull-right hidden-phone"><?php _e('toggle footer', 'huskies-theme'); ?><i class="icon-hand-down"></i></a>
      </div>
    </div>
    <a id="top_navigator" href="#" class="hidden-phone icon-hand-up" title="<?php _e('scroll to top', 'huskies-theme'); ?>" data-placement="bottom"></a>
    <?php get_sidebar('footer'); ?>
    <?php wp_footer(); ?>
  </body>
</html>