<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage matchbox_mobile
 * 
 */
?>

		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			
		</footer><!-- #colophon -->
	<!-- </div>#page -->
	
	<style type="text/css">
		.awesome, .awesome:visited {
			display: inline-block; 
			padding: 5px 10px 6px; 
			color: #fff; 
			text-decoration: none;
			/*
			-moz-border-radius: 5px; 
			-webkit-border-radius: 5px;
			-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
			-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
			*/
			text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
			position: relative;
			cursor: pointer;
			font-size: 16px;
		}
		
		.awesome:hover { color: #fff; }
		.awesome:active { top: 1px; }
		.awesome, .awesome:visited,	.medium.awesome, .medium.awesome:visited { 
			font-weight: bold; line-height: 1; text-shadow: 0 -1px 1px rgba(0,0,0,0.25); 
		}
		#footer_favorite {
			padding: 20px;
			background: rgba(0,0,0,0.8);
			color: #fff;
			font-size: 12px;
			text-align: center;
			display: none;
		}
		#title_share {
			font-size:14px;
			text-decoration: none;
			cursor: default;
		}
		.share_icon {
			margin: 5px;
		}
		
		#favorite_list {
			position:fixed;
			width:100%;
			height:100%;
			background: rgba(0,0,0,0.8);
			z-index:9999;
			top:0;
			left:0;
			text-align: center;
			display:none;
		}
		#favorite_content {text-align:left;}
		#favorite_content ul li {margin: 20px 5px 5px 0;}
		#favorite_content ul li a {color:#fff;}
	</style>
	
	<div id="favorite_list" style="overflow-y:scroll">
		<div id="favorite_content">
			
		</div>
		<button id="btn_cancel_list_favorite" class="awesome" style="margin-bottom:20px;">&nbsp;&nbsp;取&nbsp;&nbsp;消&nbsp;&nbsp;</button>
	</div>
	
	<div id="footer_favorite">
		<input type="hidden" id="favorite_current_post_id" value=""/>
		<div>
			<a id="link_add_favorite" href="#"  class="medium awesome" style="display:none">&nbsp;收&nbsp;藏&nbsp;本&nbsp;文&nbsp;</a>
			<a id="link_remove_favorite" href="#"  class="medium awesome" style="display:none">&nbsp;取&nbsp;消&nbsp;收&nbsp;藏&nbsp;</a>
		</div>
		<hr/>
		<div><a id="link_list_favorite" href="#"  class="medium awesome">&nbsp;查&nbsp;看&nbsp;收&nbsp;藏&nbsp;</a></div>
		<div id="favorited_posts"></div>
		<hr/>
		<div><a id="title_share" class="medium awesome">&nbsp;分&nbsp;享&nbsp;给&nbsp;朋&nbsp;友&nbsp;</a></div>
		<div>
			<a id="share_weixin" href="" title="分享到微信" class="share_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/weixin32.png"/></a> 
			<a id="share_sina" href="" title="分享到新浪微博" class="share_icon" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/weibo32.png"/></a>
			<a id="share_mail" href="#" title="发送邮件给朋友" class="share_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/mail32.png"/></a></div>
		<hr/>
		<button class="awesome" style="margin-bottom:20px;" onclick="javascript:_hidefavorite();">&nbsp;&nbsp;取&nbsp;&nbsp;消&nbsp;&nbsp;</button>
		
	</div>

</body>
</html>