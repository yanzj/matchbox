<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage mathbox_mobile
 */

?>
<?php 
	$_single = $_GET['single']; 
?>
<?php if ('true' != $_single ): ?>
	<?php get_header(); ?>
	<div id="mySwipe" class="swiper-container">
		<div id="mySwipe-wrap" class="swipe-wrap swipe-wraper">
			<div class="doc_content swiper-slide">
				<div id="primary" class="content-area">
					<div id="content" class="site-content" role="main">
						<?php if ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', get_post_format() ); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	jQuery(function() {
		jQuery('.favorites_link_group').hide();
		_init_player(<?php echo $post->ID; ?>);
		jQuery('#ad_image_<?php echo $post->ID; ?>').toggle(
		     function () {
		        jQuery('#mb_ad_link_<?php echo $post->ID; ?>').show();
		     },
		     function () {
		        jQuery('#mb_ad_link_<?php echo $post->ID; ?>').hide();
		     }
		 ).bind('click');
		 
		 jQuery('#mb_ad_link_<?php echo $post->ID; ?>').bind('click', function(event) {
		 	event.stopPropagation();
		 });
	});
</script>
<?php if(isset($_REQUEST['back'])): ?>
	<div style="width:100%;text-align:center;font-size:18px;">
		<a href="<?php echo get_site_url();?>/?matchboxboss=lp"><- 返回</a>
	</div>
<?php endif ?>
	<?php get_footer(); ?>
<?php else: ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<input type="hidden" id="mb_post_id_<?php echo $post->ID; ?>" value="<?php echo $post->ID; ?>" />
			<input type="hidden" id="mb_post_title_<?php echo $post->ID; ?>" value="<?php echo $post->post_title; ?>" />
			<?php if ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>
