<?php
	global $do_not_duplicate;
	$do_not_duplicate = array();
	$options = get_option('f8_theme_options');
	$slideshow = $options['selectinput'];
	$slideshow_cats = $options['cats'];
	if ( $slideshow == 2 ) {
?>

<!-- Begin minimal slideshow -->
<?php query_posts('showposts=5&cat='.$slideshow_cats.''); $i=0; ?>
	<div id="slideshow-posts">
	<?php while (have_posts()) : the_post(); $i++; ?>
			<div class="slide"><?php get_the_image( array( 'custom_key' => array( 'slideshow' ), 'default_size' => '950x425', 'width' => '950', 'height' => '425', 'image_class' => '', 'default_image' => 'wp-content/themes/f8-lite/images/default_header.jpg' ) ); ?></div>
	<?php endwhile; wp_reset_query(); $i=0; ?>
	</div>
	
<?php } elseif ( $slideshow == 3 ) { ?>

<!-- Begin slideshow with overlay -->
<ul id="slideshow-nav"></ul>
    <?php $i = 0; $slideshow_query = new WP_Query("showposts=5&cat='.$slideshow_cats.'"); ?>	
    <div id="slideshow-posts">
        <?php while ($slideshow_query->have_posts() && $i<=5) : $slideshow_query->the_post(); $do_not_duplicate[$i] = $post->ID; ?>
    		<?php $i++; ?>
			<div class="slide">
				<div class="slide-thumbnail">
				<?php get_the_image( array( 'custom_key' => array( 'slideshow' ), 'default_size' => '950x425', 'width' => '950', 'height' => '425', 'image_class' => '', 'default_image' => 'wp-content/themes/f8-lite/images/default_header.jpg' ) ); ?>
				</div>
				<div class="slide-details">
					<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<div class="description">
					    <?php the_excerpt(); ?>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		<?php endwhile; wp_reset_query(); $i = 0; ?>
	</div>

<?php } else { echo '<!-- No slideshow -->'; }