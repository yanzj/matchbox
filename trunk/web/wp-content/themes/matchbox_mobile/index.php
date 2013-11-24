<?php 
	$SITE_URL = get_site_url();
	$TEMPLATE_URL = get_template_directory_uri();
?>
<!DOCTYPE html>
<html>
<head>
	<title>火柴盒</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta content="width=device-width,initial-scale=1.0,user-scalable=no,minimum-scale=1.0,maximum-scale=1.0" name="viewport">
	<meta content="yes" name="apple-mobile-web-app-capable">
	<meta content="black-translucent" name="apple-mobile-web-app-status-bar-style">
	<meta name="format-detection" content="telephone=no">
	<link rel='stylesheet' id='twentythirteen-style-css'  href='<?php echo $TEMPLATE_URL; ?>/style.css' type='text/css' media='all' />
	<script type='text/javascript' src='<?php echo $SITE_URL; ?>/wp-includes/js/jquery/jquery.js'></script>
	<script type='text/javascript' src='<?php echo $SITE_URL; ?>/wp-includes/js/jquery/jquery-migrate.min.js'></script>
</head>
<body screen_capture_injected="true" <?php body_class(); ?> style="margin-top:34px;">
<div id="masthead" class="mb_header">
	<div id="mb_header_left" class="mb_header_left">
		<img id="btn_feedback" src="<?php echo $TEMPLATE_URL; ?>/images/fun_left.png"/></div>	
	<div id="mb_header_right" class="mb_header_right">
		<img id="btn_favorite" src="<?php echo $TEMPLATE_URL; ?>/images/fun_right.png"/></div>
	<div id="mb_header_back" class="mb_header_right" style="display:none;">
		<img id="btn_header_back" src="<?php echo $TEMPLATE_URL; ?>/images/fun_right_back.png"/></div>
	<div id="mb_header_favorite_back" class="mb_header_left" style="display:none;">
		<img id="btn_header_favorite_back" src="<?php echo $TEMPLATE_URL; ?>/images/fun_right_back2.png"/></div>
	<div class="mb_header_center">
		<a><img class="mb_header_title" src="<?php echo $TEMPLATE_URL; ?>/images/title.png"/></a>
	</div>
</div>
<div class="md_ad" style="display:none;">
	<a href="#" target="_blank">
		<img src="<?php echo $SITE_URL; ?>wp-content/ad/main.jpg" 
			style="width:100%;height:100%;"/></a>
	<a class="ad_close">关闭</a>
</div>

<div id="main" class="mb_content" data-role="content" data-theme="m">
		
<?php 
	$_pushscripts = '';  // 保持代码块
	$_postcount = 0;     // 保存Post数量
	$_lasttime = NULL;
	$_postdates = array();
?>
		<div class="preloader">
			<div class='loading'>
			    <span></span>
			    <span></span>
			    <span></span>
			    <span></span>
			</div>
			<div>Loading...</div>
		</div>
		<div id="mySwipe" class="swiper-container">
			<div id="mySwipe-wrap" class="swipe-wrap swipe-wraper">
	  			<?php 
	  			while ( have_posts() ) : 
	  				the_post(); 
					$_pushscripts .= "my_array.push('" . $post->ID . "');"; 
					$_pushscripts .= "my_array_title.push('" . $post->post_title . "');"; 
					if ($_postcount == 0):
						$_lasttime = $post->post_date;
					endif;
					$_strdate = date('Ymd', $post->post_date);
					$_postdates[$_strdate] = $_strdate;
					$_postscount++;
					if (count($_postdates) >= 10):
						break;
					endif;
				?>
				<div id="mathbox_content_<?php echo $post->ID;?>" class="doc_content swiper-slide">
					<?php 
						if ($_postscount <= 1): 
							$_pushscripts .= "hashMap.Set('?p=" . $post->ID . "', '');";
						
					?>
					
					<div id="primary" class="content-area">
						<div id="content" class="site-content" role="main">
							<input type="hidden" id="mb_post_id_<?php echo $post->ID; ?>" value="<?php echo $post->ID; ?>" />
							<input type="hidden" id="mb_post_title_<?php echo $post->ID; ?>" value="<?php echo $post->post_title; ?>" />
							<?php get_template_part( 'content', get_post_format() ); ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
				<?php endwhile; ?>
			</div>
		</div>
			
