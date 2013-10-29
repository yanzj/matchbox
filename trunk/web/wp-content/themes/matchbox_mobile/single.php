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
<?php 
	$_single = $_GET['single']; 
?>
<?php if ('true' != $_single ): ?>
	<?php get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php /* The loop */ ?>
			<?php if ( have_posts() ) : the_post(); ?>
				<!--
				<p style="margin: 0;">Post Format is: <?php echo get_post_format(); ?></p>
				-->
				<?php get_template_part( 'content', get_post_format() ); ?>
				<?php 
				//comments_template(); 
				?>
			<?php endif; ?>
		</div><!-- #content -->
	</div><!-- #primary -->
<script type="text/javascript">

	var _hidefavorite = function() {
		jQuery('#footer_favorite').hide();
	}
		
	jQuery(function() {
		jQuery("#footer_favorite").pinFooter();
		jQuery(window).resize(function() {
		    jQuery("#footer_favorite").pinFooter();
		});
		jQuery("#footer_favorite").hide();
		
		// 判断是否已经收藏 
		jQuery.get('?wpfpaction=exists&postid=' + '<?php echo $post->ID; ?>' + '&ajax=1', function(data){
		  //alert("Data Loaded: " + data);
		  if ('false' == data) {
		  	jQuery('#link_remove_favorite').hide();
		  	jQuery('#link_add_favorite').show();
		  } else {
		  	jQuery('#link_add_favorite').hide();
		  	jQuery('#link_remove_favorite').show();
		  }
		  jQuery('#favorite_current_post_id').val('<?php echo $post->ID; ?>');
		});
		
		// 分享连接
		var shareUrl = '<?php echo esc_url( home_url( '/' ) ); ?>' + '?p=<?php echo $post->ID; ?>';
		jQuery('#share_weixin').attr('href', 'javascript:alert(shareUrl + "\n微信扫描二维码分享")');
		jQuery('#share_sina').attr('href', 'http://v.t.sina.com.cn/share/share.php?url=' + shareUrl + '&amp;title=<?php echo $post->post_title; ?>');
		jQuery('#share_mail').attr('href', 'mailto:?subject=<?php echo $post->post_title; ?>&body=' + shareUrl);

		// 打开收藏与分享菜单
		jQuery('#btn_favorite').click(function() {
			jQuery('#footer_favorite').show();	
		});
		// 打开反馈菜单
		jQuery('#btn_feedback').click(function() {
				
		});	
		// 收藏文章
		jQuery('#link_add_favorite').click(function() {
			var post_id	= jQuery('#favorite_current_post_id').val();
			jQuery.get('?wpfpaction=add&postid=' + post_id + '&ajax=1', function(data){
			  //alert(data);
			  jQuery('#link_add_favorite').hide();
			  jQuery('#link_remove_favorite').show();
		  	  
			});
		});
		// 取消文章收藏
		jQuery('#link_remove_favorite').click(function() {
			var post_id	= jQuery('#favorite_current_post_id').val();
			jQuery.get('?wpfpaction=remove&postid=' + post_id + '&ajax=1', function(data){
			  //alert(data);
			  jQuery('#link_remove_favorite').hide();
		  	  jQuery('#link_add_favorite').show();
			});
		});
		// 打开收藏列表
		jQuery('#link_list_favorite').click(function() {
			jQuery('#favorite_content').load("?wpfpaction=list&ajax=1'", function(){
			  _hidefavorite();
			  jQuery('#favorite_list').css({'display':'block'});
			});
		});
		// 关闭收藏列表
		jQuery('#btn_cancel_list_favorite').click(function() {
			  jQuery('#favorite_list').css({'display':'none'});
		});
	});

</script>
	<?php get_footer(); ?>
<?php else: ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php /* The loop */ ?>
			<?php if ( have_posts() ) : the_post(); ?>
				<!--
				<p style="margin: 0;">Post Format is: <?php echo get_post_format(); ?></p>
				-->
				<?php get_template_part( 'content', get_post_format() ); ?>
				<?php 
				//comments_template(); 
				?>
			<?php endif; ?>
		</div><!-- #content -->
	</div><!-- #primary -->
	
	
<?php endif; ?>
