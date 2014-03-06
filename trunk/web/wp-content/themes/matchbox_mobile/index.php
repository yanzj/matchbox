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
	<style>
	.hide_pic,.hide_desc {display:none;}
	</style>
	<script type='text/javascript' src='<?php echo $SITE_URL; ?>/wp-includes/js/jquery/jquery.js'></script>
	<script type='text/javascript' src='<?php echo $SITE_URL; ?>/wp-includes/js/jquery/jquery-migrate.min.js'></script>
<?php $agent = strtolower($_SERVER['HTTP_USER_AGENT']); $android = (strpos($agent, 'android')) ? true : false;if (!$android) : ?>
	<script type='text/javascript' src='<?php echo $SITE_URL; ?>/wp-includes/js/phonegap/cordova.js'></script>
<?php else: ?>
	<script type='text/javascript' src='<?php echo $SITE_URL; ?>/wp-includes/js/android/cordova-2.5.0.js'></script>
	<script type='text/javascript' src='<?php echo $SITE_URL; ?>/wp-includes/js/android/weixin.js'></script>		
<?php endif; ?>

</head>
<body screen_capture_injected="true" <?php body_class(); ?> style="margin-top:32px;margin-bottom:2px;">
<div id="masthead" class="mb_header">
	<div id="mb_header_left" class="mb_header_left" style="width:64px;background:url('<?php echo $TEMPLATE_URL;?>/images/fun_left.png') no-repeat;background-size: 25px auto;height:32px;background-position:7px 16px;"></div>
	<div id="mb_header_right" class="mb_header_right" style="width:64px;background:url('<?php echo $TEMPLATE_URL;?>/images/fun_right.png') no-repeat;background-size: 25px auto;background-position: 30px 5px;"></div>
	<div id="mb_header_back" class="mb_header_right" style="display:none;width:64px;background:url('<?php echo $TEMPLATE_URL;?>/images/fun_right_back.png') no-repeat;background-size: 18px auto;background-position: 40px 15px;"></div>
	<div id="mb_header_favorite_back" class="mb_header_left" style="display:none;width:64px;background:url('<?php echo $TEMPLATE_URL;?>/images/fun_right_back2.png') no-repeat;background-size: 18px auto;height:32px;background-position:7px 15px;"></div>
	<div class="mb_header_center" onclick="_close_pop_all()">
		<a><img class="mb_header_title" src="<?php echo $TEMPLATE_URL; ?>/images/title.png"/></a>
	</div>
</div>
<div style="width:100%" align="center">
<div id="board"></div>	
</div>
<?php if ( function_exists('matchbox_ad_insert') ) : ?>
<?php matchbox_ad_insert(); ?>
<?php endif; ?>
	
<div id="main" class="mb_content" data-role="content" data-theme="m">
		
<?php 
	$_pushscripts = '';  // 保持代码块
	$_postcount = 0;     // 保存Post数量
	$_lasttime = NULL;
	$_postdates = array();
?>
		<div class="preloader">
			<div style="margin-top:160px"><p style="line-height:18px;margin:0">Shine</p><p style="line-height:18px;margin:0">A</p><p style="line-height:18px;margin:0">Light</p></div>
		</div>
		<div id="mySwipe" class="swiper-container">
			<div id="mySwipe-wrap" class="swipe-wrap swipe-wraper">
	  			<?php 
				if(isset($_REQUEST['share'])):
					query_posts('p=' . $_REQUEST['share']);
				else:
					query_posts('posts_per_page=-1');
				endif;
			
	  			while ( have_posts() ) : 
	  				the_post(); 
					$_pushscripts .= "my_array.push('" . $post->ID . "');"; 
					$_pushscripts .= "my_array_title.push('" . $post->post_title . "');"; 
					if ($_postcount == 0):
						$_lasttime = $post->post_date;
					endif;
					$_strdate = substr($post->post_date, 0, 10);
					$_postdates[$_strdate] = $_strdate;
					$_postscount++;
					if (count($_postdates) > 10):
						break;
					endif;
				?>
				<div style="display:none"><?php echo $_strdate ?> <?php echo count($_postdates) ?></div>
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
		<img id="btn_cancel_list_favorite" class="btn_cancel_list_favorite" src="<?php echo $TEMPLATE_URL; ?>/images/cancel.png"/>
	</div>
