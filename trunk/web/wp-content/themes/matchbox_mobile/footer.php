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
		<button id="btn_cancel_list_favorite" class="cancel_botton">&nbsp;&nbsp;取&nbsp;&nbsp;消&nbsp;&nbsp;</button>
	</div>
	
	<div id="footer_favorite" style="display:none;">
		<div id="footer_favorite_favorite_wrap">
			<input type="hidden" id="favorite_current_post_id" value=""/>
			<div>
				<a id="link_add_favorite" href="#" class="medium awesome" style="display:none">&nbsp;收&nbsp;藏&nbsp;本&nbsp;文&nbsp;</a>
				<a id="link_remove_favorite" href="#" class="medium awesome" style="display:none">&nbsp;取&nbsp;消&nbsp;收&nbsp;藏&nbsp;</a>
			</div>
			<hr/>
			<div><a id="link_list_favorite" href="#" class="medium awesome">&nbsp;查&nbsp;看&nbsp;收&nbsp;藏&nbsp;</a></div>
		</div>
		<div id="footer_favorite_share_wrap">
			<hr/>
			<div><a id="title_share" class="medium awesome">&nbsp;分&nbsp;享&nbsp;给&nbsp;朋&nbsp;友&nbsp;</a></div>
			<div>
				<a id="share_weixin" href="" title="分享到微信" class="share_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/weixin32.png"/></a> 
				<a id="share_sina" href="" title="分享到新浪微博" class="share_icon" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/weibo32.png"/></a>
				<a id="share_mail" href="#" title="发送邮件给朋友" class="share_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/mail32.png"/></a>
			</div>
		</div>
		<hr/>
		<button class="cancel_button" onclick="javascript:_hidefavorite();">&nbsp;&nbsp;取&nbsp;&nbsp;消&nbsp;&nbsp;</button>
		
	</div>
	
	<div id="footer_freeback" style="display:none;">
		<div class="matchbox_freeback_title">
		<!--
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>?page_id=2" class="medium awesome">关于火柴盒</a>
			-->
			<a onclick="_showabout()">关于火柴盒</a>
		</div>
		<div class="matchbox_freeback_title">
			<a href="#" class="medium awesome">投稿给我们</a>
		</div>
		<div class="matchbox_freeback_title">
			<a href="#" class="medium awesome">去APP STORE评价我们</a>
		</div>
		<div class="matchbox_freeback_title">
			<a onclick="_showcomment()">意见反馈</a>
		</div>
		<div class="matchbox_freeback_title">
			<a href="#" class="medium awesome">商业合作</a>
		</div>
		<div class="matchbox_comment_buttongroup">
			<button id="btn_cancel_freeback" class="cancel_botton">&nbsp;&nbsp;取&nbsp;&nbsp;消&nbsp;&nbsp;</button>
		</div>
	</div>
				
	<div id="footer_about" style="display:none;">
		<div>
			<p class="title_area">关于火柴盒</p>
			<span class="text_area">　　是什么使眼睛发潮？为什么会想起你？窗外黑黝黝的屋脊，像几条卧鲸。深深浅浅的灯光，似乎要从万千人生故事中，泄露一点什么消息。好比一本书的封面，引诱你去翻阅。不料记忆所及的那一页，竟是老朋友你。<br/>

　　			学生时代你的外号叫蚂蚱。你长得尤其高又非常瘦，不是林黛玉类型的纤细较弱，而是真正的皮包骨头。你有必定要叫女孩子们伤心不已的凸额头，又粗又硬的头发编成结结实实两条辫子，撅在耳后。
			</span>
		</div>
	</div>
	
	<div id="footer_comment" style="display:none;">
		
			<div class="matchbox_comment_title">
				<div class="backicon">
					<img src="<?php echo get_template_directory_uri(); ?>/images/back.png" onclick="_hidecomment()"/>
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
				<div class="matchbox_comment_loading">
					<div id='matchbox_comment_loading_circle' style='margin-right: 30px;'>
					<div id='matchbox_comment_loading_circle_1' class='matchbox_comment_loading_circle'></div>
					<div id='matchbox_comment_loading_circle_2' class='matchbox_comment_loading_circle'></div>
					<div id='matchbox_comment_loading_circle_3' class='matchbox_comment_loading_circle'></div>
					<div style='clear: both; float: none;'></div>
				</div>
				</div>
					<span id="matchbox_comment_status"></span>
					<button id="matchbox_submit_comment" style="width:80%;" onclick="_commentsubmit()">提交反馈</button>
					<input type='hidden' name='comment_post_ID' value='2' id='comment_post_ID' />
					<input id="author" name="author" type="hidden" value="访客" />
					<input type='hidden' name='comment_parent' id='comment_parent' value='0' />
				</div>
				</form>
			</div>
		</div>
	
	</div>

</body>
</html>