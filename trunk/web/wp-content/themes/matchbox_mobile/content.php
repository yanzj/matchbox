<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage matchbox_mobile
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
	
	<footer class="entry-meta" style="">
		<div style="text-align:center;width:100%;">
			<div style="width:80px; margin-right:auto; margin-left:auto;">
				<a href="javascript:void(0)" onclick="_showfavorite()">
					<div style="height:30px;float:left;"><img width="24px" height="24px" 
					src="<?php echo get_template_directory_uri(); ?>/images/star.png" /></div>
					<div style="height:30px;padding-top:1px;color:black;font-size:16px;font-weight:bold;float:left;">&nbsp;&nbsp;收藏</div>
				</a>
			</div>
			
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