</div>
<!-- 查看收藏正文 -->
<div id="mb_favorite_page" class="pop_page" style="overflow-y:scroll">
	<div id="mb_favorite_page_content">
		
	</div>
</div>
<!-- 分享与收藏 -->
<div id="footer_favorite_frame_mark" style="position:fixed;left:0;top:0;width:100%;height:640px;display:none;z-index:99999;"></div>
<div id="footer_favorite_frame" class="pop_page" style="display:none;overflow-y:scroll">
<div id="footer_favorite" style="overflow-y:scroll">
	<div id="footer_favorite_favorite_wrap">
		<input type="hidden" id="favorite_current_post_id" value=""/>
		<div class="mb_favorite_title">
			<a id="link_add_favorite" href="#" class="mb_menu_link" style="display:none">收藏本文</a>
			<a id="link_remove_favorite" href="#" class="mb_menu_link" style="display:none">取消收藏</a>
		</div>
		
		<div class="mb_favorite_title"><a id="link_list_favorite" class="mb_menu_link" href="#" >查看收藏</a></div>
	</div>
	<div id="footer_favorite_share_wrap">
		<div class="mb_favorite_title_s"><a id="title_share" ><span style="font-size:16px;">分享给朋友</span></a></div>
	    <div style="width:100%;margin-top: 5px;" align="center">
	    <div class="mb_favorite_sharp_group" style="width:90%">
			<?php /*	*/ ?>
			<div class="share_icon_wrap">
				<div class="share_icon_img">
					<a id="share_weixin" href="" title="分享到微信" class="share_icon">
						<img src="<?php echo $TEMPLATE_URL; ?>/images/weixin32.png" class="share_img" /></a></div>
				<div class="share_icon_text">微信好友</div>
			</div>
			<div class="share_icon_wrap">
				<div class="share_icon_img">
					<a id="share_friends" href="" title="分享到朋友圈" class="share_icon">
						<img src="<?php echo $TEMPLATE_URL; ?>/images/friends32.png" class="share_img"/></a></div>
				<div class="share_icon_text">微信朋友圈</div>
			</div>
			<div class="share_icon_wrap">
				<div class="share_icon_img">
					<a id="share_sina" href="" title="分享到新浪微博" class="share_icon" target="_blank">
						<img src="<?php echo $TEMPLATE_URL; ?>/images/weibo32.png" class="share_img" /></a></div>
				<div class="share_icon_text">新浪微博</div>
			</div>
		</div>
		</div>
	</div>
	<?php /* --
	<div class="mb_favorite_share_bottom">
		<img id="btn_cancel_favorite" class="btn_cancel_favorite" src="<?php echo $TEMPLATE_URL; ?>/images/cancel.png" 
			onclick="javascript:_hide_favorite();"/>
	</div>
	--*/ ?>
</div>
</div>
<!-- 关于与评价 -->
<div id="footer_freeback" class="pop_page" style="display:none;overflow-y:scroll">
	<div id="footer_freeback_wrap"> 
	<div class="matchbox_freeback_title">
		<a id="btn_open_about" class="mb_menu_link">关于火柴盒</a>
	</div>
	<div class="matchbox_freeback_title"> 
		<a id="btn_open_contribute" class="mb_menu_link">投稿给我们</a>
	</div>
	<!--
	<div class="matchbox_freeback_title">
		<a class="mb_menu_link">去APP STORE评价我们</a>
	</div>
	-->
	<div class="matchbox_freeback_title">
		<a id="btn_open_freeback" class="mb_menu_link">意见反馈</a>
	</div>
	<div class="matchbox_freeback_title">
		<a  id="btn_open_business" class="mb_menu_link">商业合作</a>
	</div>
	<div class="matchbox_freeback_title">
		<a  id="btn_open_book" class="mb_menu_link">使用指南</a>
	</div>
	<!--
	<div class="matchbox_comment_buttongroup">
		<img id="btn_cancel_freeback" class="btn_cancel_freeback" src="<?php echo $TEMPLATE_URL; ?>/images/cancel.png" />
	</div>
	-->
	</div>
