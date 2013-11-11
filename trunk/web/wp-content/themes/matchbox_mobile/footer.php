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
		<!--
		<footer id="colophon" class="site-footer" role="contentinfo">
			
		</footer>
		-->
	<!-- </div>#page -->
	
	<!-- 查看收藏列表 -->
	<div id="favorite_list" class="pop_page" style="overflow-y:scroll">
		<div id="favorite_content">
			<ul id="favorite_content_ul">
			
			<ul>
		</div>
		<div id="favorite_footer">
			<!--
			<button id="btn_cancel_list_favorite" class="cancel_botton">&nbsp;&nbsp;取&nbsp;&nbsp;消&nbsp;&nbsp;</button>
			-->
			<img id="btn_cancel_list_favorite" class="btn_cancel_list_favorite" src="<?php echo get_template_directory_uri(); ?>/images/cancel.png"/>
		</div>
	</div>
	<!-- 查看收藏正文 -->
	<div id="mb_favorite_page" class="pop_page" style="overflow-y:scroll">
		<div id="mb_favorite_page_content">
			
		</div>
	</div>
	<!-- 分享与收藏 -->
	<div id="footer_favorite_frame" class="pop_page" style="display:none;">
	<div id="footer_favorite">
		<div id="footer_favorite_favorite_wrap">
			<input type="hidden" id="favorite_current_post_id" value=""/>
			<div class="mb_favorite_title">
				<a id="link_add_favorite" href="#" class="mb_menu_link" style="display:none">&nbsp;收&nbsp;藏&nbsp;本&nbsp;文&nbsp;</a>
				<a id="link_remove_favorite" href="#" class="mb_menu_link" style="display:none">&nbsp;取&nbsp;消&nbsp;收&nbsp;藏&nbsp;</a>
			</div>
			
			<div class="mb_favorite_title"><a id="link_list_favorite" class="mb_menu_link" href="#" >&nbsp;查&nbsp;看&nbsp;收&nbsp;藏&nbsp;</a></div>
		</div>
		<div id="footer_favorite_share_wrap" style="display:none;">
			<?php /*
			<div class="mb_favorite_title_s"><a id="title_share" >&nbsp;分&nbsp;享&nbsp;给&nbsp;朋&nbsp;友&nbsp;</a></div>
			<div class="mb_favorite_sharp_group">
				<div class="share_icon_wrap">
					<div class="share_icon_img">
						<a id="share_weixin" href="" title="分享到微信" class="share_icon">
							<img src="<?php echo get_template_directory_uri(); ?>/images/weixin32.png"/></a></div>
					<div class="share_icon_text">微信</div>
				</div>
				<div class="share_icon_wrap">
					<div class="share_icon_img">
						<a id="share_sina" href="" title="分享到新浪微博" class="share_icon" target="_blank">
							<img src="<?php echo get_template_directory_uri(); ?>/images/weibo32.png"/></a></div>
					<div class="share_icon_text">新浪微博</div>
				</div>
			</div>
			*/?>
		</div>
		<div class="mb_favorite_share_bottom">
			<img id="btn_cancel_favorite" class="btn_cancel_favorite" src="<?php echo get_template_directory_uri(); ?>/images/cancel.png" 
				onclick="javascript:_hide_favorite();"/>
		</div>
	</div>
	</div>
	<!-- 关于与评价 -->
	<div id="footer_freeback" class="mb_info_page pop_page" style="display:none;">
		<div class="matchbox_freeback_title">
			<a id="btn_open_about" class="mb_menu_link">关于火柴盒</a>
		</div>
		<?php /*
		<div class="matchbox_freeback_title"> 
			<a id="btn_open_contribute" class="mb_menu_link">投稿给我们</a>
		</div>
		*/?>
		<?php /*
		<div class="matchbox_freeback_title">
			<a class="mb_menu_link">去APP STORE评价我们</a>
		</div>
		*/?>
		<div class="matchbox_freeback_title">
			<a onclick="_show_comment()" class="mb_menu_link">意见反馈</a>
		</div>
		<?php /*
		<div class="matchbox_freeback_title">
			<a  id="btn_open_business" class="mb_menu_link">商业合作</a>
		</div>
		*/?>
		<div class="matchbox_comment_buttongroup">
			<!--
			<button id="btn_cancel_freeback" class="cancel_botton">&nbsp;&nbsp;取&nbsp;&nbsp;消&nbsp;&nbsp;</button>
			-->
			
			<img id="btn_cancel_freeback" class="btn_cancel_freeback" src="<?php echo get_template_directory_uri(); ?>/images/cancel.png" />
		</div>
	</div>
	<!-- 信息页面 -->
	<div id="mb_info_page" class="mb_info_page pop_page" style="display:none;">
		<!-- 关于火柴盒 -->
		<div id="mb_info_page_about" class="mb_info_page_sub" style="display:none">
			<p class="title_area">关于火柴盒</p>
			<span class="text_area">　　是什么使眼睛发潮？为什么会想起你？窗外黑黝黝的屋脊，像几条卧鲸。深深浅浅的灯光，似乎要从万千人生故事中，泄露一点什么消息。好比一本书的封面，引诱你去翻阅。不料记忆所及的那一页，竟是老朋友你。<br/>

