<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<h6 class="underlined"><?php the_title(); ?></h6>
<div <?php if(function_exists('post_class')) : ?><?php post_class(); ?><?php else : ?>class="post post-<?php the_ID(); ?>"<?php endif; ?>>
<div class="content clearfix">
<?php
	$values = get_post_custom_values("multimedia");
	if (isset($values[0])) {
	?>
<div class="multimedia clearfix">
	<?php $values = get_post_custom_values("multimedia"); echo $values[0]; ?>
</div>
<?php } ?>

<?php the_content(); ?>
<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'gpp' ), 'after' => '</div>' ) ); ?>
</div>
</div>

<p class="postmetadata"><?php the_time( get_option( 'date_format' ) ); ?> | <?php _e('Filed under', 'gpp'); ?> <?php the_category(', ') ?><?php if (get_the_tags()) the_tags(esc_html__(' and tagged with ', 'gpp')); ?>. <?php edit_post_link(esc_html__('Edit', 'gpp'), '| ', ''); ?> </p>
<p class="postmetadata"><?php the_tags(); ?></p>

<div class="nav prev left"><?php next_post_link('%link', '&larr;', TRUE); ?></div>
<div class="nav next right"><?php previous_post_link('%link', '&rarr;', TRUE); ?></div>
<div class="clear"></div>

			<?php endwhile; else : ?>

				<h2 class="center"><?php _e('Not Found', 'gpp'); ?></h2>
				<p class="center"><?php _e("Sorry, but you are looking for something that isn't here.", "gpp"); ?></p>
				<?php get_search_form(); ?>

			<?php endif; ?>
<?php comments_template(); ?>
<?php get_template_part( 'bottom' ); ?>
<?php get_footer(); ?>