<?php
/*
Plugin Name: Adsense Made Easy - Best Simple Ad Inserter
Plugin URI:
Version: 1.21
Author: <a href="http://www.seo101.net">Seo101</a>
Description: Easily add Google Adsense to your posts, pages and sidebar
License: GPLv2 a

*/
if (!class_exists("AdsenseMadeEasy")) {
	class AdsenseMadeEasy {
		function AdsenseMadeEasy() { //constructor remains empty

		}
		function addHeaderCode() {
			?>
			<?php

		}
		function addContent($content = '') {
 	 	  global $wp_query;
	 	  global $post;

		  if (((is_single() && get_option('adsense_made_easy_displayposts')=='yes') || (is_singular() && is_page() && get_option('adsense_made_easy_displaypages')=='yes') || is_category() || is_archive()) && $wp_query->posts[0]->ID == $post->ID) {
			$original = $content;
			if (get_option('adsense_made_easy_topadalignment')=='left') {
				$content = "<div style=\"padding-left:5px; padding-right:5px; padding-bottom:5px; padding-top:5px; float: left;\">\n";
			} else if (get_option('adsense_made_easy_topadalignment')=='right') {
				$content = "<div style=\"padding-left:5px; padding-right:5px; padding-bottom:5px; padding-top:5px; float: right;\">\n";
			} else {
				$content = "<div align=\"center\" style=\"padding-left:5px; padding-right:5px; padding-bottom:5px; padding-top:5px; margin-left:auto; margin-right:auto; \">\n";
			}

			if (get_option('adsense_made_easy_topadtype')!='none') {
				$content .= "<script type=\"text/javascript\"><!--\n";
				$content .= "google_ad_client = \"";
				$content .= get_option('adsense_made_easy_publisherid');
				$content .= "\";\n";

				if (get_option('adsense_made_easy_topadtype') =='smallsquare') {
				  $content .= "google_ad_width = 200;\n";
				  $content .= "google_ad_height = 200;\n";
				} elseif (get_option('adsense_made_easy_topadtype') =='square') {
				  $content .= "google_ad_width = 250;\n";
				  $content .= "google_ad_height = 250;\n";
				}  elseif (get_option('adsense_made_easy_topadtype') =='smallrectangle') {
				  $content .= "google_ad_width = 180;\n";
				  $content .= "google_ad_height = 150;\n";
				}  elseif (get_option('adsense_made_easy_topadtype') =='mediumrectangle') {
				  $content .= "google_ad_width = 300;\n";
				  $content .= "google_ad_height = 250;\n";
				}  elseif (get_option('adsense_made_easy_topadtype') =='rectangle') {
				  $content .= "google_ad_width = 336;\n";
				  $content .= "google_ad_height = 280;\n";
				}  elseif (get_option('adsense_made_easy_topadtype') =='halfbanner') {
				  $content .= "google_ad_width = 234;\n";
				  $content .= "google_ad_height = 60;\n";
				}  elseif (get_option('adsense_made_easy_topadtype') =='banner') {
				  $content .= "google_ad_width = 468;\n";
				  $content .= "google_ad_height = 60;\n";
				}  elseif (get_option('adsense_made_easy_topadtype') =='leaderboard') {
				  $content .= "google_ad_width = 728;\n";
				  $content .= "google_ad_height = 90;\n";
				}  elseif (get_option('adsense_made_easy_topadtype') =='largeleaderboard') {
				  $content .= "google_ad_width = 970;\n";
				  $content .= "google_ad_height = 90;\n";
				} else {
				  $content .= "google_ad_width = 468;\n";
				  $content .= "google_ad_height = 60;\n";
				}

				if (get_option('adsense_made_easy_topadtextimage') =='text') {
				  $content .= "google_ad_type = \"text\";\n";
				} elseif (get_option('adsense_made_easy_topadtextimage') =='image') {
				  $content .= "google_ad_type = \"image\";\n";
				}  else {
				  $content .= "google_ad_type = \"text_image\";\n";
				}

				$content .= "google_color_border = \"";
				$content .= get_option('adsense_made_easy_bordercolor');
				$content .= "\";\n";
				$content .= "google_color_link = \"";
				$content .= get_option('adsense_made_easy_titlecolor');
				$content .= "\";\n";
				$content .= "google_color_text = \"";
				$content .= get_option('adsense_made_easy_textcolor');
				$content .= "\";\n";
				$content .= "google_color_bg = \"";
				$content .= get_option('adsense_made_easy_backgroundcolor');
				$content .= "\";\n";
				$content .= "google_color_url = \"";
				$content .= get_option('adsense_made_easy_urlcolor');
				$content .= "\";\n";
				$content .= "//-->\n";
				$content .= "</script>\n";
				$content .= "<script type=\"text/javascript\"\n";
				$content .= "src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\n";
				$content .= "</script>\n";
			}
			$content .= "</div>\n";
			$content .= $original;

			if (get_option('adsense_made_easy_bottomadtype')!='none') {
				$content .= "<center> <script type=\"text/javascript\"><!--\n";
				$content .= "google_ad_client = \"";
				$content .= get_option('adsense_made_easy_publisherid');
				$content .= "\";\n";
				if (get_option('adsense_made_easy_bottomadtype') =='smallsquare') {
				  $content .= "google_ad_width = 200;\n";
				  $content .= "google_ad_height = 200;\n";
				} elseif (get_option('adsense_made_easy_bottomadtype') =='square') {
				  $content .= "google_ad_width = 250;\n";
				  $content .= "google_ad_height = 250;\n";
				}  elseif (get_option('adsense_made_easy_bottomadtype') =='smallrectangle') {
				  $content .= "google_ad_width = 180;\n";
				  $content .= "google_ad_height = 150;\n";
				}  elseif (get_option('adsense_made_easy_bottomadtype') =='mediumrectangle') {
				  $content .= "google_ad_width = 300;\n";
				  $content .= "google_ad_height = 250;\n";
				}  elseif (get_option('adsense_made_easy_bottomadtype') =='rectangle') {
				  $content .= "google_ad_width = 336;\n";
				  $content .= "google_ad_height = 280;\n";
				}  elseif (get_option('adsense_made_easy_bottomadtype') =='halfbanner') {
				  $content .= "google_ad_width = 234;\n";
				  $content .= "google_ad_height = 60;\n";
				}  elseif (get_option('adsense_made_easy_bottomadtype') =='banner') {
				  $content .= "google_ad_width = 468;\n";
				  $content .= "google_ad_height = 60;\n";
				}  elseif (get_option('adsense_made_easy_bottomadtype') =='leaderboard') {
				  $content .= "google_ad_width = 728;\n";
				  $content .= "google_ad_height = 90;\n";
				}  elseif (get_option('adsense_made_easy_bottomadtype') =='largeleaderboard') {
				  $content .= "google_ad_width = 970;\n";
				  $content .= "google_ad_height = 90;\n";
				} else {
				  $content .= "google_ad_width = 468;\n";
				  $content .= "google_ad_height = 60;\n";
				}

				if (get_option('adsense_made_easy_bottomadtextimage') =='text') {
				  $content .= "google_ad_type = \"text\";\n";
				} elseif (get_option('adsense_made_easy_bottomadtextimage') =='image') {
				  $content .= "google_ad_type = \"image\";\n";
				}  else {
				  $content .= "google_ad_type = \"text_image\";\n";
				}

				$content .= "google_color_border = \"";
				$content .= get_option('adsense_made_easy_bordercolor');
				$content .= "\";\n";
				$content .= "google_color_link = \"";
				$content .= get_option('adsense_made_easy_titlecolor');
				$content .= "\";\n";
				$content .= "google_color_text = \"";
				$content .= get_option('adsense_made_easy_textcolor');
				$content .= "\";\n";
				$content .= "google_color_bg = \"";
				$content .= get_option('adsense_made_easy_backgroundcolor');
				$content .= "\";\n";
				$content .= "google_color_url = \"";
				$content .= get_option('adsense_made_easy_urlcolor');
				$content .= "\";\n";
				$content .= "//-->\n";
				$content .= "</script>\n";
				$content .= "<script type=\"text/javascript\"\n";
				$content .= "src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\n";
				$content .= "</script> </center>\n";
			}
			return $content;
		  }
		  return $content;
		}
		function authorUpperCase($author = '') {
			return strtoupper($author);
		}

	}

} //End Class AdsenseMadeEasy


