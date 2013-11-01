<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<meta content="width=device-width,initial-scale=1.0,user-scalable=no,minimum-scale=1.0,maximum-scale=1.0" name="viewport">
	<meta content="yes" name="apple-mobile-web-app-capable">
	<meta content="black-translucent" name="apple-mobile-web-app-status-bar-style">
	<meta name="format-detection" content="telephone=no">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php /*
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	 */?>
	<?php wp_head(); ?>
	
	
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/site-style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/audio.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/audio_style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/site-style-29.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/idangerous.swiper.css" />
	
	<?php /*
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/jquery.mobile-1.3.2.min.css" />
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.mobile-1.3.2.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/swipe.js"></script>
	*/ ?>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/math.uuid.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/iscroll.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/timeline-graph2.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/idangerous.swiper.js"></script>
	
	
	<script type="text/javascript">
	var _user_token = function() {
		var token = localStorage.getItem('user_token');
		if (!token) {
			token = Math.uuid(16,10);
			localStorage.setItem('user_token', token);
		} 
		//alert(token);
	    return token;
	}
	var _close_pop_all = function() {
		jQuery('.pop_page').hide();
	}
	var _hidefavorite = function() {
		jQuery('#footer_favorite').hide();
	};
	var _showfavorite = function(kind) {
		_close_pop_all();
		/*
		if ('f' == kind) {
			jQuery('#footer_favorite_share_wrap').hide();
			jQuery('#footer_favorite_favorite_wrap').show();
		} else if ('s' == kind) {
			jQuery('#footer_favorite_favorite_wrap').hide();
			jQuery('#footer_favorite_share_wrap').show();
		} else {
			jQuery('#footer_favorite_favorite_wrap').show();
			jQuery('#footer_favorite_share_wrap').show();
		}
		*/
		jQuery('#footer_favorite_favorite_wrap').show();
		jQuery('#footer_favorite_share_wrap').show();
		jQuery('#footer_favorite').fadeIn(1200);	
	};
	var _showfreeback = function() {
		_close_pop_all();
		jQuery('#footer_freeback').css('margin-top', '36px');
		jQuery('#footer_freeback').height(jQuery(window).height() - 36);	
		jQuery('#footer_freeback').fadeIn(1200);	
	};
	var _hidefreeback = function() {
		jQuery('#footer_freeback').hide();	
	};
	var _open_info_page = function(kind) {
		jQuery('#mb_info_page').css('margin-top', '36px');
		jQuery('#mb_info_page').height(jQuery(window).height() - 36);	
		_hidefreeback();
		
		jQuery('#mb_info_page .mb_info_page_sub').hide();
		jQuery('#mb_info_page_' + kind).show();
		jQuery('#mb_header_right').hide();
		jQuery('#mb_header_back').show();
		jQuery('#mb_info_page').fadeIn(1200);
	};
	var _close_info_page = function() {
		jQuery('#mb_info_page').fadeOut(1200);
		jQuery('#mb_header_back').hide();
		jQuery('#mb_header_right').show();
	};
	var _show_favorite_page = function(postid) {
		jQuery('#mb_favorite_page_content').empty();
		jQuery('#mb_header_right').hide();
		jQuery('#mb_header_favorite_back').show();
		jQuery('#mb_favorite_page').css('margin-top', '36px');
		jQuery('#mb_favorite_page').height(jQuery(window).height() - 36);	
		jQuery('#mb_favorite_page').fadeIn(1200);
		jQuery('#mb_favorite_page_content').load( '?p=' + postid + '&single=true&favorite=true', function() {
			  
		});
	};
	var _close_favorite_page = function() {
		jQuery('#mb_favorite_page').fadeOut(1200);
		jQuery('#mb_header_favorite_back').hide();
		jQuery('#mb_header_right').show();
	};
	var _showcomment = function() {
		jQuery('#matchbox_comment_loading_circle').hide();
		jQuery('#matchbox_comment_status').empty();
		jQuery('#matchbox_submit_comment').show();
		jQuery('#footer_comment').css('margin-top', '36px');	
		jQuery('#footer_comment').height(jQuery(window).height() - 36);	
		jQuery('#footer_comment').fadeIn(1200);
		_hidefreeback();
	};
	var _hidecomment = function() {
		_showfreeback();
		jQuery('#footer_comment').hide();
	};
	var _commentsubmit = function() {
		jQuery('#matchbox_comment_status').hide();
		jQuery('#matchbox_comment_loading_circle').show();
		jQuery('#matchbox_submit_comment').hide();
		jQuery.post("<?php echo esc_url( home_url( '/' ) ); ?>wp-comments-post.php", 
			jQuery( "#matchbox_commentform" ).serialize() )
			.done(function( data ) {
		    	jQuery('#matchbox_comment_status').html('<span><?php echo "您的评价已经提交，谢谢！" ?></span>');
				jQuery('#comment').val('');
		    	jQuery('#footer_comment').fadeOut(1200);
		    })
		    .fail(function() {
			    jQuery('#matchbox_submit_comment').show();
		    	jQuery('#matchbox_comment_status').html('<span><?php echo "对不起，你的评价提交失败了！" ?></span>');
			})
			.always(function() {
				jQuery('#matchbox_comment_loading_circle').hide();
				jQuery('#matchbox_comment_status').show();
			});
	};

	jQuery(function(){
		
		/*
		if(window.localStorage){
		 alert('This browser supports localStorage');
		}else{
		 alert('This browser does NOT support localStorage');
		}
		*/
		
		//jQuery.mobile.ajaxEnabled = false;
		
		var getDateStr = function () { 
			var dd = new Date(); 
			var y = dd.getYear(); 
			var m = dd.getMonth() + 1;
			var d = dd.getDate(); 
			return y+"-"+m+"-"+d; 
		} 
		var firstUsing = function () {
			var name = 'lastdate';
			var today = getDateStr();
			var ret = false;
			lastdate = localStorage.getItem(name);
			if (!lastdate || lastdate != today) {
				ret = true;
			} 
			localStorage.setItem(name,today);
	        return ret;
		}
		if (firstUsing()) {
			setTimeout('jQuery(".md_ad").fadeIn("slow")',100);
			setTimeout('jQuery(".md_ad").fadeOut("slow")',4000);
				jQuery(".ad_close").click(function(){
				jQuery(".md_ad").hide("slow");
			});
		}
		
		// 打开收藏与分享菜单
		jQuery('#btn_favorite').bind("click", function(event) {
			_showfavorite();	
		});
		
		// 打开反馈菜单
		jQuery('#btn_feedback').bind("click", function(event) {
			_showfreeback();	
		});	
		// 收藏文章
		jQuery('#link_add_favorite').bind("click", function(event) {
			var post_id	= jQuery('#favorite_current_post_id').val();
			jQuery.get('?wpfpaction=add&postid=' + post_id + '&ajax=1&user=' + _user_token(), function(data){
			  //alert(data);
			  jQuery('#link_add_favorite').hide();
			  jQuery('#link_remove_favorite').show();
		  	  
			});
		});
		// 取消文章收藏
		jQuery('#link_remove_favorite').bind("click", function(event) {
			var post_id	= jQuery('#favorite_current_post_id').val();
			jQuery.get('?wpfpaction=remove&postid=' + post_id + '&ajax=1&user=' + _user_token(), function(data){
			  //alert(data);
			  jQuery('#link_remove_favorite').hide();
		  	  jQuery('#link_add_favorite').show();
			});
		});
		// 打开收藏列表
		jQuery('#link_list_favorite').bind("click", function(event) {
			jQuery('#favorite_content').load('?wpfpaction=list&ajax=1&user=' + _user_token(), function(){
			  _hidefavorite();
			  jQuery('#favorite_list').css('margin-top', '36px');
			  jQuery('#favorite_list').height(jQuery(window).height() - 36);	
			  jQuery('#favorite_list').css({'display':'block'});
			});
		});
		// 关闭收藏列表
		jQuery('#btn_cancel_list_favorite').bind("click", function(event) {
			  jQuery('#favorite_list').css({'display':'none'});
		});
		
		// 关闭关于页面
		jQuery('#btn_cancel_freeback').bind("click", function(event) {
			  jQuery('#footer_freeback').css({'display':'none'});
		});
		
		jQuery('#mb_header_favorite_back').bind("click", function(event) {
			  _close_favorite_page();
		});
		
		/* 信息页面控制 */
		jQuery('#btn_header_back').bind("click", function(event) {
			_close_info_page();
		});
		jQuery('#btn_open_about').bind("click", function(event) {
			_open_info_page('about');
		});
		jQuery('#btn_open_contribute').bind("click", function(event) {
			_open_info_page('contribute');
		});
		jQuery('#btn_open_business').bind("click", function(event) {
			_open_info_page('business');
		});
		/* 空白点击退出层 
		jQuery('#main').bind("click", function(event) {
			_close_pop_all();
		});
		*/
	});
	
	</script>

