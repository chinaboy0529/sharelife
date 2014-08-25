<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Archive <?php } ?> <?php wp_title(); ?></title>

<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
<!-- Styles  -->
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/print.css" type="text/css" media="print" />
<!--[if IE]><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css" type="text/css" media="screen, projection" /><![endif]-->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head();
	$options = get_option('f8_theme_options');
?>
</head>

<body <?php body_class(); ?>>
<div class="container">
<div class="container-inner">

<!-- Begin rss -->
<div id="inside-subscribe">
	<a href="<?php bloginfo('rss2_url'); ?>" class="feed"><?php esc_html_e('posts', 'gpp'); ?></a> <a href="<?php bloginfo('comments_rss2_url'); ?>" class="feed"><?php esc_html_e('comments', 'gpp'); ?></a>
</div>
<div class="clear"></div>

<!-- Begin Masthead -->
<div id="masthead" class="clearfix">
    <h4 class="left"><a href="<?php echo get_option('home'); ?>/" title="Home"><?php bloginfo('name'); ?></a> <span class="description"><?php bloginfo('description'); ?></span><span class="contact"><?php if ( $options['phone'] != '' ) { ?><?php echo $options['phone']; ?><br /><?php } if ( $options['email'] != '' ) { ?><a href="mailto:<?php echo $options['email']; ?>"><?php echo $options['email']; ?></a><?php } ?></span></h4>
</div>

<?php
	$slideshow = $options['selectinput'];
	// Only show this is the Single Header Image is selected or if no option is set
	if ( $slideshow == 1 || !$slideshow ) {
		// Check if this is a post or page, if it has a thumbnail, and if it's a big one
		if ( is_singular() &&
				has_post_thumbnail( $post->ID ) &&
				( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( '950', '425' ) ) ) &&
				$image[1] >= HEADER_IMAGE_WIDTH ) :
			// Houston, we have a new header image!
			echo get_the_post_thumbnail( $post->ID, '950x425' );
		else : ?>
			<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="<?php bloginfo('name'); ?>" class="headerimg" />
	<?php endif; 
	} // End only show if Single Header Image is selected
?>


<?php
	if ( is_home() && $paged < 1 ) {
		get_template_part( 'slideshow' );
	}
?>

<!-- Begin Navigation -->
<?php f8_theme_nav(); ?>