class AdsenseMadeEasyWidget extends WP_Widget
{
  function AdsenseMadeEasyWidget()
  {
    $widget_ops = array('classname' => 'AdsenseMadeEasyWidget', 'description' => 'Adsense Made Easy - Sidebar add' );
    $this->WP_Widget('AdsenseMadeEasyWidget', 'Adsense Made Easy - Sidebar add', $widget_ops);
  }

  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
    $adtype = $instance['adtype'];
    $adtextimage = $instance['adtextimage'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<p>Type of Ad:<BR>
<select name="<?php echo $this->get_field_name('adtype'); ?>" id="<?php echo $this->get_field_id('adtype'); ?>">
<option value="smallsquare" <?php if (attribute_escape($adtype)=='smallsquare') echo ' selected ' ?> >Small Square (200*200)</option>
<option value="square" <?php if (attribute_escape($adtype)=='square') echo ' selected ' ?> >Square (250*250)</option>
<option value="smallrectangle" <?php if (attribute_escape($adtype)=='smallrectangle') echo ' selected ' ?> >Small Rectangle (180*150)</option>
<option value="mediumrectangle" <?php if (attribute_escape($adtype)=='mediumrectangle') echo ' selected ' ?> >Medium Rectangle (300*250)</option>
<option value="bigrectangle" <?php if (attribute_escape($adtype)=='bigrectangle') echo ' selected ' ?> >Big Rectangle (336*280)</option>
<option value="skyscraper" <?php if (attribute_escape($adtype)=='skyscraper') echo ' selected ' ?> >Skyscraper (120*600)</option>
<option value="wideskyscraper" <?php if (attribute_escape($adtype)=='wideskyscraper') echo ' selected ' ?> >Wide Skyscraper (160*600)</option>
<option value="bigskyscraper" <?php if (attribute_escape($adtype)=='bigskyscraper') echo ' selected ' ?> >Big Skyscraper (300*600)</option>
<option value="portrait" <?php if (attribute_escape($adtype)=='portrait') echo ' selected ' ?> >Portrait (300*1050)</option>
<option value="verticalbanner" <?php if (attribute_escape($adtype)=='verticalbanner') echo ' selected ' ?> >Portrait (120*240)</option>
</select>
</p>
<p>
Image or Text Ads?:<BR>
<select name="<?php echo $this->get_field_name('adtextimage'); ?>" id="<?php echo $this->get_field_id('adtextimage'); ?>">
<option value="text" <?php if (attribute_escape($adtextimage)=='text') echo ' selected ' ?> >Text</option>
<option value="image" <?php if (attribute_escape($adtextimage)=='image') echo ' selected ' ?> >Image</option>
<option value="both" <?php if (attribute_escape($adtextimage)!='image' && attribute_escape($adtextimage)!='text') echo ' selected ' ?> >Both</option>
</select>


</p>
<?php
  }

  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['adtype'] = $new_instance['adtype'];
    $instance['adtextimage'] = $new_instance['adtextimage'];
    return $instance;
  }

  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);

    echo $before_widget;
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
    $adtype = $instance['adtype'];
    $adtextimage = $instance['adtextimage'];

    if (!empty($title))
      echo $before_title . $title . $after_title;;

    // WIDGET CODE GOES IN HERE
    echo "<center><script type=\"text/javascript\"> <!--\n";
    echo "google_ad_client = \"";
	echo get_option('adsense_made_easy_publisherid');
    echo "\";\n";
    echo "/* GrootVierkantWit */\n";
	if ($adtype =='square') {
	  echo "google_ad_width = 250;\n";
	  echo "google_ad_height = 250;\n";
	} elseif ($adtype =='smallsquare') {
	  echo "google_ad_width = 200;\n";
	  echo "google_ad_height = 200;\n";
	} elseif ($adtype =='smallrectangle') {
	  echo "google_ad_width = 180;\n";
	  echo "google_ad_height = 150;\n";
	} elseif ($adtype =='wideskyscraper') {
	  echo "google_ad_width = 160;\n";
	  echo "google_ad_height = 600;\n";
	} elseif ($adtype =='portrait') {
	  echo "google_ad_width = 300;\n";
	  echo "google_ad_height = 1050;\n";
	} elseif ($adtype =='verticalbanner') {
	  echo "google_ad_width = 120;\n";
	  echo "google_ad_height = 240;\n";
	} elseif ($adtype =='mediumrectangle') {
	  echo "google_ad_width = 300;\n";
	  echo "google_ad_height = 250;\n";
	} elseif ($adtype =='bigrectangle') {
	  echo "google_ad_width = 336;\n";
	  echo "google_ad_height = 280;\n";
	} elseif ($adtype =='skyscraper') {
	  echo "google_ad_width = 120;\n";
	  echo "google_ad_height = 600;\n";
	} elseif ($adtype =='bigskyscraper') {
	  echo "google_ad_width = 300;\n";
	  echo "google_ad_height = 600;\n";
	} else {
	  echo "google_ad_width = 250;\n";
	  echo "google_ad_height = 250;\n";
	}
	if ($adtextimage =='text') {
	  echo "google_ad_type = \"text\";\n";
	} elseif ($adtextimage =='image') {
	  echo "google_ad_type = \"image\";\n";
	} else {
	  echo "google_ad_type = \"text_image\";\n";
	}
    echo "google_color_border = \"";
    echo get_option('adsense_made_easy_bordercolor');
    echo "\";\n";
    echo "google_color_link = \"";
    echo get_option('adsense_made_easy_titlecolor');
    echo "\";\n";
    echo "google_color_text = \"";
    echo get_option('adsense_made_easy_textcolor');
    echo "\";\n";
    echo "google_color_bg = \"";
    echo get_option('adsense_made_easy_backgroundcolor');
    echo "\";\n";
    echo "google_color_url = \"";
    echo get_option('adsense_made_easy_urlcolor');
    echo "\";\n";
    echo "//-->\n";
    echo "</script>\n";
    echo "<script type=\"text/javascript\"\n";
    echo "src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\n";
    echo "</script></center> \n";

    echo $after_widget;
  }

}
add_action( 'widgets_init', create_function('', 'return register_widget("AdsenseMadeEasyWidget");') );





