<?php
echo '	</div>
	<!-- main END -->

	';
$options = get_option('inove_options');
global $inove_nosidebar;
if(!$options['nosidebar'] &&!$inove_nosidebar) {
get_sidebar();
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
;echo '	</div>
</div>
<!-- content END -->

<!-- footer START -->
<div id="footer">
	<div class="inner clearfix">
	
	<div id="copyright">
		';
global $wpdb;
$post_datetimes = $wpdb->get_row($wpdb->prepare("SELECT YEAR(min(post_date_gmt)) AS firstyear, YEAR(max(post_date_gmt)) AS lastyear FROM $wpdb->posts WHERE post_date_gmt > 1970"));
if ($post_datetimes) {
$firstpost_year = $post_datetimes->firstyear;
$lastpost_year = $post_datetimes->lastyear;
$copyright = __('Copyright &copy; ','inove') .$firstpost_year;
if($firstpost_year != $lastpost_year) {
$copyright .= '-'.$lastpost_year;
}
$copyright .= ' ';
echo $copyright;
}
;echo '<a href="';bloginfo('url');;echo '/">';bloginfo('name');;echo '</a>. All rights reserved.
		<div class="theme">
			';printf(__('Powered by <a href="%1$s">WordPress</a>. Theme by <a href="%2$s">NeOne</a>, designed by <a href="%3$s">MG12</a>. Valid <a rel="external nofollow" href="%4$s">XHTML 1.1</a> and <a rel="external nofollow" href="%5$s">CSS 3</a>.','inove'),'http://wordpress.org/','http://www.neone.net/','http://www.neoease.com/','http://validator.w3.org/check?uri=referer','http://jigsaw.w3.org/css-validator/check/referer?profile=css3');;echo '			<span style="vertical-align:middle">
			';
$options = get_option('inove_options');
if ($options['analytics']) {
echo($options['analytics_content']);
}
;echo '			</span>
		</div>
	</div>
	<span id="mt"></span>

	';wumii_add_load_script(5,3);;echo '
	</div>
</div>
<!-- footer END -->

</div>
<!-- container END -->

<script type="text/javascript">
//<![CDATA[
var global = {
	serverUrl			:\'';bloginfo('url');;echo '\',
	templateUrl			:\'';bloginfo('template_url');;echo '\',

	colapseTheme		:\'';echo($options['collapse']);;echo '\',
	includeEmailFeed	:\'';echo($options['feed_email']);;echo '\',
	emailFeedUrl		:\'';echo($options['feed_url_email']);;echo '\',
	feedUrl				:\'';echo $feed;;echo '\',
	includeSocial		:\'';echo($options['social']);;echo '\',
	socialName			:\'';echo($options['social_name']);;echo '\',
	sinaUrl				:\'';echo($options['sina_url']);;echo '\',
	twitterUrl			:\'';echo($options['twitter_url']);;echo '\',
	tencentUrl			:\'';echo($options['tencent_url']);;echo '\',
	doubanUrl			:\'';echo($options['douban_url']);;echo '\',
	subcount			:\'';if(function_exists('get_feedsky_count')) {echo get_feedsky_count();};echo '\',

	cse					:\'';echo($options['google_cse']);;echo '\',
	cseCx				:\'';echo($options['google_cse_cx']);;echo '\',
	cseUrl				:\'';bloginfo('url');;echo '/cse\',
	searchKeywords		:\'\'
};
//]]>
</script>

<script type="text/javascript" src="';bloginfo('template_url');;echo '/js/script.js?v=112814"></script>

';
wp_footer();
;echo '
</body>
</html>';?>