<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>

	<div class="post post_without_border" id="post-<?php the_ID(); ?>">
		<h2><?php the_title(); ?></h2>
		<div class="info clearfix">
			<?php if( method_exists( $GoogleTranslation, 'google_ajax_translate_button' ) ) : ?>
				<span id="translate_button_post-<?php the_ID(); ?>" class="translate"><a href="javascript:void(0);" onclick="show_translate_popup('en', 'post', <?php the_ID(); ?>);" rel="nofollow">Translate</a></span>
			<?php endif; ?>
			<?php edit_post_link(__('Edit', 'inove'), '<span class="editpost">', '</span>'); ?>
		</div>
		<div class="content clearfix">
			<?php
				if (function_exists('wp_easyarchives')) {
					wp_easyarchives();
				} else {
					echo '<ul>';
					wp_get_archives('type=monthly&show_post_count=1');
					echo '</ul>';
				}
			?>
		</div>
	</div>

<?php else : ?>
	<div class="errorbox">
		<?php _e('Sorry, no posts matched your criteria.', 'inove'); ?>
	</div>
<?php endif; ?>

<?php get_footer(); ?>
