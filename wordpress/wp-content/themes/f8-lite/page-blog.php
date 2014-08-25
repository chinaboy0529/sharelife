<?php
/*
Template Name: Blog
*/
?>
<?php get_header(); ?>

	<div class="content">
		<h3 class="sub"><?php _e('Blog','gpp'); ?></h3>
		<?php 
		$temp = $wp_query;
		$wp_query = NULL;
		$wp_query = new WP_Query();
		$wp_query->query('&paged='.$paged); $tb_counter = 1;
		while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		<div <?php post_class(); ?>>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s','gpp'),the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h2>
			<div class="entry">
				<?php global $more; $more = 0; the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:' ), 'after' => '</div>' ) ); ?>
			</div><div class="clear"></div>
		</div><div class="clear"></div>
		<p class="postmetadata"><?php the_time(__('M d, Y', 'gpp')); ?> | <?php _e('Categories: ','gpp'); if (the_category(', '))  the_category(); ?> <?php if (get_the_tags()) the_tags(__('| Tags: ','gpp')); ?> | <?php comments_popup_link(__('Leave A Comment &#187;', 'gpp'), __('1 Comment &#187;', 'gpp'),_n('% Comment &#187;', '% Comments &#187;',get_comments_number (),'gpp')); ?> <?php edit_post_link(__('Edit','gpp'), '| ', ''); ?></p>
		<?php $tb_counter++; endwhile; ?>
		<div class="nav-interior">
			<div class="prev"><?php next_posts_link(__('&laquo; Older Entries','gpp')); ?></div>
			<div class="next"><?php previous_posts_link(__('Newer Entries &raquo;','gpp')); ?></div>
		</div><div class="clear"></div>
		<?php $wp_query = NULL; $wp_query = $temp;?>
	</div>

<?php get_template_part( 'bottom' ); ?>
<?php get_footer(); ?>