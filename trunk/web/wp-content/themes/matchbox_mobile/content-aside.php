<?php
/**
 * The template for displaying posts in the Aside post format.
 *
 * @package WordPress
 * @subpackage mathbox_mobile
 * 
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title-date"><?php the_date('m月j日'); ?> 文</h1>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<h1 class="entry-title-author">BY <?php the_author(); ?></h1>
	</header>
	
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
			<div class="favorites_link_button" style="margin-left:60px;">
				<a href="javascript:void(0)" onclick="_showfavorite('s')">
					<img width="80px" height="30px" src="<?php echo get_template_directory_uri(); ?>/images/share-text.png" />
				</a>
			</div>
		</div>
	</footer>

</article>
