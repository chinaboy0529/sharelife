<?php
 get_header();;echo '';
$options = get_option('inove_options');
if (function_exists('wp_list_comments')) {
add_filter('get_comments_number','comment_count',0);
}
;echo '
';if (is_search()) : ;echo '	<div class="boxcaption"><h3>';_e('Search Results','inove');;echo '</h3></div>
	<div class="box">';printf( __('Keyword: &#8216;%1$s&#8217;','inove'),wp_specialchars($s,1) );;echo '</div>

';else : ;echo '	<div class="boxcaption"><h3>';_e('Archive','inove');;echo '</h3></div>
	<div class="box">
		';
if (is_category()) {
printf( __('Archive for the &#8216;%1$s&#8217; Category','inove'),single_cat_title('',false) );
}elseif (is_tag()) {
printf( __('Posts Tagged &#8216;%1$s&#8217;','inove'),single_tag_title('',false) );
}elseif (is_day()) {
printf( __('Archive for %1$s','inove'),get_the_time(__('F jS, Y','inove')) );
}elseif (is_month()) {
printf( __('Archive for %1$s','inove'),get_the_time(__('F, Y','inove')) );
}elseif (is_year()) {
printf( __('Archive for %1$s','inove'),get_the_time(__('Y','inove')) );
}elseif (is_author()) {
_e('Author Archive','inove');
}elseif (isset($_GET['paged']) &&!empty($_GET['paged'])) {
_e('Blog Archives','inove');
}
;echo '	</div>
';endif;;echo '
';if (have_posts()) : $i=0;while (have_posts()) : $i++;the_post();update_post_caches($posts);;echo '	<div class="post" id="post-';the_ID();;echo '">
		<h2><a class="title" href="';the_permalink() ;echo '" rel="bookmark">';the_title();;echo '</a></h2>
		<div class="info clearfix">
			<span class="date">';the_time(__('F jS, Y','inove')) ;echo '</span>
			';if( method_exists( $GoogleTranslation,'google_ajax_translate_button') ) : ;echo '				<span id="translate_button_post-';the_ID();;echo '" class="translate"><a href="javascript:void(0);" onclick="show_translate_popup(\'en\', \'post\', ';the_ID();;echo ');" rel="nofollow">Translate</a></span>
			';endif;;echo '			';if ($options['categories']) : ;echo '<span class="cata">';the_category(', ');;echo '</span>';endif;;echo '			';if ($options['author']) : ;echo '<span class="author">';the_author_posts_link();;echo '</span>';endif;;echo '			';edit_post_link(__('Edit','inove'),'<span class="editpost">','</span>');;echo '			<span class="comments">
				';comments_popup_link(__('No comments','inove'),__('1 comment','inove'),__('% comments','inove'),'',__('Comments off','inove'));;echo '				<span class="views">';if (function_exists('the_views')) the_views(true,' | ','');;echo '</span>
			</span>
		</div>
		';if ($i>0){;echo '			<div class="content blank_content clearfix"></div>
		';}else {;echo '			<div class="content clearfix">';the_content(__('Read more...','inove'));;echo '</div>
		';};;echo '		';if ($options['tags']) : ;echo '<div class="under"><span class="tag">';the_tags('',', ','');;echo '</span></div>';endif;;echo '	</div>
';endwhile;else : ;echo '	<div class="errorbox">
		';_e('Sorry, no posts matched your criteria.','inove');;echo '	</div>
';endif;;echo '
<div id="pagenavi">
	';if(function_exists('wp_pagenavi')) : ;echo '		';wp_pagenavi() ;echo '	';else : ;echo '		<span class="newer">';previous_posts_link(__('Newer Entries','inove'));;echo '</span>
		<span class="older">';next_posts_link(__('Older Entries','inove'));;echo '</span>
	';endif;;echo '	<div class="fixed"></div>
</div>

';get_footer();?>