</div>
<!-- 信息页面 -->
<div id="mb_info_page" class="mb_info_page pop_page" style="display:none;">
	<!-- 关于火柴盒 -->
	<div id="mb_info_page_about" class="mb_info_page_sub" style="display:none">
		<p class="title_area">关于火柴盒</p>
		<span class="text_area">　Shine A Light。《火柴盒》是一个分享打动人心事物的APP。每天用10分钟的细碎时光，点燃内心的一点小光明。<br/><br/>

《火柴盒》共有三个栏目。<br/><br/>

1. 某月某日的猜：可能是一阕歌，一帧语录，一部冷门电影，一牍画,一条混不吝的段子......视读者的喜好和主创的心情而定。<br/><br/>

2. 某月某日的诗：在不读诗的时代，我们读诗。在“诗人已死”的时代，我们读诗。艾略特说，诗歌不是感情的放纵，而是感情的逃避。我们不放纵，也不逃避，只是带着感情，静静读诗。 <br/><br/>

3. 某月某日的文：文不在长，有情则灵。小说，散文，童话故事，随笔。可以来一点感悟，也可以来一发残酷。<br/><br/><br/>

 &nbsp;&nbsp;&nbsp;在内容的选择上，我们会让原创和经典并存。所以如果你喜欢，可以给我们投稿，也可以给我们推荐你喜欢的事物。需要提到的是，我们绝对绝对不是心灵鸡汤，所以偶尔会有一些邪性和怀疑道德的内容分享，请淡定。<br/>

  &nbsp;&nbsp;&nbsp;我们偶尔点亮火柴，用火柴独有的磷味和蓝焰，抛光日渐粗犷的人心。<br/><br/>


《火柴盒》主创团队——<br/>

主编大人：东方可爱<br/>
文字编辑：菜菜在路上<br/>
美术编辑：喵咪郭 刘刚<br/>
音乐编辑：妹妹溜狗狗 Mavis<br/>
金牌义工：猫老妞<br/>
<br/><br/><br/><br/>
			</span>
	</div>
	<!-- 投稿给我们 -->
	<div id="mb_info_page_contribute" class="mb_info_page_sub" style="display:none">
		<p class="title_area">投稿给我们</p>
		<span class="text_area">
			无论是原创音乐，还是诗歌、小说、散文、段子等文字作品，还是插画、摄影、设计等图形作品，只要是你的得意之作，都可以给我们投稿！<br/><br/>
			酬稿从优！<br/><br/>
			投稿邮箱：<br/>
match201311@qq.com<br/><br/>

邮件标题请注明“原创”，并留下详细联系方式
		</span>
	</div>
	<!-- 商业合作 -->
	<div id="mb_info_page_business" class="mb_info_page_sub" style="display:none">
		<p class="title_area">商业合作</p>
		<span class="text_area">
				我们可以提供以下商业服务——<br/><br/>

火柴盒app广告合作、APP产品定制、手机游戏定制、新媒体解决方案<br/><br/>


如有合作需求，请把贵公司信息、详细需求、预算、联系方式等发送至邮箱：<br/>

match2013@qq.com
		</span>
	</div>
	<div id="mb_info_page_user_book" class="mb_info_page_sub pop_page" style="display:none;">
	
		<img src = "<?php echo $TEMPLATE_URL; ?>/images/book.jpg" width="100%">
	</div>