　　			学生时代你的外号叫蚂蚱。你长得尤其高又非常瘦，不是林黛玉类型的纤细较弱，而是真正的皮包骨头。你有必定要叫女孩子们伤心不已的凸额头，又粗又硬的头发编成结结实实两条辫子，撅在耳后。
			</span>
		</div>
		<!-- 投稿给我们 -->
		<div id="mb_info_page_contribute" class="mb_info_page_sub" style="display:none">
			<p class="title_area">投稿给我们</p>
			<span class="text_area">
					投稿给我们
					... ...
			</span>
		</div>
		<!-- 商业合作 -->
		<div id="mb_info_page_business" class="mb_info_page_sub" style="display:none">
			<p class="title_area">商业合作</p>
			<span class="text_area">
					商业合作
					......
			</span>
		</div>
	</div>
	<!-- 评价页面 -->
	<div id="footer_comment" class="pop_page" style="display:none;">
			<div class="matchbox_comment_title">
				<div class="backicon">
					<img src="<?php echo get_template_directory_uri(); ?>/images/back.png" onclick="_hide_comment()"/>
				</div>
				<div style="margin-left:40px; margin-right:40px; text-align: center;">
					用户反馈
				</div>
			</div>
			<div class="matchbox_comment_body">
				<form method="post" id="matchbox_commentform" onsubmit="javascript:return false;" novalidate>
				<div style="display:none">
					<div class="matchbox_comment_label"><label for="email">EMAIL:</label></div>
					<div><input id="email" name="email" type="email" value="" size="30" style="width:100%" aria-required='true' /></div>
					<div class="matchbox_comment_label"><label for="url">手机:</label></div>
					<div><input id="url" name="url" type="url" value="" size="30" style="width:100%"/></div>
				</div>
				<div class="matchbox_comment_label"><label for="comment">反馈内容</label></div>
				<div><textarea id="comment" name="comment" rows="15" style="width:100%;height:200px;"></textarea></div>
				<div id="matchbox_comment_loading" class="matchbox_comment_loading">
					<div id='matchbox_comment_loading_circle' style='margin-right: 30px;'>
						<div id='matchbox_comment_loading_circle_1' class='matchbox_comment_loading_circle'></div>
						<div id='matchbox_comment_loading_circle_2' class='matchbox_comment_loading_circle'></div>
						<div id='matchbox_comment_loading_circle_3' class='matchbox_comment_loading_circle'></div>
					</div>
					<div style='clear: both; float: none;'></div>
				</div>
				<div class="matchbox_comment_bottom">
					<span id="matchbox_comment_status"></span>
					<img id="matchbox_submit_comment" class="btn_commit" src="<?php echo get_template_directory_uri(); ?>/images/submit.png" />
					<input type='hidden' name='comment_post_ID' value='1' id='comment_post_ID' />
					<input id="author" name="author" type="hidden" value="访客" />
					<input type='hidden' name='comment_parent' id='comment_parent' value='0' />
				</div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>