</head>

<body screen_capture_injected="true" <?php body_class(); ?> style="margin-top:36px;">
	<div id="masthead" class="mb_header" data-role="header" data-position="fixed" data-theme="m">
		<div class="mb_header_left">
			<img id="btn_feedback" src="<?php echo get_template_directory_uri(); ?>/images/fun_left.png"/></div>	
		<div id="mb_header_right" class="mb_header_right">
			<img id="btn_favorite" src="<?php echo get_template_directory_uri(); ?>/images/fun_right.png"/></div>
		<div id="mb_header_back" class="mb_header_right" style="display:none;">
			<img id="btn_header_back" src="<?php echo get_template_directory_uri(); ?>/images/fun_right_back.png"/></div>
		<div id="mb_header_favorite_back" class="mb_header_right" style="display:none;">
			<img id="btn_header_favorite_back" src="<?php echo get_template_directory_uri(); ?>/images/fun_right_back.png"/></div>
		<div class="mb_header_center">
		
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
		
				<img class="mb_header_title" src="<?php echo get_template_directory_uri(); ?>/images/title.png"/>

			</a>

		</div>
		<!--
		<hr style="margin: 0;"/>
		-->
	</div>
	<div class="md_ad" style="display:none;">
		<a href="#" target="_blank">
			<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/uploads/2013/10/20095121364651126.jpg" 
				style="width:100%;height:100%;"/></a>
		<a class="ad_close">关闭</a>
	</div>

	<div id="main" class="mb_content" data-role="content" data-theme="m">
		