if (class_exists("AdsenseMadeEasy")) {
	$dl_pluginSeries = new AdsenseMadeEasy();
}
//Actions and Filters
if (isset($dl_pluginSeries)) {
	//Actions
	//Filters
	add_filter('the_content', array(&$dl_pluginSeries, 'addContent'));
}

/* Runs when plugin is activated */
register_activation_hook(__FILE__,'adsense_made_easy_install');

/* Runs on plugin deactivation*/
register_deactivation_hook( __FILE__, 'adsense_made_easy_remove' );

function adsense_made_easy_install() {
/* Creates new database field */
add_option("adsense_made_easy_publisherid", '', '', 'yes');
add_option("adsense_made_easy_bordercolor", 'FFFFFF', '', 'yes');
add_option("adsense_made_easy_titlecolor", '0000FF', '', 'yes');
add_option("adsense_made_easy_backgroundcolor", 'FFFFFF', '', 'yes');
add_option("adsense_made_easy_textcolor", '000000', '', 'yes');
add_option("adsense_made_easy_urlcolor", '008000', '', 'yes');
add_option("adsense_made_easy_topadtype", 'banner', '', 'yes');
add_option("adsense_made_easy_topadtextimage", 'both', '', 'yes');
add_option("adsense_made_easy_bottomadtype", 'banner', '', 'yes');
add_option("adsense_made_easy_bottomadtextimage", 'both', '', 'yes');
add_option("adsense_made_easy_displayposts", 'yes', '', 'yes');
add_option("adsense_made_easy_displaypages", 'yes', '', 'yes');
add_option("adsense_made_easy_topadalignment", 'centered', '', 'yes');
}

