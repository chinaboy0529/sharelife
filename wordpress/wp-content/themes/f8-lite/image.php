<?php get_header(); ?>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class(); ?>>
			<h2 class="entry-title"><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a> &raquo; <?php the_title(); ?></h2>
			<div class="entry">
				<p class="attachment"><a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image( $post->ID, 'medium' ); ?></a></p>
				
				<div class="clear"></div>
				
                <div class="caption"><?php if ( !empty($post->post_excerpt) ) the_excerpt(); // this is the "caption" ?></div>

				<?php the_content(); ?>

				<div class="navigation">
					<div class="alignleft"><?php previous_image_link() ?></div>
					<div class="alignright"><?php next_image_link() ?></div>
				</div>
				<div class="clear"></div>

				<p class="postmetadata alt">
					<small>
						<?php printf(__('This entry was posted on %1$s at %2$s.','gpp'),get_the_time(__('l, F jS, Y','gpp')),get_the_time());?>
						<?php _e('It is filed under','gpp'); ?> <?php the_category(', '); ?>.
						<?php the_taxonomies(); ?>
						<?php printf(__('You can follow any responses to this entry through the <a href="%1$s" title="%2$s feed">%2$s</a> feed.','gpp'),get_post_comments_feed_link(),__('RSS 2.0','gpp')); ?>

						<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Both Comments and Pings are open ?>
							<?php printf(__('You can <a href="#respond" title="leave a response">leave a response</a> or <a href="%s" title="trackback">trackback</a> from your own site.','gpp'),get_trackback_url()); ?>

						<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Only Pings are Open ?>
							<?php printf(__('Responses are currently closed, but you can <a href="%s" title="trackback">trackback</a> from your own site.','gpp'),get_trackback_url()); ?>

						<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not ?>
							<?php _e('You can skip to the end and leave a response. Pinging is currently not allowed.','gpp'); ?>

						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open ?>
							<?php _e('Both comments and pings are currently closed.','gpp'); ?>

						<?php } edit_post_link(__('Edit this entry','gpp'),'','.'); ?>

					</small>
				</p>

			</div>

		</div>

	<?php comments_template(); ?>
	
	<?php endwhile; else: ?>

		<p><?php _e('Sorry, no attachments matched your criteria.','gpp'); ?></p>

<?php endif; ?>

<?php get_template_part( 'bottom' ); ?>

<!-- Begin Footer -->
<?php get_footer(); ?>