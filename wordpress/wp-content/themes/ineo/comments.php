<?php
 if (!empty($post->post_password) &&$_COOKIE['wp-postpass_'.COOKIEHASH] != $post->post_password) : ;echo '	<div class="errorbox">
		';_e('Enter your password to view comments.','inove');;echo '	</div>
';return;endif;;echo '
';
$options = get_option('inove_options');
if (function_exists('wp_list_comments')) {
$trackbacks = $comments_by_type['pings'];
}else {
$trackbacks = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->comments WHERE comment_post_ID = %d AND comment_approved = '1' AND (comment_type = 'pingback' OR comment_type = 'trackback') ORDER BY comment_date",$post->ID));
}
;echo '
';if ($comments ||comments_open()) : ;echo '<div id="comments">

	<div id="cmtswitcher" class="clearfix">
		';if(pings_open()) : ;echo '			<a id="commenttab" class="curtab" href="javascript:void(0);" rel="nofollow">';_e('Comments','inove');echo (' ('.(count($comments)-count($trackbacks)) .')');;echo '</a>
			<a id="trackbacktab" class="tab" href="javascript:void(0);" rel="nofollow">';_e('Trackbacks','inove');echo (' ('.count($trackbacks) .')');;echo '</a>
		';else : ;echo '			<a id="commenttab" class="curtab" href="javascript:void(0);">';_e('Comments','inove');echo (' ('.(count($comments)-count($trackbacks)) .')');;echo '</a>
		';endif;;echo '		';if(comments_open()) : ;echo '			<span class="addcomment"><a rel="nofollow"  href="#respond">';_e('Leave a comment','inove');;echo '</a></span>
		';endif;;echo '		';if(pings_open()) : ;echo '			<span class="addtrackback"><a href="';trackback_url();;echo '" rel="nofollow">';_e('Make a trackback','inove');;echo '</a></span>
		';endif;;echo '	</div>

	<!-- comments START -->
	<ol id="thecomments" class="commentlist">
	';
if ($comments &&count($comments) -count($trackbacks) >0) {
if (function_exists('wp_list_comments')) {
wp_list_comments('type=comment&callback=custom_comments');
}else {
foreach ($comments as $comment) {
if($comment->comment_type != 'pingback'&&$comment->comment_type != 'trackback') {
custom_comments($comment,null,null);
}
}
}
}else {
;echo '		<li class="messagebox">
			';_e('No comments yet.','inove');;echo '		</li>
	';
}
;echo '	</ol>
	<!-- comments END -->

';
if (get_option('page_comments')) {
$comment_pages = paginate_comments_links('echo=0');
if ($comment_pages) {
;echo '		<div id="commentnavi">
			<span class="pages">';_e('Comment pages','inove');;echo '</span>
			<div id="commentpager">
				';echo $comment_pages;;echo '			</div>
			<div class="fixed"></div>
		</div>
';
}
}
;echo '
	<!-- trackbacks START -->
	';if (pings_open()) : ;echo '		<ol id="thetrackbacks" class="trackbacklist">
			';if ($trackbacks) : $trackbackcount = 0;;echo '				';foreach ($trackbacks as $comment) : ;echo '					<li class="trackback">
						<a rel="nofollow external" class="title" href="';comment_author_url() ;echo '">';comment_author();;echo '</a>
						<div class="date">
							';printf( __('%1$s at %2$s','inove'),get_comment_time(__('F jS, Y','inove')),get_comment_time(__('H:i','inove')) );;echo '';edit_comment_link(__('Edit','inove'),' | ','');;echo '						</div>
					</li>
				';endforeach;;echo '
			';else : ;echo '				<li class="messagebox">
					';_e('No trackbacks yet.','inove');;echo '				</li>

			';endif;;echo '		</ol>
	';endif;;echo '	<div class="fixed"></div>
	<!-- trackbacks END -->

