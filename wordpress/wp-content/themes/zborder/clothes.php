<?php
/*
Template Name:服饰配搭类
*/
?>
<?php get_header(); ?>


<div id="">
	<?php the_post(); ?>

	<div class="post_path">
		<?php _e('You are here:', 'zborder'); ?> <a class="first_home" rel="nofollow" title="<?php _e('Go to homepage', 'zborder'); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('Home', 'zborder'); ?></a>
		&raquo; <?php the_title(); ?>
	</div>
	<div class="post post_s" id="post-<?php the_ID(); ?>">
		<?php the_title( '<h1  class="title title_s">', '</h1>' ); ?>
		<span style="color:gray"><?php  the_excerpt() ;?></span>
		<div class="p_meta_s_t">
			
			<span class="jtxs_bg"></span>
		</div>
		
	</div>

<?php  query_posts( 'post_type=clothes');

?>
<div style="clear: both;margin-top: 10px;">
	
		<?php while (have_posts()) : the_post();?>
		
		
		<div style="width:226px;height: 240px;float: left;margin-left: 10px;background-color: #ffffff;border:1px solid #d7d7d7;margin-bottom: 10px;">
        <a href="<?php echo esc_url( get_permalink() ) ?>" target="_self">
          <img style="width: 180px;height: 175px;margin: 13px;margin-bottom: 8px;" src="<?php echo  wp_get_attachment_url( get_post_thumbnail_id($post->ID) )?>">
        </a>
        <div style="margin-left: 13px;margin-right: 13px;">
          <a href="<?php echo esc_url( get_permalink() ) ?>" target="_self"><?php the_title() ?></a>
        </div>
      </div>
  
	
		
		<?php endwhile; ?>
	
	
	
	
	
</div><!--content-->



<?php get_footer(); ?>