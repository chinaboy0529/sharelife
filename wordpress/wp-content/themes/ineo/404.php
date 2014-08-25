<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="';bloginfo('html_type');;echo '; charset=';bloginfo('charset');;echo '" />

	<title>';bloginfo('name');;echo '';wp_title();;echo '</title>
	<link rel="alternate" type="application/rss+xml" title="';_e('RSS 2.0 - all posts','inove');;echo '" href="';echo $feed;;echo '" />
	<link rel="alternate" type="application/rss+xml" title="';_e('RSS 2.0 - all comments','inove');;echo '" href="';bloginfo('comments_rss2_url');;echo '" />

	<!-- style START -->
	<link rel="stylesheet" href="';bloginfo('template_url');;echo '/404.css" type="text/css" media="screen" />
	<!-- style END -->

</head>

<body>

<div id="container">
	<div id="talker">
		<a href="';bloginfo('url');;echo '/" rel="nofollow"><img src="';bloginfo('template_url');;echo '/img/lovelace.gif" alt="';_e('Talker','inove');;echo '" /></a>
	</div>
	<div id="notice">
		<h1>';_e('Welcome to 404 error page!','inove');;echo '</h1>
		<p>';_e("Welcome to this customized error page. You've reached this page because you've clicked on a link that does not exist. This is probably our fault... but instead of showing you the basic '404 Error' page that is confusing and doesn't really explain anything, we've created this page to explain what went wrong.",'inove');;echo '</p>
		<p>';_e("You can either (a) click on the 'back' button in your browser and try to navigate through our site in a different direction, or (b) click on the following link to go to homepage.",'inove');;echo '</p>
		<p>';_e("欢迎您的到来. 您会到达这个页面证明您刚刚点击了失效的链接. 当然, 也可能是我们搞错了... 但与其向您展示一个混乱的, 没有任何说明的 404 出错页面, 我们创建这个页面可以向您解释究竟出了些什么错.",'inove');;echo '</p>
		<p>';_e("您现在可以 (a) 点击浏览器上的 \"返回\" 按钮并尝试通过其他方式进入我们的页面, 或者 (b) 点击下方的链接转跳到网站的首页.",'inove');;echo '</p>
		<div class="back">
			<a href="';bloginfo('url');;echo '/">';_e('Back to homepage &raquo;','inove');;echo '</a>
		</div>
	</div>
</div>

</body>
</html>
';?>