</div>
';endif;;echo '
';if (!comments_open()) : 
;echo '	<div class="messagebox">
		';_e('Comments are closed.','inove');;echo '	</div>
';elseif ( get_option('comment_registration') &&!$user_ID ) : 
;echo '	<div id="comment_login" class="messagebox">
		';
if (function_exists('wp_login_url')) {
$login_link = wp_login_url();
}else {
$login_link = get_option('siteurl') .'/wp-login.php?redirect_to='.urlencode(get_permalink());
}
;echo '		';printf(__('You must be <a href="%s">logged in</a> to post a comment.','inove'),$login_link);;echo '	</div>

';else : ;echo '	<form action="';echo get_option('siteurl');;echo '/wp-comments-post.php" method="post" id="commentform">
	<div id="respond">

		';if ($user_ID) : ;echo '			';
if (function_exists('wp_logout_url')) {
$logout_link = wp_logout_url();
}else {
$logout_link = get_option('siteurl') .'/wp-login.php?action=logout';
}
;echo '			<div class="row">
				';_e('Logged in as','inove');;echo ' <a href="';echo get_option('siteurl');;echo '/wp-admin/profile.php"><strong>';echo $user_identity;;echo '</strong></a>.
				 <a href="';echo $logout_link;;echo '" title="';_e('Log out of this account','inove');;echo '">';_e('Logout &raquo;','inove');;echo '</a>
			</div>

		';else : ;echo '			';if ( $comment_author != "") : ;echo '				<script type="text/javascript">function setStyleDisplay(id, status){document.getElementById(id).style.display = status;}</script>
				<div id="welcome-row" class="row">
					';printf(__('Welcome back <strong>%s</strong>.','inove'),$comment_author) ;echo '					<a href="javascript:void(0);" id="show_author_info" rel="nofollow">';_e('Change &raquo;','inove');;echo '</a>
				</div>
			';endif;;echo '
			<div id="author_info">
				<div class="row">
					<input type="text" name="author" id="author" class="textfield" value="';echo $comment_author;;echo '" size="24" tabindex="1" />
					<label for="author" class="small">';_e('Name','inove');;echo ' ';if ($req) _e('(required)','inove');;echo '</label>
				</div>
				<div class="row">
					<input type="text" name="email" id="email" class="textfield" value="';echo $comment_author_email;;echo '" size="24" tabindex="2" />
					<label for="email" class="small">';_e('E-Mail (will not be published)','inove');;echo ' ';if ($req) _e('(required)','inove');;echo '</label>
				</div>
				<div class="row">
					<input type="text" name="url" id="url" class="textfield" value="';echo $comment_author_url;;echo '" size="24" tabindex="3" />
					<label for="url" class="small">';_e('Website','inove');;echo '</label>
				</div>
			</div>
			';if ( $comment_author != "") : ;echo '				<script type="text/javascript">setStyleDisplay(\'author_info\',\'none\');</script>
			';endif;;echo ' 

		';endif;;echo '
		<!-- comment input -->
		<div class="row">
			<textarea name="comment" id="comment" tabindex="4" rows="8" cols="50"></textarea>
		</div>

		<!-- comment submit and rss -->
		<div id="submitbox" class="clearfix">
			<a rel="nofollow" class="feed" href="';bloginfo('comments_rss2_url');;echo '">';_e('Subscribe to comments feed','inove');;echo '</a>
			<div class="submitbutton">
				<input name="submit" type="submit" id="cmt-submit" class="button" tabindex="5" value="';_e('Submit Comment','inove');;echo '" />
			</div>
			';if (function_exists('highslide_emoticons')) : ;echo '				<div id="emoticon">';highslide_emoticons();;echo '</div>
			';endif;;echo '			<input type="hidden" name="comment_post_ID" value="';echo $id;;echo '" />
		</div>

	</div>
	';do_action('comment_form',$post->ID);;echo '	</form>

';endif;?>