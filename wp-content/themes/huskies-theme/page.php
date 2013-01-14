<?php get_header(); ?>

  <?php while(have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <?php if(strtolower(get_the_title()) !== 'kontakt' && strtolower(get_the_title()) !== 'contact' && strtolower(get_the_title()) !== 'start') : ?>
        <header>
          <div class="page-header">
            <h1><?php the_title(); ?><?php edit_post_link(__('Edit this post', 'huskies-theme'), ' <small class="article_meta_edit_link">', '</small>' ); ?></h1>
          </div>
        </header>

        <?php if(has_post_thumbnail()) : ?>
          <figure class="article_preview_image">
            <?php the_post_thumbnail('thumbnail', array('class' => 'img-rounded img-polaroid')); ?>
          </figure>
        <?php endif; ?>
      <?php endif; ?>

      <div class="article_content clearfix">
        <?php if(is_attachment()) : ?>
          <div class="full_width_attachment img-rounded img-polaroid">
        <?php endif; ?>
        <?php the_content(); ?>
        <?php if(is_attachment()) : ?>
          </div>
        <?php endif; ?>
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