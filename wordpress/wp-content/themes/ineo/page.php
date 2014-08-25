<?php
 get_header();;echo '
';if (have_posts()) : the_post();update_post_caches($posts);;echo '
	<div class="post post_without_border" id="post-';the_ID();;echo '">
		<h2>';the_title();;echo '</h2>
		<div class="info clearfix">
			';if( method_exists( $GoogleTranslation,'google_ajax_translate_button') ) : ;echo '				<span id="translate_button_post-';the_ID();;echo '" class="translate"><a href="javascript:void(0);" onclick="show_translate_popup(\'en\', \'post\', ';the_ID();;echo ');" rel="nofollow">Translate</a></span>
			';endif;;echo '			';edit_post_link(__('Edit','inove'),'<span class="editpost">','</span>');;echo '			';if ($comments ||comments_open()) : ;echo '				<span class="addcomment"><a href="#respond">';_e('Leave a comment','inove');;echo '</a></span>
				<span class="comments"><a href="#comments">';_e('Go to comments','inove');;echo '</a></span>
			';endif;;echo '		</div>
		<div class="content clearfix">
			';the_content();;echo '		</div>
	</div>

	';include('templates/comments.php');;echo '
';else : ;echo '	<div class="errorbox">
		';_e('Sorry, no posts matched your criteria.','inove');;echo '	</div>
';endif;;echo '
';get_footer();?>