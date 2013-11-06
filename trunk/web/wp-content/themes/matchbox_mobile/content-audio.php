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
			<!--
			<div class="matchbox_play_button_wrap">
			<a href="javascript:void(0)"><img id="matchbox_play_button" width="32px" height="32px" src="<?php echo get_template_directory_uri(); ?>/images/play.png" 
				onclick="toggleSound('audio-<?php the_ID(); ?>-1')"/></a>
			</div>
			-->
			<!--
			<div class="matchbox_favorite_button_wrap">
				<a href="javascript:void(0)">
					<img id="matchbox_play_button" width="32px" height="32px" 
					src="<?php echo get_template_directory_uri(); ?>/images/star.png" onclick="_show_favorite()"/>
				</a>
			</div>
			-->
		</div>
	</div>
	
</article>