function adsense_made_easy_remove() {
/* Deletes the database field */

}


if ( is_admin() ){

/* Call the html code */
add_action('admin_menu', 'adsense_made_easy_admin_menu');

function adsense_made_easy_admin_menu() {
add_options_page('Adsense Made Easy', 'Adsense Made Easy', 'administrator',
'adsense-made-easy-best-simple-ad-inserter', 'adsense_made_easy_page');
}
}

?>
<?php
function adsense_made_easy_page() {
?>
<div>
<h2>Adsense Made Easy - Settings</h2>

<p>
Why not check out my blog: <a href="http://www.seo101.net">seo101.net</a>
</p>


<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>

<table width="850">
<tr valign="top">
<th width="250" scope="row">Enter your Google Adsense Publisher ID</th>
<td width="600">
<input name="adsense_made_easy_publisherid" type="text" id="adsense_made_easy_publisherid" value="<?php echo get_option('adsense_made_easy_publisherid'); ?>" /> (For example: pub-1234567891234567 )</td>
</tr>
</table><BR><BR>

<table width="850">
<tr valign="top">
<th width="250" scope="row">Top ad type </th>
<td width="600">
<select name="adsense_made_easy_topadtype" id="adsense_made_easy_topadtype">
<option value="smallsquare" <?php if (get_option('adsense_made_easy_topadtype')=='smallsquare') echo ' selected ' ?> >Small Square (200*200)</option>
<option value="square" <?php if (get_option('adsense_made_easy_topadtype')=='square') echo ' selected ' ?> >Square (250*250)</option>
<option value="smallrectangle" <?php if (get_option('adsense_made_easy_topadtype')=='smallrectangle') echo ' selected ' ?> >Small Rectangle (180*150)</option>
<option value="mediumrectangle" <?php if (get_option('adsense_made_easy_topadtype')=='mediumrectangle') echo ' selected ' ?> >Medium Rectangle (300*250)</option>
<option value="rectangle" <?php if (get_option('adsense_made_easy_topadtype')=='rectangle') echo ' selected ' ?> >Large Rectangle (336*280)</option>
<option value="halfbanner" <?php if (get_option('adsense_made_easy_topadtype')=='halfbanner') echo ' selected ' ?> >Half Banner (234*60)</option>
<option value="banner" <?php if (get_option('adsense_made_easy_topadtype')=='banner') echo ' selected ' ?> >Banner (468*60)</option>
<option value="leaderboard" <?php if (get_option('adsense_made_easy_topadtype')=='leaderboard') echo ' selected ' ?> >Leaderboard (728*90)</option>
<option value="largeleaderboard" <?php if (get_option('adsense_made_easy_topadtype')=='largeleaderboard') echo ' selected ' ?> >Large Leaderboard (970*90)</option>
<option value="none" <?php if (get_option('adsense_made_easy_topadtype')=='none') echo ' selected ' ?> >None (No add will be shown)</option>
</select> The type of ad you want on top of your posts/pages?
</td>
</tr>
</table>

<table width="850">
<tr valign="top">
<th width="250" scope="row">Top ad alignment </th>
<td width="600">
<select name="adsense_made_easy_topadalignment" id="adsense_made_easy_topadalignment">
<option value="left" <?php if (get_option('adsense_made_easy_topadalignment')=='left') echo ' selected ' ?> >Left</option>
<option value="right" <?php if (get_option('adsense_made_easy_topadalignment')=='right') echo ' selected ' ?> >Right</option>
<option value="centered" <?php if (get_option('adsense_made_easy_topadalignment')=='centered') echo ' selected ' ?> >Centered</option>
</select> Do you want the top ad to be a aligned left, right or centered?
</td>
</tr>
</table>

<table width="850">
<tr valign="top">
<th width="250" scope="row">Top ad Image or Text </th>
<td width="600">
<select name="adsense_made_easy_topadtextimage" id="adsense_made_easy_topadtextimage">
<option value="text" <?php if (get_option('adsense_made_easy_topadtextimage')=='text') echo ' selected ' ?> >Text</option>
<option value="image" <?php if (get_option('adsense_made_easy_topadtextimage')=='image') echo ' selected ' ?> >Image</option>
<option value="both" <?php if (get_option('adsense_made_easy_topadtextimage')!='text' && get_option('adsense_made_easy_topadtextimage')!='image') echo ' selected ' ?> >Both</option>
</select>
</td>
</tr>
</table><BR><BR>

<table width="850">
<tr valign="top">
<th width="250" scope="row">Bottom ad type </th>
<td width="600">
<select name="adsense_made_easy_bottomadtype" id="adsense_made_easy_bottomadtype">
<option value="smallsquare" <?php if (get_option('adsense_made_easy_bottomadtype')=='smallsquare') echo ' selected ' ?> >Small Square (200*200)</option>
<option value="square" <?php if (get_option('adsense_made_easy_bottomadtype')=='square') echo ' selected ' ?> >Square (250*250)</option>
<option value="smallrectangle" <?php if (get_option('adsense_made_easy_bottomadtype')=='smallrectangle') echo ' selected ' ?> >Small Rectangle (180*150)</option>
<option value="mediumrectangle" <?php if (get_option('adsense_made_easy_bottomadtype')=='mediumrectangle') echo ' selected ' ?> >Medium Rectangle (300*250)</option>
<option value="rectangle" <?php if (get_option('adsense_made_easy_bottomadtype')=='rectangle') echo ' selected ' ?> >Large Rectangle (336*280)</option>
<option value="halfbanner" <?php if (get_option('adsense_made_easy_bottomadtype')=='halfbanner') echo ' selected ' ?> >Half Banner (234*60)</option>
<option value="banner" <?php if (get_option('adsense_made_easy_bottomadtype')=='banner') echo ' selected ' ?> >Banner (468*60)</option>
<option value="leaderboard" <?php if (get_option('adsense_made_easy_bottomadtype')=='leaderboard') echo ' selected ' ?> >Leaderboard (728*90)</option>
<option value="largeleaderboard" <?php if (get_option('adsense_made_easy_bottomadtype')=='largeleaderboard') echo ' selected ' ?> >Large Leaderboard (970*90)</option>
<option value="none" <?php if (get_option('adsense_made_easy_bottomadtype')=='none') echo ' selected ' ?> >None (No add will be shown)</option>
</select> The type of ad you want on the bottom of your posts/pages?
</td>
</tr>
</table>

<table width="850">
<tr valign="top">
<th width="250" scope="row">Bottom ad Image or Text </th>
<td width="600">
<select name="adsense_made_easy_bottomadtextimage" id="adsense_made_easy_bottomadtextimage">
<option value="text" <?php if (get_option('adsense_made_easy_bottomadtextimage')=='text') echo ' selected ' ?> >Text</option>
<option value="image" <?php if (get_option('adsense_made_easy_bottomadtextimage')=='image') echo ' selected ' ?> >Image</option>
<option value="both" <?php if (get_option('adsense_made_easy_bottomadtextimage')!='text' && get_option('adsense_made_easy_bottomadtextimage')!='image') echo ' selected ' ?> >Both</option>
</select>
</td>
</tr>
</table><BR><BR>


<table width="850">
<tr valign="top">
<th width="250" scope="row">Display ads on posts? </th>
<td width="600">
<select name="adsense_made_easy_displayposts" id="adsense_made_easy_displayposts">
<option value="yes" <?php if (get_option('adsense_made_easy_displayposts')=='yes') echo ' selected ' ?> >yes</option>
<option value="no" <?php if (get_option('adsense_made_easy_displayposts')=='no') echo ' selected ' ?> >no</option>
</select>
</td>
</tr>
</table>
<table width="850">
<tr valign="top">
<th width="250" scope="row">Display ads on pages? </th>
<td width="600">
<select name="adsense_made_easy_displaypages" id="adsense_made_easy_displaypages">
<option value="yes" <?php if (get_option('adsense_made_easy_displaypages')=='yes') echo ' selected ' ?> >yes</option>
<option value="no" <?php if (get_option('adsense_made_easy_displaypages')=='no') echo ' selected ' ?> >no</option>
</select>
</td>
</tr>
</table>
<script type="text/javascript" src="<?php bloginfo( 'wpurl' ); ?>
/wp-content/plugins/adsense-made-easy-best-simple-ad-inserter/jscolor.js"></script>
<BR><BR>
<table width="850">
<tr valign="top">
<th width="250" scope="row">Bordercolor of the ads</th>
<td width="600">
<input class="color" name="adsense_made_easy_bordercolor" type="text" id="adsense_made_easy_bordercolor" value="<?php echo get_option('adsense_made_easy_bordercolor'); ?>" /></td>
</tr>
</table>
<table width="850">
<tr valign="top">
<th width="250" scope="row">Titlecolor (Link) of the ads</th>
<td width="600">
<input class="color" name="adsense_made_easy_titlecolor" type="text" id="adsense_made_easy_titlecolor" value="<?php echo get_option('adsense_made_easy_titlecolor'); ?>" /></td>
</tr>
</table>
<table width="850">
<tr valign="top">
<th width="250" scope="row">Backgroundcolor of the ads</th>
<td width="600">
<input class="color" name="adsense_made_easy_backgroundcolor" type="text" id="adsense_made_easy_backgroundcolor" value="<?php echo get_option('adsense_made_easy_backgroundcolor'); ?>" /></td>
</tr>
</table>
<table width="850">
<tr valign="top">
<th width="250" scope="row">Textcolor of the ads</th>
<td width="600">
<input class="color" name="adsense_made_easy_textcolor" type="text" id="adsense_made_easy_textcolor" value="<?php echo get_option('adsense_made_easy_textcolor'); ?>" /></td>
</tr>
</table>
<table width="850">
<tr valign="top">
<th width="250" scope="row">URLcolor of the ads </th>
<td width="600">
<input class="color" name="adsense_made_easy_urlcolor" type="text" id="adsense_made_easy_urlcolor" value="<?php echo get_option('adsense_made_easy_urlcolor'); ?>" /></td>
</tr>
</table>


<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="adsense_made_easy_publisherid, adsense_made_easy_bordercolor, adsense_made_easy_titlecolor, adsense_made_easy_backgroundcolor, adsense_made_easy_textcolor, adsense_made_easy_urlcolor, adsense_made_easy_topadtype, adsense_made_easy_bottomadtype, adsense_made_easy_displayposts, adsense_made_easy_displaypages, adsense_made_easy_topadalignment, adsense_made_easy_topadtextimage, adsense_made_easy_bottomadtextimage" />

<p>
<input type="submit" value="<?php _e('Save Changes') ?>" />
</p>
</form>
</div>
<BR><BR>
<?php
}
?>