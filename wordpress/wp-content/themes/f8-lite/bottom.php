<!-- Widgets -->
<div id="inside-widgets" class="clearfix">
	<div class="span-7 append-1">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Left') ) : ?>
		<?php endif; ?>
	</div>
	<div class="column span-7 append-1">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Middle') ) : ?>
		<?php endif; ?>
	</div>
	<div class="column span-8 last">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Right') ) : ?>
		<?php endif; ?>
	</div>
</div>