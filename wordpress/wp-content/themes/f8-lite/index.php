<?php get_header(); ?>

<?php $i = 0; ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); if( $post->ID == $do_not_duplicate ) continue; update_post_caches($posts); $i++; ?>
<div class="span-8 post-<?php the_ID(); ?><?php if ($i == 3) { ?> last<?php  } ?>">
<h6 class="archive-header"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title() ?></a></h6>
<?php get_the_image( array( 'custom_key' => array( 'thumbnail' ), 'default_size' => 'thumbnail', 'width' => '310', 'height' => '150' ) ); ?>
<?php the_excerpt(); ?>
<p class="postmetadata"><?php the_time( get_option( 'date_format' ) ); ?> | <?php comments_popup_link(esc_html__('Comments &#187;', 'gpp'), esc_html__('1 Comment &#187;', 'gpp'), esc_html__('% Comments &#187;', 'gpp')); ?></p>
</div>
<?php if ($i == 3) { ?><div class="archive-stack clear"></div><?php $i = 0; } ?>
<?php endwhile; endif; ?>

<div class="clear"></div>

<div class="navigation">
	<div><?php next_posts_link(esc_html__('&laquo; Older Entries', 'gpp')) ?></div>
	<div><?php previous_posts_link(esc_html__('Newer Entries &raquo;', 'gpp')) ?></div>
</div>

<?php get_template_part( 'bottom' ); ?>
<?php get_footer(); ?>