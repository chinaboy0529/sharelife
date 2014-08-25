<?php get_header(); ?>

<?php if (have_posts()) : ?>

	<h2><?php _e('Search Results', 'gpp'); ?></h2>

	<div class="navigation">
		<div><?php next_posts_link(esc_html__('&laquo; Older Entries', 'gpp')) ?></div>
		<div><?php previous_posts_link(esc_html__('Newer Entries &raquo;', 'gpp')) ?></div>
	</div>

<?php $i = 0; ?>
<?php while (have_posts()) : the_post(); $i++; ?>
<div class="span-8<?php if ($i == 3) { ?> last<?php $i = 0; } ?>">
<div class="post-<?php the_ID(); ?>">
<h6 class="archive-header"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title() ?></a></h6>
<?php get_the_image( array( 'custom_key' => array( 'thumbnail' ), 'default_size' => 'thumbnail', 'width' => '310', 'height' => '150' ) ); ?>
<?php the_excerpt(); ?>
<p class="postmetadata alt quiet"><?php the_time( get_option( 'date_format' ) ); ?> @ <?php the_time() ?> | <?php comments_popup_link(esc_html__('Comments &#187;', 'gpp'), esc_html__('1 Comment &#187;', 'gpp'), esc_html__('% Comments &#187;', 'gpp')); ?></p>
</div>
</div>
<?php endwhile; ?>

<div class="clear"></div>

	<div class="navigation">
		<div><?php next_posts_link(esc_html__('&laquo; Older Entries', 'gpp')) ?></div>
		<div><?php previous_posts_link(esc_html__('Newer Entries &raquo;', 'gpp')) ?></div>
	</div>

<?php else : ?>

	<h2><?php _e('No posts found. Try a different search?', 'gpp'); ?></h2>
	<?php include (TEMPLATEPATH . '/searchform.php'); ?>

<?php endif; ?>
<?php get_template_part( 'bottom' ); ?>
<?php get_footer(); ?>