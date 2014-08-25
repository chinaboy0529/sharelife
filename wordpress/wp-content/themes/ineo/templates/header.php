<?php
echo '<!-- header START -->
<div id="header">
	<div class="inner clearfix">

	<div id="caption">
		<span id="title"><a href="';bloginfo('url');;echo '/">';bloginfo('name');;echo '</a></span>
		<div id="tagline">';echo html_entity_decode(get_bloginfo('description'));;echo '</div>
	</div>

	<!-- banner START -->
	';if( $options['banner_content'] &&(
($options['banner_registered'] &&$user_ID) ||
($options['banner_commentator'] &&!$user_ID &&isset($_COOKIE['comment_author_'.COOKIEHASH])) ||
($options['banner_visitor'] &&!$user_ID &&!isset($_COOKIE['comment_author_'.COOKIEHASH]))
) ) : ;echo '		<div class="banner">
			';echo($options['banner_content']);;echo '		</div>
	';endif;;echo '	<!-- banner END -->

	</div>
</div>
<!-- header END -->

<!-- navigation START -->
<div id="navigation">
	<div class="inner clearfix">
	<!-- menus START -->
	<ul id="menus">
		<li class="';echo($home_menu);;echo '"><a class="home" href="';echo get_settings('home');;echo '/">';_e('Home','inove');;echo '</a></li>
		';
if($options['menu_type'] == 'categories') {
wp_list_categories('title_li=0&orderby=name&show_count=0');
}else {
$pages = wp_list_pages('echo=0&exclude=247&title_li=0&sort_column=menu_order');
echo preg_replace('/title=\"(.*?)\"/','',$pages);
}
;echo '	</ul>
	<!-- menus END -->
	</div>
</div>
<!-- navigation END -->
';?>