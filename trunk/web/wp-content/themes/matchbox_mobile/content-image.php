<?php
/**
 * The template for displaying posts in the Image post format.
 *
 * @package WordPress
 * @subpackage matchbox_mobile
 * 
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	<footer class="favorites_link_group">
		<hr style="margin: 0;"/>
		<div class="favorites_link_group_wrap">
			<div class="favorites_link_button">
				<a href="javascript:void(0)" onclick="_showfavorite('f')">
					<img width="80px" height="30px" src="<?php echo get_template_directory_uri(); ?>/images/favorites-text.png" />
				</a>
			</div>
		</div>
	</footer>
</article>
