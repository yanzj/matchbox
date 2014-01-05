<?php
/**
 * The template for displaying posts in the Audio post format.
 *
 * @package WordPress
 * @subpackage mathbox_mobile
 * 
 */
?>
<div style="overflow-x: hidden"></div>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		
		<div class="audio-content">
			<?php the_content(); ?>
		</div>
	</div>
</article>
<div id="xheight_mathbox_content_<?php the_ID(); ?>" style="height:1px; overflow-x: hidden"></div>

