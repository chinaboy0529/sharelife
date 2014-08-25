<?php


$options = get_option('inove_options');

if($options['feed'] &&$options['feed_url']) {

if (substr(strtoupper($options['feed_url']),0,7) == 'HTTP://') {

$feed = $options['feed_url'];

}else {

$feed = 'http://'.$options['feed_url'];

}

}else {

$feed = get_bloginfo('rss2_url');

}

;echo '


<!-- sidebar START -->

<div id="sidebar">



<!-- sidebar north START -->

';if ( !function_exists('dynamic_sidebar') ||!dynamic_sidebar('north_sidebar') ) : ;echo '


	<!-- posts -->

	';

if (is_single()) {

$posts_widget_title = 'Recent Posts';

}else {

$posts_widget_title = 'Random Posts';

}

;echo '


	<div class="widget">

		<div class="title">';echo $posts_widget_title;;echo '</div>

		<ul>

			';

if (is_single()) {

$posts = get_posts('numberposts=5&orderby=post_date');

}else {

$posts = get_posts('numberposts=5&orderby=rand');

}

foreach($posts as $post) {

setup_postdata($post);

echo '<li><a href="'.get_permalink() .'">'.get_the_title() .'</a></li>';

}

$post = $posts[0];

;echo '
		</ul>

	</div>



	<!-- showcase -->

	';if( ($options['showcase_content1'] ||$options['showcase_content2'] ||$options['showcase_content3'] ||$options['showcase_content4'] ||$options['showcase_content5']) &&(

($options['showcase_registered'] &&$user_ID) ||

($options['showcase_commentator'] &&!$user_ID &&isset($_COOKIE['comment_author_'.COOKIEHASH])) ||

($options['showcase_visitor'] &&!$user_ID &&!isset($_COOKIE['comment_author_'.COOKIEHASH]))

) ) : ;echo '
		<div class="widget widget_ads clearfix">

			';if($options['showcase_caption']) : ;echo '
				<div class="title">';if($options['showcase_title']){echo($options['showcase_title']);}else{_e('Showcase','inove');};echo '</div>

			';endif;;echo '
			<ul>

			';

$no_ad = '<li><a href="http://www.neone.net/contact/#contact"><img src="/wp-content/themes/ineo/sai/0.gif" alt="" width="125" height="125"/></a></li>';

if($options['showcase_type'] == '4sq'){

$ads = array();

if($options['showcase_content1'] !='') $ads[] = $options['showcase_content1'];

if($options['showcase_content2'] !='') $ads[] = $options['showcase_content2'];

if($options['showcase_content3'] !='') $ads[] = $options['showcase_content3'];

if($options['showcase_content4'] !='') $ads[] = $options['showcase_content4'];

shuffle($ads);

foreach ($ads as $ad){

$html .= "<li>".$ad ."</li>\n";

}

for ($i = 1;$i <= 4 -count($ads);$i++){

$html .= $no_ad;

}

echo $html;

}else{

echo($options['showcase_content5']);

}

;echo '
			</ul>

		</div>

	';endif;;echo '


	<!-- Posts View  -->

	';if (is_home() &&function_exists('get_most_viewed')): ;echo '
		<div class="widget">

			<div class="title">Hot Posts</div>

		   <ul>

			  ';get_most_viewed('post',5);;echo '
		   </ul>

		</div>

	';elseif (is_tag() &&function_exists('get_most_viewed_tag') &&!empty($tag_id)): ;echo '
		<div class="widget">

			<div class="title">Hot Posts</div>

			<ul>

			  ';get_most_viewed_tag($tag_id,'post',5);;echo '
			</ul>

		</div>

	';elseif (is_category() &&function_exists('get_most_viewed_category') &&!empty($cat)): ;echo '
		<div class="widget">

			<div class="title">Hot Posts</div>

			<ul>

			';get_most_viewed_category($cat,'post',5);;echo '
			</ul>

		</div>

	';elseif (function_exists('get_most_viewed')) : ;echo '
		<div class="widget">

			<div class="title">Hot Posts</div>

		   <ul>

			  ';get_most_viewed('post',5);;echo '
		   </ul>

		</div>

	';endif;;echo '


	<!-- recent comments -->

	';if( function_exists('wp_recentcomments') ) : ;echo '
		<div class="widget">

			<div class="title">Recent Comments</div>

			<ul>

				';wp_recentcomments('limit=5&length=16&post=false&smilies=true');;echo '
			</ul>

		</div>

	';endif;;echo '


	<!-- tag cloud -->

	<div id="tag_cloud" class="widget">

		<div class="title">Tag Cloud</div>

		';wp_tag_cloud('smallest=8&largest=16');;echo '
	</div>



	<!-- top commentators -->

	';

if (is_home()) {

$query="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 1 MONTH ) AND user_id='0' AND comment_author_email != 'neone.net@gmail.com' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 12";

$wall = $wpdb->get_results($query);

foreach ($wall as $comment){

if( $comment->comment_author_url )

$url = $comment->comment_author_url;

else $url="#";

$tmp = "<li><a rel='external nofollow' href='".$url."' title='".$comment->comment_author." (".$comment->cnt.")'>".get_avatar($comment->comment_author_email,32)."</a></li>";

$output .= $tmp;

}

$output = "<div class='widget commentators clearfix'><div class='title'>Top Commentators</div><ul>".$output."</ul></div>";

echo $output ;

}

;echo '


';endif;;echo '
<!-- sidebar north END -->



<div class="widget clearfix">



	<!-- sidebar east START -->

	<div id="eastsidebar">

	';if ( !function_exists('dynamic_sidebar') ||!dynamic_sidebar('east_sidebar') ) : ;echo '


		<!-- categories -->

		<div class="widget_categories">

			<div class="title">Categories</div>

			<ul>

				';wp_list_cats('sort_column=name&optioncount=0&depth=1');;echo '
			</ul>

		</div>



	';endif;;echo '
	</div>

	<!-- sidebar east END -->



	<!-- sidebar west START -->

	<div id="westsidebar">

	';if ( !function_exists('dynamic_sidebar') ||!dynamic_sidebar('west_sidebar') ) : ;echo '


		<!-- archives -->

		<div class="title">Archives</div>

		';if(function_exists('wp_easyarchives_widget')) : ;echo '
			';wp_easyarchives_widget("mode=none&limit=6");;echo '
		';else : ;echo '
			<ul>

				';wp_get_archives('type=monthly');;echo '
			</ul>

		';endif;;echo '


	';endif;;echo '
	</div>

	<!-- sidebar west END -->



</div>



<!-- sidebar south START -->

';if ( !function_exists('dynamic_sidebar') ||!dynamic_sidebar('south_sidebar') ) : ;echo '


	<!-- meta -->

	<div class="widget">

		<div class="title">Meta</div>

		<ul>

			';wp_register();;echo '
			<li>';wp_loginout();;echo '</li>

		</ul>

	</div>



';endif;;echo '
<!-- sidebar south END -->



</div>

<!-- sidebar END -->

';?>