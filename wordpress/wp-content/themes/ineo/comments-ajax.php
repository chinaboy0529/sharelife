<?php

if ( 'POST'!= $_SERVER['REQUEST_METHOD'] ) {
header('Allow: POST');
header('HTTP/1.1 405 Method Not Allowed');
header('Content-Type: text/plain');
exit;
}
require_once(dirname(__FILE__)."/../../../wp-load.php");
nocache_headers();
$comment_post_ID = isset($_POST['comment_post_ID']) ?(int) $_POST['comment_post_ID'] : 0;
$status = $wpdb->get_row( $wpdb->prepare("SELECT post_status, comment_status FROM $wpdb->posts WHERE ID = %d",$comment_post_ID) );
if ( empty($status->comment_status) ) {
do_action('comment_id_not_found',$comment_post_ID);
err(__('Invalid comment status.'));
}elseif ( !comments_open($comment_post_ID) ) {
do_action('comment_closed',$comment_post_ID);
err(__('Sorry, comments are closed for this item.'));
}elseif ( in_array($status->post_status,array('draft','future','pending') ) ) {
do_action('comment_on_draft',$comment_post_ID);
err(__('Invalid comment status.'));
}elseif ( 'trash'== $status->post_status ) {
do_action('comment_on_trash',$comment_post_ID);
err(__('Invalid comment status.'));
}elseif ( post_password_required($comment_post_ID) ) {
do_action('comment_on_password_protected',$comment_post_ID);
err(__('Password Protected'));
}else {
do_action('pre_comment_on_post',$comment_post_ID);
}
$comment_author       = ( isset($_POST['author']) )  ?trim(strip_tags($_POST['author'])) : null;
$comment_author_email = ( isset($_POST['email']) )   ?trim($_POST['email']) : null;
$comment_author_url   = ( isset($_POST['url']) )     ?trim($_POST['url']) : null;
$comment_content      = ( isset($_POST['comment']) ) ?trim($_POST['comment']) : null;
$edit_id              = ( isset($_POST['edit_id']) ) ?$_POST['edit_id'] : null;
$commentcount         = ( isset($_POST['index']) )   ?trim($_POST['index']) : null;
$user = wp_get_current_user();
if ( $user->ID ) {
if ( empty( $user->display_name ) )
$user->display_name=$user->user_login;
$comment_author       = $wpdb->escape($user->display_name);
$comment_author_email = $wpdb->escape($user->user_email);
$comment_author_url   = $wpdb->escape($user->user_url);
if ( current_user_can('unfiltered_html') ) {
if ( wp_create_nonce('unfiltered-html-comment_'.$comment_post_ID) != $_POST['_wp_unfiltered_html_comment'] ) {
kses_remove_filters();
kses_init_filters();
}
}
}else {
if ( get_option('comment_registration') ||'private'== $status->post_status )
err(__('Sorry, you must be logged in to post a comment.'));
}
$comment_type = '';
if ( get_option('require_name_email') &&!$user->ID ) {
if ( 6 >strlen($comment_author_email) ||''== $comment_author )
err( __('Error: please fill the required fields (name, email).'));
elseif ( !is_email($comment_author_email))
err(__('Error: please enter a valid email address.'));
}
if ( ''== $comment_content )
err(__('Error: please type a comment.'));
function err($ErrMsg) {
header('HTTP/1.1 405 Method Not Allowed');
echo $ErrMsg;
exit;
}
$dupe = "SELECT comment_ID FROM $wpdb->comments WHERE comment_post_ID = '$comment_post_ID' AND ( comment_author = '$comment_author' ";
if ( $comment_author_email ) $dupe .= "OR comment_author_email = '$comment_author_email' ";
$dupe .= ") AND comment_content = '$comment_content' LIMIT 1";
if ( $wpdb->get_var($dupe) ) {
err(__('Duplicate comment detected; it looks as though you&#8217;ve already said that!'));
}
if ( $lasttime = $wpdb->get_var( $wpdb->prepare("SELECT comment_date_gmt FROM $wpdb->comments WHERE comment_author = %s ORDER BY comment_date DESC LIMIT 1",$comment_author) ) ) {
$time_lastcomment = mysql2date('U',$lasttime,false);
$time_newcomment  = mysql2date('U',current_time('mysql',1),false);
$flood_die = apply_filters('comment_flood_filter',false,$time_lastcomment,$time_newcomment);
if ( $flood_die ) {
err(__('You are posting comments too quickly.  Slow down.'));
}
}
$comment_parent = isset($_POST['comment_parent']) ?absint($_POST['comment_parent']) : 0;
$commentdata = compact('comment_post_ID','comment_author','comment_author_email','comment_author_url','comment_content','comment_type','comment_parent','user_ID');
$commentdata['user_id'] = (int) $commentdata['user_ID'];
if ( $edit_id ){
$comment_id = $commentdata['comment_ID'] = $edit_id;
wp_update_comment( $commentdata );
}else {
$comment_id = wp_new_comment( $commentdata );
}
$comment = get_comment($comment_id);
if ( !$user->ID ) {
$comment_cookie_lifetime = apply_filters('comment_cookie_lifetime',30000000);
setcookie('comment_author_'.COOKIEHASH,$comment->comment_author,time() +$comment_cookie_lifetime,COOKIEPATH,COOKIE_DOMAIN);
setcookie('comment_author_email_'.COOKIEHASH,$comment->comment_author_email,time() +$comment_cookie_lifetime,COOKIEPATH,COOKIE_DOMAIN);
setcookie('comment_author_url_'.COOKIEHASH,esc_url($comment->comment_author_url),time() +$comment_cookie_lifetime,COOKIEPATH,COOKIE_DOMAIN);
}
$comment_depth = 1;
$tmp_c = $comment;
while($tmp_c->comment_parent != 0){
$comment_depth++;
$tmp_c = get_comment($tmp_c->comment_parent);
}
;echo '
<li class="hreview clearfix ';if($comment->comment_author_email == get_the_author_email()) {echo 'admincomment';}else {echo 'evencomment';};echo '" id="comment-';comment_ID() ;echo '">
<div class="info clearfix">
	';if (function_exists('get_avatar') &&get_option('show_avatars')) {echo get_avatar($comment,32);};echo '	';if (get_comment_author_url()) : ;echo '		<a class="reviewer" id="reviewer-';comment_ID() ;echo '" href="';comment_author_url() ;echo '" rel="external nofollow">
	';else : ;echo '		<span class="reviewer" id="reviewer-';comment_ID() ;echo '">
	';endif;;echo '
	';comment_author();;echo '
	';if(get_comment_author_url()) : ;echo '		</a>
	';else : ;echo '		</span>
	';endif;;echo '		 | <a class="anchor" rel="nofollow" href="#comment-';comment_ID() ;echo '">';printf('#%1$s',$commentcount +1);;echo '</a>
	<div class="dtreviewed">';printf( __('%1$s at %2$s','inove'),get_comment_time(__('F jS, Y','inove')),get_comment_time(__('H:i','inove')) );;echo '</div>
</div>

';if ($comment->comment_approved == '0') : ;echo '	<p><small>';_e('Your comment is awaiting moderation.','inove');;echo '</small></p>
';endif;;echo '
<div class="description" id="commentbody-';comment_ID() ;echo '">
	';comment_text();;echo '</div>';?>