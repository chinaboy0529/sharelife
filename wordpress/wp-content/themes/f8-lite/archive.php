<?php get_header(); rewind_posts(); ?>
<div class="archive">
	
		<?php 
		query_posts($query_string.'&posts_per_page=24');
		if (have_posts()) : ?>

 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h6><?php single_cat_title(); ?></h6>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h6><?php _e('Posts Tagged', 'gpp'); ?> &#8216;<?php single_tag_title(); ?>&#8217;</h6>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h6><?php _e('Archive for', 'gpp'); ?> <?php the_time('F jS, Y'); ?></h6>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h6><?php _e('Archive for', 'gpp'); ?> <?php the_time('F, Y'); ?></h6>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h6><?php _e('Archive for', 'gpp'); ?> <?php the_time('Y'); ?></h6>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h6><?php _e('Author Archive', 'gpp'); ?></h6>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h6><?php _e('Blog Archives', 'gpp'); ?></h6>
 	  <?php } ?>
<div class="clear"></div>
<?php $i = 0; ?>
<?php while (have_posts()) : the_post(); $i++; ?>
<div class="span-8 post-<?php the_ID(); ?><?php if ($i == 3) { ?> last<?php  } ?>">
<h6 class="archive-header"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title() ?></a></h6>
<?php get_the_image( array( 'custom_key' => array( 'thumbnail' ), 'default_size' => 'thumbnail', 'width' => '310', 'height' => '150' ) ); ?>
<?php the_excerpt(); ?>
<p class="postmetadata"><?php the_time( get_option( 'date_format' ) ); ?> | <?php comments_popup_link(esc_html__('Comments &#187;', 'gpp'), esc_html__('1 Comment &#187;', 'gpp'), esc_html__('% Comments &#187;', 'gpp')); ?></p>
</div>
<?php if ($i == 3) { ?><div class="archive-stack clear"></div><?php $i = 0; } ?>
<?php endwhile; ?>

<div class="clear"></div>

<div class="nav-interior">
			<div class="prev"><?php next_posts_link(esc_html__('&laquo; Older Entries', 'gpp')) ?></div>
			<div class="next"><?php previous_posts_link(esc_html__('Newer Entries &raquo;', 'gpp')) ?></div>
		</div>
<div class="clear"></div>

	<?php else : ?>

		<h2 class="center"><?php _e('Not Found', 'gpp'); ?></h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>

	<?php endif; ?>
</div>
<?php get_template_part( 'bottom' ); ?>
<?php get_footer(); ?>