</div>
<!-- 评价页面 -->
<div id="footer_comment" class="pop_page" style="display:none;">
		<!--				
		<div class="matchbox_comment_title">
			<div class="backicon">
				<img src="<?php echo $TEMPLATE_URL; ?>/images/back.png" onclick="_hide_comment()"/>
			</div>
			<div style="margin-left:40px; margin-right:40px; text-align: center;">
				用户反馈
			</div>
		</div>
		-->
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
					<img src="<?php echo $TEMPLATE_URL; ?>/images/fb.gif" style="height:10px;"/>
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
<script type="text/javascript" src="<?php echo $TEMPLATE_URL; ?>/share.js"></script>
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
			    	mySwiper.params.onlyExternal = true;
			    	_load_post(mySwiper.activeIndex, 3, true);
			    	mySwiper.params.onlyExternal = false;
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

			my_array.push('1118');my_array_title.push('歌：Stephanie Says');hashMap.Set('?p=1118', '');
my_array.push('1114');my_array_title.push('图：无题');
my_array.push('1110');my_array_title.push('文：雨伞和雨鞋');
my_array.push('1106');my_array_title.push('歌：关于我爱你');
my_array.push('1103');my_array_title.push('语：东方可爱 ');
my_array.push('1099');my_array_title.push('诗：秋来之后');
my_array.push('1095');my_array_title.push('歌：Five Hundred Miles');
my_array.push('1091');my_array_title.push('语：陆晓云');
my_array.push('1085');my_array_title.push('文：想太多小姐和睡不着先生');
my_array.push('1080');my_array_title.push('歌：Vincent');
my_array.push('1073');my_array_title.push('诗：Vincent');
my_array.push('984');my_array_title.push('歌：Sunny Day');
my_array.push('992');my_array_title.push('语：姜玖');
my_array.push('1040');my_array_title.push('文：所有的男人都是消耗品');
my_array.push('974');my_array_title.push('歌：Meet Me By The Water');
my_array.push('990');my_array_title.push('语：幻幻觉觉');
my_array.push('1029');my_array_title.push('诗：你没有如期归来');
my_array.push('970');my_array_title.push('歌：Every Breath You Take');
my_array.push('996');my_array_title.push('语：日向秀树');
my_array.push('1043');my_array_title.push('文：我一生都在等你');
my_array.push('972');my_array_title.push('歌：梵高先生');
my_array.push('997');my_array_title.push('语：王尔德');
my_array.push('1014');my_array_title.push('文：不想拥抱我的人');
my_array.push('980');my_array_title.push('歌：She\'s Got You High');
my_array.push('988');my_array_title.push('语：东方可爱');
my_array.push('1037');my_array_title.push('文：看不见的女友');
my_array.push('982');my_array_title.push('歌：Some Dreams');
my_array.push('928');my_array_title.push('图：Tang Yau Hoong');
my_array.push('1035');my_array_title.push('诗：一生都在下雨');
my_array.push('968');my_array_title.push('歌：Beat It');
my_array.push('994');my_array_title.push('语：柯南');
my_array.push('1031');my_array_title.push('文：狐狸的晚餐会');
my_array.push('978');my_array_title.push('歌：Relief');
my_array.push('1020');my_array_title.push('诗：我曾经爱过你');
my_array.push('976');my_array_title.push('歌：Mushaboom');

		}

		jQuery('#mySwipe-wrap').height(jQuery(window).height() - 38);
		
		
		_load_post(current_post, 3, true);
		_init_player(my_array[0]);
		
		jQuery('#ad_image_' + my_array[0]).toggle(
		     function () {
		        jQuery('#mb_ad_link_' + my_array[0]).show();
		     },
		     function () {
		        jQuery('#mb_ad_link_' + my_array[0]).hide();
		     }
		 ).bind('click');

	});
</script>
</html>