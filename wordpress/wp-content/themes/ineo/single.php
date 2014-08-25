<?php
 get_header();;echo '';$options = get_option('inove_options');;echo '
';if (have_posts()) : the_post();update_post_caches($posts);;echo '
	<div id="crumb">
		<a rel="nofollow" href="';echo get_settings('home');;echo '/">';_e('Home','inove');;echo '</a>
		 &gt; ';the_category(', ');;echo '	</div>

	<div class="post post_without_border" id="post-';the_ID();;echo '">
		<h1>';the_title();;echo '</h1>
		<div class="info clearfix">
			<span class="date">';the_time(__('F jS, Y','inove')) ;echo '</span>
			';if( method_exists( $GoogleTranslation,'google_ajax_translate_button') ) : ;echo '				<span id="translate_button_post-';the_ID();;echo '" class="translate"><a href="javascript:void(0);" onclick="show_translate_popup(\'en\', \'post\', ';the_ID();;echo ');" rel="nofollow">Translate</a></span>
			';endif;;echo '			';if ($options['author']) : ;echo '<span class="author">';the_author_posts_link();;echo '</span>';endif;;echo '			';edit_post_link(__('Edit','inove'),'<span class="editpost">','</span>');;echo '			';if ($comments ||comments_open()) : ;echo '				<span class="addcomment"><a rel="nofollow" href="#respond">';_e('Leave a comment','inove');;echo '</a></span>
				<span class="comments"><a rel="nofollow" href="#comments">';_e('Go to comments','inove');;echo '</a></span>
			';endif;;echo '		</div>
		<div class="content clearfix">
			';the_content();wumii_get_related_items();;echo '			';if (function_exists('multipagebar')) : ;echo '				';multipagebar();;echo '			';endif;;echo '			<div id="announce" class="msg-info">
				<strong>声明:</strong> 本文采用 <a href="http://creativecommons.org/licenses/by-nc-sa/3.0/" rel="nofollow external"><abbr title="署名-非商业性使用-相同方式共享">BY-NC-SA</abbr></a> 协议进行授权. 转载请注明转自: <a class="title" href="';the_permalink() ;echo '">';the_title();;echo '</a>
			</div>
		</div>
	</div>

	<div id="posts" class="clearfix">
		';
if(function_exists('wp23_related_posts')) {
echo '<div id="related-posts">';
echo '<div class="caption">More Articles about <h2>';
the_tags('',', ','');
echo '</h2></div>';
wp23_related_posts();
echo '</div>';
}
;echo '
		<!-- banner START -->
		';if( $options['post_banner_content'] &&(
($options['post_banner_registered'] &&$user_ID) ||
($options['post_banner_commentator'] &&!$user_ID &&isset($_COOKIE['comment_author_'.COOKIEHASH])) ||
($options['post_banner_visitor'] &&!$user_ID &&!isset($_COOKIE['comment_author_'.COOKIEHASH]))
) ) : ;echo '			<div  id="ads">
				';echo($options['post_banner_content']);;echo '			</div>
		';endif;;echo '		<!-- banner END -->

	</div>

	<div id="postnavi" class="block">
		<div class="content">
			';next_post_link('<span class="prev">%link</span>') ;echo '			';previous_post_link('<span class="next">%link</span>') ;echo '			<div class="fixed"></div>
		</div>
	</div>

	';include('templates/comments.php');;echo '
';else : ;echo '	<div class="errorbox">
		';_e('Sorry, no posts matched your criteria.','inove');;echo '	</div>
';endif;;echo '
';get_footer();?>