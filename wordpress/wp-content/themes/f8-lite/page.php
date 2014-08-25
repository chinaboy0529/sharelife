<?php get_header(); ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post clearfix" id="post-<?php the_ID(); ?>">
			<h2 class="entry-title"><?php the_title(); ?></h2>
			<?php the_content('<p class="serif">'. esc_html__('Read the rest of this page &raquo;', 'gpp') . '</p>'); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'gpp' ), 'after' => '</div>' ) ); ?>
		</div>
		<?php endwhile; endif; ?>
	<?php edit_post_link(esc_html__('Edit this entry.', 'gpp'), '<p>', '</p>'); ?>
	<?php comments_template( '', true ); ?>
<?php get_template_part( 'bottom' ); ?>
<?php get_footer(); ?>