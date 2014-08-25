<div id="footer">
<p class="quiet">
		<?php esc_html_e('Powered by', 'gpp'); ?> <a href="http://wordpress.org/"><?php esc_html_e('Wordpress', 'gpp'); ?></a> <?php esc_html_e('using the', 'gpp'); ?> <a href="http://graphpaperpress.com">F8 Lite Theme</a><br /><a href="<?php bloginfo('rss2_url'); ?>" class="feed"><?php esc_html_e('subscribe to posts', 'gpp'); ?></a> <?php esc_html_e('or', 'gpp'); ?> <a href="<?php bloginfo('comments_rss2_url'); ?>" class="feed"><?php esc_html_e('subscribe to comments', 'gpp'); ?></a><br /><?php esc_html_e('All content', 'gpp'); ?> &copy; <?php echo date("Y"); ?> <?php esc_html_e('by', 'gpp'); ?> <?php bloginfo('name'); ?><br /><?php wp_loginout(); ?>
		<!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. -->
	</p>
</div>
</div>
</div>
	<?php wp_footer(); ?>
</body>
</html>
