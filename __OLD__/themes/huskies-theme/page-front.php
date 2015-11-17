<?php
/*
Template Name: frontpage
*/
?>

<?php get_header(); ?>

<?php while(have_posts()) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class('frontpage-article'); ?>>
    <div class="article_content clearfix">
      <?php if(is_attachment()) : ?>
        <div class="full_width_attachment img-rounded img-polaroid">
      <?php endif; ?>
      <?php the_content(); ?>
      <?php if(is_attachment()) : ?>
        </div>
      <?php endif; ?>
    </div>
  </article>
<?php endwhile; ?>

<hr class="fancy">

<div class="row-fluid frontpage-addition">
  <div class="span6">
    <div class="page-header frontpage_header">
      <h2><?php _e('Newest posts', 'huskies-theme'); ?></h2>
    </div>

    <?php 
      $top_query = new WP_Query("posts_per_page=2");
      while($top_query->have_posts()) : $top_query->the_post(); 
    ?>
      <article <?php post_class('clearfix well well-small'); ?> id="post-<?php the_ID(); ?>">
        <?php 
          $icon = 'icon-columns';
          $title= __('standard post', 'huskies-theme');
        if(has_post_format('gallery')) :
          $icon = 'icon-th';
          $title= __('gallery post', 'huskies-theme');
        elseif(has_post_format('image')) :
          $icon = 'icon-camera';
          $title= __('single image post', 'huskies-theme');
        elseif(has_post_format('status')) :
          $icon = 'icon-coffee';
          $title= __('status post', 'huskies-theme');
        elseif(has_post_format('video')) :
         $icon = 'icon-facetime-video';
         $title= __('video post', 'huskies-theme');
        endif; ?>
   
        <h3>
          <span class="post_format pull-left <?php echo $icon; ?>" data-placement="left" title="<?php echo $title; ?>"></span>
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        <?php if (is_sticky()) : ?>
            <div class="featured-post label label-info"> <?php _e('Featured post', 'huskies-theme'); ?> </div>
          <?php endif; ?>
          <small class="article_meta_extra"><?php echo get_the_date(); ?>, by <?php the_author_posts_link(); ?></small>
          <a href="<?php the_permalink(); ?>" title="<?php _e("Go to ", "huskies-theme") ?> <strong><?php the_title(); ?></strong>" class="more-start-link" data-placement="left"><i class="icon-hand-right"></i></a>
      </article>
    <?php endwhile; ?>
  </div>

  <div class="span6">
    <div class="page-header frontpage_header">
      <h2><?php _e('Next events', 'huskies-theme'); ?></h2>
    </div>

    <?php echo do_shortcode('[google-calendar-events id="2" title="Termine am " type="list-grouped" max="3"]'); ?>
  </div>
</div>

<?php get_footer(); ?>