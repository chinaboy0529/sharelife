<?php
/*
Template Name: Links
*/
?>

<?php
	get_header();
	$linkcats = $wpdb->get_results("SELECT T1.name AS name FROM $wpdb->terms T1, $wpdb->term_taxonomy T2 WHERE T1.term_id = T2.term_id AND T2.taxonomy = 'link_category'");
?>

<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>

	<div class="post post_without_border" id="post-<?php the_ID(); ?>">
		<h2>
			<?php the_title(); ?>
		</h2>
		<div class="info clearfix">
			<?php if( method_exists( $GoogleTranslation, 'google_ajax_translate_button' ) ) : ?>
				<span id="translate_button_post-<?php the_ID(); ?>" class="translate"><a href="javascript:void(0);" onclick="show_translate_popup('en', 'post', <?php the_ID(); ?>);" rel="nofollow">Translate</a></span>
			<?php endif; ?>
			<?php edit_post_link(__('Edit', 'inove'), '<span class="editpost">', '</span>'); ?>
			<?php if ( $user_ID ) : ?>
				<div class="act">
					<span class="addlink"><a href="<?php echo get_settings('siteurl'); ?>/wp-admin/link-add.php"><?php _e('Add link', 'inove'); ?></a></span>
					<span class="editlinks"><a href="<?php echo get_settings('siteurl'); ?>/wp-admin/link-manager.php"><?php _e('Edit links', 'inove'); ?></a></span>
				</div>
			<?php endif; ?>
		</div>
		<div class="content clearfix">

			<?php if($linkcats) : foreach($linkcats as $linkcat) : ?>
				<div class="boxcaption"><h3><?php echo $linkcat->name; ?></h3></div>
				<div class="box linkcat clearfix">
					<ul>
						<?php
							$bookmarks = get_bookmarks('orderby=rand&category_name=' . $linkcat->name);
							if ( !empty($bookmarks) ) {
								foreach ($bookmarks as $bookmark) {
									echo '<li><a rel="external" href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '">' . $bookmark->link_name . '</a></li>';
								}
							}
						?>
					</ul>
				</div>
			<?php endforeach; endif; the_content(); ?>
			<div class="boxcaption"><h3>About Link Exchange</h3></div>
			<div class="box">I don't exchange links. 这里不交换链接.</div>

		</div>
	</div>

	

<?php else : ?>
	<div class="errorbox">
		<?php _e('Sorry, no posts matched your criteria.', 'inove'); ?>
	</div>
<?php endif; ?>

<?php get_footer(); ?>
