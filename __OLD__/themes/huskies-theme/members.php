<?php
/*
Template Name: Members
*/
?>

<?php get_header(); ?>

  <?php while(have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <?php if(strtolower(get_the_title()) !== 'kontakt' && strtolower(get_the_title()) !== 'contact' && strtolower(get_the_title()) !== 'start' && !bbp_is_single_user()) : ?>
        <header>
          <div class="page-header">
            <h1><?php echo str_replace('Privat:', '', get_the_title()); ?><?php edit_post_link(__('Edit this post', 'huskies-theme'), ' <small class="article_meta_edit_link">', '</small>' ); ?></h1>
          </div>
        </header>
      <?php endif; ?>

      <div class="article_content clearfix">
        <?php 
          if (is_user_logged_in()) :
            $members = new tern_members;
            $html = $members->members(array(
                'search' => false,
                'alpha' => false,
                'pagination' => true,
                'pagination2' => true,
                'sort' => false,
                'radius' => false
              ), false);

            $html = str_replace('tern_members', 'members', $html); # replace id
            $html = str_replace('tern_members_view', 'member-list', $html); # replace default class 
            $html = str_replace('<ul class="tern_pagination">', '<div class="pagination pagination-centered"><ul>', $html); # add bootstrap pagination
            $html = str_replace('tern_pagination_current', 'active', $html); # short class for current
            $html = str_replace('tern_wp_members_list', 'media-list', $html); # add media list class
            $html = str_replace('<li>', '<li class="media">', $html); # add media class
            $html = str_replace('tern_wp_member_gravatar', 'pull-left', $html); # add class to pull it left
            $html = str_replace('img-rounded', 'media-object img-circle', $html); # add style for images
            $html = str_replace('tern_wp_member_info', 'media-body', $html); # add media body
            echo $html;
          else :
        ?>
          <div class="alert alert-info alert-block">
              <h3>
                <?php _e('You need to', 'huskies-theme'); ?> <a href="<?php echo wp_login_url(); ?>"><?php _e('login', 'huskies-theme'); ?></a>
                <?php _e('or', 'huskies-theme'); ?> <a href="<?php echo home_url(); ?>/wp-login.php?action=register"><?php _e('register', 'huskies-theme'); ?></a>
                <?php _e('if you are new here', 'huskies-theme'); ?>
              </h3>
          </div>
        <?php endif; ?>
      </div>

    </article>
  <?php endwhile; ?>

<?php get_footer(); ?>