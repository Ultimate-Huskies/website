<?php get_header(); ?>

  <?php while(have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <header>
        <div class="page-header">
          <h1><?php the_title(); ?></h1>
          <small class="article_meta_extra"><?php echo get_the_date(); ?>, by <?php the_author_posts_link(); ?></small>
          <?php edit_post_link(__('Edit this post', 'huskies-theme'), ' | <span class="article_meta_edit_link">', '</span>' ); ?>
        </div>
      </header>

      <?php if(has_post_thumbnail()) : ?>
        <figure class="article_preview_image">
          <?php the_post_thumbnail('thumbnail', array('class' => 'img-rounded img-polaroid')); ?>
        </figure>
      <?php endif; ?>

      <div class="article_content clearfix">
        <?php the_content(); ?>
      </div>

      <?php 
          boostrap_wp_link_pages(array(
            'before' => '<nav class="pagination pagination-centered"><ul>',
            'after' => '</ul></nav>',
            'link_before' => '<li>',
            'link_after' => '</li>',
            'current_before' => '<li class="active"><a>',
            'current_after' => '</a></li>',
          ));
      ?>
    </article>
  <?php endwhile; ?>

<?php get_footer(); ?>