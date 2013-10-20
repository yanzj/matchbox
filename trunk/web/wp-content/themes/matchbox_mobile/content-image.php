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

	<footer class="entry-meta" style="">
		<div style="text-align:center;width:100%;">
			<div style="width:80px; margin-right:auto; margin-left:auto;">
				<a href="javascript:void(0)" onclick="_showfavorite()">
					<div style="height:30px;float:left;"><img width="24px" height="24px" 
					src="<?php echo get_template_directory_uri(); ?>/images/star.png" /></div>
					<div style="height:30px;padding-top:1px;color:black;font-size:16px;font-weight:bold;float:left;">&nbsp;&nbsp;收藏</div>
				</a>
			</div>
		</div>
	</footer>
</article>
