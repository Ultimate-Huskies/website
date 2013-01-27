<?php get_header(); ?>

<header class="archive_header well well-small">
  <?php ########################################################################################################
  #               Tag archive                                                                           
  ######################################################################################################## ?>
  <?php if(is_tag()) : ?>
    <h1 class="archive_title">
      <?php echo single_tag_title('', false); ?>
      <small><?php _e('Archive for this tag', 'huskies-theme'); ?></small>
    </h1>

    <?php if (tag_description()) : ?>
      <div class="archive_meta"><?php echo tag_description(); ?></div>
    <?php endif; ?>

  <?php ########################################################################################################
  #               Category archive                                      
  ######################################################################################################## ?>
  <?php elseif(is_category()) : ?>
    <h1 class="archive_title">
      <?php echo single_cat_title('', false); ?>
      <small><?php _e('Archive for this category', 'huskies-theme'); ?></small>
    </h1>

    <?php if (tag_description()) : ?>
      <div class="archive_meta"><?php echo category_description(); ?></div>
    <?php endif; ?>

  <?php ########################################################################################################
  #               Date archive                                                                           
  ######################################################################################################## ?>
  <?php elseif(is_date()) : ?>
    <h1 class="archive_title">
      <?php if (is_day()) : ?>
        <?php echo get_the_date(); ?>
        <small><?php _e('Daily Archives', 'huskies-theme'); ?></small>
      <?php elseif (is_month()) : ?>
        <?php echo get_the_date(_x('F Y', 'monthly archives date format', 'huskies-theme')); ?>
        <small><?php _e('Monthly Archives', 'huskies-theme'); ?></small>
      <?php elseif (is_year()) : ?>
        <?php echo get_the_date(_x('Y', 'yearly archives date format', 'huskies-theme')); ?>
        <small><?php _e('Yearly Archives', 'huskies-theme')?></small>
      <?php else : ?>
        <?php _e('Date archive', 'huskies-theme'); ?>
      <?php endif; ?>
    </h1>

  <?php ########################################################################################################
  #               Author archive                                                                      
  ######################################################################################################## ?>
  <?php elseif(is_author()) : ?> 
    <?php the_post(); #query the first post to get author informations ?>
    <h1 class="archive_title">
      <?php echo get_the_author(); ?>
      <small><?php _e('Archive for this author', 'huskies-theme'); ?></small>
    </h1>

    <?php if (get_the_author_meta('description')) : ?>
      <div class="archive_meta author_info media">
        <div class="author_avatar pull-left">
          <?php echo get_avatar(get_the_author_meta('user_email'), 100); ?>
        </div>
        <div class="author_description media-body">
          <p><?php the_author_meta('description'); ?></p>
        </div>
      </div>
    <?php endif; ?>
    <?php rewind_posts(); #reset loop to display all posts including the first one ?> 

  <?php ########################################################################################################
  #               Generally Archive                                                                   
  ######################################################################################################## ?>   
  <?php else : ?>
    <h1 class="archive_title">
      <?php _e('Archives', 'huskies-theme'); ?>
    </h1>
  <?php endif; ?>
</header>

<?php 
  if (have_posts()) : while(have_posts()) : the_post(); 
    get_template_part('content', get_post_format());
  endwhile;

  boostrap_content_nav();

  else :
    get_template_part('content', 'none');
  endif; 
?>

<?php get_footer(); ?>