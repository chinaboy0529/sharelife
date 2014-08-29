<div id="sidebar">


<?php if ( !dynamic_sidebar('primary-widget-area') ) : ?>

	<?php if ( is_singular() ) { ?>
		<div class="widget">
			<h3><?php _e('Recent Posts', 'zborder'); ?></h3>
			<ul>
				<?php
				$myposts = get_posts('numberposts=5&offset=0&category=0');
				foreach($myposts as $post) : setup_postdata($post);
				?>
				<li><span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php } else { ?>
		<div class="widget">
			<h3><?php _e('Random Posts', 'zborder'); ?></h3>
			<ul>
				<?php
				$rand_posts = get_posts('numberposts=5&orderby=rand');
				foreach( $rand_posts as $post ) :
				?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php } ?>

	<div class="widget">
		<h3><?php _e('Archives', 'zborder'); ?></h3>
		<ul>
			<?php wp_get_archives( 'type=monthly' ); ?>
		</ul>
	</div>

	<div class="widget">
		<h3><?php _e('Blogrolls', 'zborder'); ?></h3>
		<ul>
			<?php wp_list_bookmarks('title_li=&categorize=0&orderby=id'); ?>
		</ul>
	</div>

<?php endif; ?>

<div class="box" id="float">
<h3>Related Posts</h3><ul class="s_related"><li><a href="http://jandan.net/2013/12/16/your-makeup.html"><img src="http://tankr.net/s/square/5WOG.jpg">你的化妆品安全吗</a></li><li><a href="http://jandan.net/2014/03/05/blood-death.html"><img src="http://tankr.net/s/square/RNAV.jpg">新的血液检测法，可以测出你是否死期已近</a></li><li><a href="http://jandan.net/2014/06/20/coconut-water.html"><img src="http://tankr.net/s/square/JGIF.jpg">涨姿势：要什么运动饮料，椰子汁足矣</a></li><li><a href="http://jandan.net/2014/06/15/rye-bread.html"><img src="http://tankr.net/s/square/J4A6.jpg">纯燕麦面包表示：白面包和全麦面包当然不行，我才是最健康的</a></li><li><a href="http://jandan.net/2014/06/15/reasons-to-eat-bread.html"><img src="http://tankr.net/s/square/2W7J.jpg">管它全麦还是白面：17个吃面包的理由</a></li></ul>
<ul style="padding:6px;">
</ul>
</div>



<script type="text/javascript">
/*【边栏】--上--250*250*/
var cpro_id = "u1314631";
</script>
<script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>

<br>

<iframe name="alimamaifrm" frameborder="0" marginheight="0" marginwidth="0" border="0" scrolling="no" width="300" height="170" src="http://www.taobao.com/go/app/tbk_app/chongzhi_300_170.php?pid=mm_41374337_3506389_13688423&page=chongzhi_300_170.php&size_w=300&size_h=170&stru_phone=1&stru_game=1&stru_travel=1" ></iframe>
<br><br>

<script type="text/javascript">
     document.write('<a style="display:none!important" id="tanx-a-mm_41374337_3506389_13688422"></a>');
     tanx_s = document.createElement("script");
     tanx_s.type = "text/javascript";
     tanx_s.charset = "gbk";
     tanx_s.id = "tanx-s-mm_41374337_3506389_13688422";
     tanx_s.async = true;
     tanx_s.src = "http://p.tanx.com/ex?i=mm_41374337_3506389_13688422";
     tanx_h = document.getElementsByTagName("head")[0];
     if(tanx_h)tanx_h.insertBefore(tanx_s,tanx_h.firstChild);
</script>


<?php if ( is_singular() ) { if ( is_active_sidebar('singular-widget-area') ) dynamic_sidebar('singular-widget-area'); } ?>
<?php if (!is_singular()) { if ( is_active_sidebar('not-singular-widget-area') ) dynamic_sidebar('not-singular-widget-area'); } ?>
<?php if ( is_active_sidebar('footer-widget-area') ) dynamic_sidebar('footer-widget-area'); ?>

</div><!-- end: #sidebar -->