</div><!-- #main -->	
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
		<img id="btn_cancel_list_favorite" class="btn_cancel_list_favorite" src="<?php echo $TEMPLATE_URL; ?>/images/cancel.png"/>
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
						<img src="<?php echo $TEMPLATE_URL; ?>/images/weixin32.png"/></a></div>
				<div class="share_icon_text">微信</div>
			</div>
			<div class="share_icon_wrap">
				<div class="share_icon_img">
					<a id="share_sina" href="" title="分享到新浪微博" class="share_icon" target="_blank">
						<img src="<?php echo $TEMPLATE_URL; ?>/images/weibo32.png"/></a></div>
				<div class="share_icon_text">新浪微博</div>
			</div>
		</div>
		*/?>
	</div>
	<div class="mb_favorite_share_bottom">
		<img id="btn_cancel_favorite" class="btn_cancel_favorite" src="<?php echo $TEMPLATE_URL; ?>/images/cancel.png" 
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
		
		<img id="btn_cancel_freeback" class="btn_cancel_freeback" src="<?php echo $TEMPLATE_URL; ?>/images/cancel.png" />
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
				<img src="<?php echo $TEMPLATE_URL; ?>/images/back.png" onclick="_hide_comment()"/>
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
				<img id="matchbox_submit_comment" class="btn_commit" src="<?php echo $TEMPLATE_URL; ?>/images/submit.png" />
				<input type='hidden' name='comment_post_ID' value='1' id='comment_post_ID' />
				<input id="author" name="author" type="hidden" value="访客" />
				<input type='hidden' name='comment_parent' id='comment_parent' value='0' />
			</div>
			</form>
		</div>
	</div>
</div>
</body>
<?php /* <script type="text/javascript" src="<?php echo $TEMPLATE_URL; ?>/js/math.uuid.js"></script> */?>
<script type="text/javascript" src="<?php echo $TEMPLATE_URL; ?>/js/iscroll.js"></script>
<script type="text/javascript" src="<?php echo $TEMPLATE_URL; ?>/js/idangerous.swiper.js"></script>
<script type="text/javascript">
	var SITE_URL = '<?php echo $SITE_URL; ?>';
</script>
<script type="text/javascript" src="<?php echo $TEMPLATE_URL; ?>/index.js"></script>
<script type="text/javascript">
	favorite.Init();
	var posts_count = <?php echo $_postscount; ?>;
	jQuery(function() {
	 	var elem = document.getElementById('mySwipe');
		if (elem) {
			 holdPosition = 0;
			 var mySwiper = jQuery('#mySwipe').swiper({
			    speed : 500, 
			    wrapperClass : 'swipe-wrap',
				slideClass : 'doc_content',
			//	useCSS3Transforms : false,
			//	calculateHeight: true,
				watchActiveIndex: true,
			    onTouchStart: function() {
			      holdPosition = 0;
			    },
			    onResistanceBefore: function(s, pos){
			      holdPosition = pos;
			    },
			    onTouchEnd: function(){
			      if (holdPosition>80) {
			        mySwiper.setWrapperTranslate(80,0,0);
			        mySwiper.params.onlyExternal = true;
			        jQuery('.preloader').addClass('visible');
			        loadNewSlides();
			      }
			    },
			    onSlideChangeEnd : function () {
			    	_load_post(mySwiper.activeIndex, 10, true);
			    }
			 });
			 
			 function loadNewSlides() {
				jQuery.getJSON( '?matchbox=last&last=' + my_array[0], function() {
					console.log( "call success" );
				}).done(function(data) {
					console.log( "callback success" );
					console.log( data.last + ' ' + data.update + ' ' + data.list.length);
					if ('true' == data.update) {
						for (i=data.list.length-1; i >=0; i--) {
							post = data.list[i];
							my_array.unshift(post.id);
							my_array_title.unshift(post.title);
							var newSlide = mySwiper.createSlide('<div id="mathbox_content_' + post.id + '" class="doc_content swiper-slide"></div>');
							newSlide.prepend(); 
							_load_post(0, 0, true);
						}
					}
					
				}).fail(function() {
					console.log( "loadNewSlides error" );
				}).always(function() {
					mySwiper.setWrapperTranslate(0,0,0);
			      	mySwiper.params.onlyExternal = false;
			      	mySwiper.updateActiveSlide(0);
			      	jQuery('.preloader').removeClass('visible');
				});
			  }

			<?php echo $_pushscripts; ?>
		}

		jQuery('#mySwipe-wrap').height(jQuery(window).height() - 34);
		//_load_post(current_post, 10, true);

	});
</script>
</html>