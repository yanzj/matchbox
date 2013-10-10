<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage mathbox_mobile
 */

?>
<?php 
/* 分两种情况：
 * 1. ajax 加载的页面，输出文本只包含文章部分；
 * 2. 预览页面，输出完整的 Html;
 */ 
 ?> 
<?php $_audit = $_GET['audit']; ?>
<?php if ('true' == $_audit): ?>
	<?php get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<p style="margin: 0;">Post Format is: <?php echo get_post_format(); ?></p>
				<?php get_template_part( 'content', get_post_format() ); ?>
				<?php 
				//comments_template(); 
				?>
			<?php endwhile; ?>
		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_footer(); ?>
<?php else: ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<p style="margin: 0;">Post Format is: <?php echo get_post_format(); ?></p>
				<?php get_template_part( 'content', get_post_format() ); ?>
				<?php 
				//comments_template(); 
				?>
			<?php endwhile; ?>
		</div><!-- #content -->
	</div><!-- #primary -->
	<?php if (function_exists('wpfp_link')) { wpfp_link(); } ?>
	
	<?php wpfp_list_favorite_posts(); ?>
	
<?php endif; ?>
