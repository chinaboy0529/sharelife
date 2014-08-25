<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
';
global $inove_nosidebar;
$options = get_option('inove_options');
if (is_home()) {
$home_menu = 'current_page_item';
}else {
$home_menu = 'page_item';
}
if($options['feed_url']) {
if (substr(strtoupper($options['feed_url']),0,7) == 'HTTP://') {
$feed = $options['feed_url'];
}else {
$feed = 'http://'.$options['feed_url'];
}
}else {
$feed = get_bloginfo('rss2_url');
}
;echo '
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="';bloginfo('html_type');;echo '; charset=';bloginfo('charset');;echo '" />
	<meta http-equiv="Content-Language" content="zh-CN" />
	<meta name="keywords" content="';if (is_home()) {echo($options['keywords']);}elseif (is_single()) {$tags = wp_get_post_tags($post->ID);foreach ($tags as $tag ) {$keywords = $keywords .$tag->name .", ";}echo $keywords;}else {echo '';};echo '" />
	<meta name="description" content="';if ( is_home() ) {echo($options['description']);}elseif (is_single()) {if (has_excerpt()) {the_excerpt();}else {echo mb_strimwidth(strip_tags(apply_filters('the_content',$post->post_content)),0,160,"...");}}elseif (is_category()) {printf(single_cat_title('',false));}elseif (is_tag()) {printf(single_tag_title('',false));}elseif (is_day()) {printf(get_the_time(__('F jS, Y','inove')));}elseif (is_month()) {printf(get_the_time(__('F, Y','inove')));}elseif (is_year()) {printf(get_the_time(__('Y','inove')));}else {the_title('');};echo '" />
	<title>';if ( is_single() ||is_page() ||is_category() ||is_tag() ) {wp_title('');}else {bloginfo('name');};echo '</title>
	<link rel="alternate" type="application/rss+xml" title="';_e('RSS 2.0 - all posts','inove');;echo '" href="';echo $feed;;echo '" />
	<link rel="alternate" type="application/rss+xml" title="';_e('RSS 2.0 - all comments','inove');;echo '" href="';bloginfo('comments_rss2_url');;echo '" />
	<link rel="pingback" href="';bloginfo('pingback_url');;echo '" />
	<link rel="stylesheet" href="';bloginfo('template_url');;echo '/style.css?v=121120" type="text/css" media="screen" />
	';if (strtoupper(get_locale()) == 'ZH_CN'||strtoupper(get_locale()) == 'ZH_TW') : ;echo '		<link rel="stylesheet" href="';bloginfo('stylesheet_directory');;echo '/chinese.css" type="text/css" media="screen" />
	';endif;;echo '	';if ($options['collapse']) : ;echo '		<link rel="stylesheet" href="';bloginfo('template_url');;echo '/collapse.css" type="text/css" media="screen" />
	';endif;;echo '	<!--[if IE]>
		<link rel="stylesheet" href="';bloginfo('stylesheet_directory');;echo '/ie.css?v=101700" type="text/css" media="screen" />
	<![endif]-->

	';wp_head();;echo '
</head>

';flush();;echo '
<body>
<!-- container START -->
<div id="container" ';if($options['nosidebar'] ||$inove_nosidebar){echo 'class="one-column"';};echo ' >

';include('templates/header.php');;echo '
<!-- content START -->
<div id="content">
	<div class="inner clearfix">

	<!-- main START -->
	<div id="main">
';?>