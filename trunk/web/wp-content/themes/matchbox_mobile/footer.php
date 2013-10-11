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

	<div id="favorite_list" style="overflow-y:scroll">
		<div id="favorite_content">
			
		</div>
		<button id="btn_cancel_list_favorite" class="awesome" style="margin-bottom:20px;">&nbsp;&nbsp;取&nbsp;&nbsp;消&nbsp;&nbsp;</button>
	</div>
	
	<div id="footer_favorite">
		<input type="hidden" id="favorite_current_post_id" value=""/>
		<div>
			<a id="link_add_favorite" href="#" class="medium awesome" style="display:none">&nbsp;收&nbsp;藏&nbsp;本&nbsp;文&nbsp;</a>
			<a id="link_remove_favorite" href="#" class="medium awesome" style="display:none">&nbsp;取&nbsp;消&nbsp;收&nbsp;藏&nbsp;</a>
		</div>
		<hr/>
		<div><a id="link_list_favorite" href="#" class="medium awesome">&nbsp;查&nbsp;看&nbsp;收&nbsp;藏&nbsp;</a></div>
		<hr/>
		<div><a id="title_share" class="medium awesome">&nbsp;分&nbsp;享&nbsp;给&nbsp;朋&nbsp;友&nbsp;</a></div>
		<div>
			<a id="share_weixin" href="" title="分享到微信" class="share_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/weixin32.png"/></a> 
			<a id="share_sina" href="" title="分享到新浪微博" class="share_icon" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/weibo32.png"/></a>
			<a id="share_mail" href="#" title="发送邮件给朋友" class="share_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/mail32.png"/></a>
		</div>
		<hr/>
		<button class="awesome" style="margin-bottom:20px;" onclick="javascript:_hidefavorite();">&nbsp;&nbsp;取&nbsp;&nbsp;消&nbsp;&nbsp;</button>
		
	</div>

</body>
</html>