<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<meta content="width=device-width,initial-scale=1.0,user-scalable=no,minimum-scale=1.0,maximum-scale=1.0" name="viewport">
	<meta content="yes" name="apple-mobile-web-app-capable">
	<meta content="black-translucent" name="apple-mobile-web-app-status-bar-style">
	<meta name="format-detection" content="telephone=no">
	<title>火柴盒</title>
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
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/timeline-graph2.js"></script>
	*/ ?>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/math.uuid.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/iscroll.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/idangerous.swiper.js"></script>
	
	<script type="text/javascript">
	var _clickEventName = 'click';
	var _fadeTime = 600;
	var sUserAgent = navigator.userAgent.toLowerCase(); 
	var bAndroid = sUserAgent.match(/android/i) == 'android';
	var hashMap = {  
		Set : function(key,value){this[key] = value},  
		Get : function(key){return this[key]},  
		Contains : function(key){return this.Get(key) == null?false:true},  
		Remove : function(key){delete this[key]}  
	}
	var _get_date_str = function () { 
		var dd = new Date(); 
		var y = dd.getYear(); 
		var m = dd.getMonth() + 1;
		var d = dd.getDate(); 
		return y+"-"+m+"-"+d; 
	} 
	// 重置内容高度
	var _resize_height = function (content_id) {  
		jQuery('#' + content_id).scrollTop(0); // 返回顶部
		//return;
		if (jQuery('#' + content_id).height() < jQuery(window).height() - 38) {
		  	//alert(jQuery('#' + content_id).height() + '/' + jQuery(window).height());
			//jQuery('#mySwipe-wrap').height(jQuery(window).height() - 36);
		} else {
		  	//jQuery('#mySwipe-wrap').height(jQuery('#' + content_id).height());
		}
		
		jQuery('body').height(jQuery('#mySwipe-wrap').height());
		if (bAndroid) {
			new iScroll(content_id);
		}
	}	
	// 载入播放器
	var _init_player = function(id) {
		var audioId = 'audio-' + id + '-1';
		var processId = 'progress-in-' + audioId;
		var playtoggleId = 'playtoggle-' + audioId;
		if (jQuery('#' + audioId)) {
	        var audio = jQuery('#' + audioId).get(0);
			jQuery(audio).on("loadedmetadata", function(event) {
			    //alert(this.duration);
			});
		    
		    jQuery(audio).bind('timeupdate', function() {
		    	var pos = (audio.currentTime / audio.duration) * 100;
		        jQuery('#' + processId).css('width', pos + '%'); 
		                
	        }).bind('play',function(){
	            jQuery("#" + playtoggleId).addClass('playing');
	        }).bind('pause ended', function() {
	            jQuery("#" + playtoggleId).removeClass('playing');
	        }).bind("canplay", function () {
	        	//alert(thsi.currentTime + '/' + this.duration);
	    	});
	        
	        //jQuery("#" + playtoggleId).bind('touchstart', function() {
	       	jQuery("#" + playtoggleId).bind(_clickEventName, function() {
		        if (audio.paused) {
		        	audio.play();
		        } else { 
		        	audio.pause(); 
		        }
	        });
	    }
	};
	// 取得用户标识
	var _user_token = function() {
		var token = localStorage.getItem('user_token');
		if (!token) {
			token = Math.uuid(16,10);
			localStorage.setItem('user_token', token);
		} 
		//alert(token);
	    return token;
	}
	// 关闭所有POP层
	var _close_pop_all = function() {
		jQuery('.pop_page').hide();
	}
	// 显示收藏与分享POP层
	var _show_favorite = function(kind) {
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
		jQuery('#footer_favorite_frame').css('margin-top', '38px');
		jQuery('#footer_favorite_frame').height(jQuery(window).height() - 38);	
		jQuery('#footer_favorite_frame').fadeIn(_fadeTime);	
	};
	// 关闭收藏与分享POP层
	var _hide_favorite = function() {
		jQuery('#footer_favorite_frame').hide();
	};
	// 打开收藏文章
	var _show_favorite_page = function(postid) {
		jQuery('#mb_favorite_page_content').empty();
		jQuery('#mb_header_right').hide();
		jQuery('#mb_header_favorite_back').show();
		jQuery('#mb_favorite_page').css('margin-top', '38px');
		jQuery('#mb_favorite_page').height(jQuery(window).height() - 38);	
		jQuery('#mb_favorite_page').fadeIn(_fadeTime);
		jQuery('#mb_favorite_page_content').load( '?p=' + postid + '&single=true&favorite=true', 
			function() {
			_init_player('favorited-' + postid);
		});
	};
	// 关闭收藏文章
	var _close_favorite_page = function() {
		jQuery('#mb_favorite_page').fadeOut(_fadeTime);
		jQuery('#mb_header_favorite_back').hide();
		jQuery('#mb_header_right').show();
	};
	// 显示评价POP层
	var _show_freeback = function() {
		_close_pop_all();
		jQuery('#footer_freeback').css('margin-top', '38px');
		jQuery('#footer_freeback').height(jQuery(window).height() - 38);	
		jQuery('#footer_freeback').fadeIn(_fadeTime);	
	};
	// 关闭评价POP层
	var _hide_freeback = function() {
		jQuery('#footer_freeback').hide();	
	};
	// 打开信息页面
	var _open_info_page = function(kind) {
		jQuery('#mb_info_page').css('margin-top', '38px');
		jQuery('#mb_info_page').height(jQuery(window).height() - 38);	
		_hide_freeback();
		
		jQuery('#mb_info_page .mb_info_page_sub').hide();
		jQuery('#mb_info_page_' + kind).show();
		jQuery('#mb_header_right').hide();
		jQuery('#mb_header_back').show();
		jQuery('#mb_info_page').fadeIn(_fadeTime);
	};
	// 关闭信息页面
	var _close_info_page = function() {
		jQuery('#mb_info_page').fadeOut(_fadeTime);
		jQuery('#mb_header_back').hide();
		jQuery('#mb_header_right').show();
	};
	// 打开评价表单
	var _show_comment = function() {
		jQuery('#matchbox_comment_loading_circle').hide();
		jQuery('#matchbox_comment_status').empty();
		jQuery('#matchbox_submit_comment').show();
		jQuery('#footer_comment').css('margin-top', '38px');	
		jQuery('#footer_comment').height(jQuery(window).height() - 38);	
		jQuery('#footer_comment').fadeIn(_fadeTime);
		_hide_freeback();
	};
	var _hide_comment = function() {
		_show_freeback();
		jQuery('#footer_comment').hide();
	};
	// 提交评价
	var _submit_comment = function() {
		jQuery('#matchbox_comment_status').hide();
		jQuery('#matchbox_comment_loading_circle').show();
		jQuery('#matchbox_submit_comment').hide();
		jQuery.ajax({
			type: 'POST',
			headers : { "cache-control": "no-cache" },
			url : '<?php echo esc_url( home_url( '/' ) ); ?>wp-comments-post.php', 
			data: jQuery('#matchbox_commentform').serialize()
		})
			.done(function( data ) {
		    	jQuery('#matchbox_comment_status').html('<span><?php echo "您的评价已经提交，谢谢！" ?></span>');
				jQuery('#comment').val('');
		    	jQuery('#footer_comment').fadeOut(_fadeTime);
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
		var firstUsing = function () {
			var name = 'lastdate';
			var today = _get_date_str();
			var ret = false;
			lastdate = localStorage.getItem(name);
			if (!lastdate || lastdate != today) {
				ret = true;
			} 
			localStorage.setItem(name,today);
	        return ret;
		}
		/*
		if (firstUsing()) {
			setTimeout('jQuery(".md_ad").fadeIn("slow")',100);
			setTimeout('jQuery(".md_ad").fadeOut("slow")',4000);
			jQuery(".ad_close").bind(_clickEventName, function(){
				jQuery(".md_ad").hide("slow");
			});
		}*/
		
		jQuery('#footer_favorite').bind(_clickEventName, function(event) {
		 	event.stopPropagation();
		});
		// 收藏与分享ClickEvent
		jQuery('#btn_favorite').bind(_clickEventName, function(event) {
			_show_favorite();	
		});
		
		// 评价ClickEvent
		jQuery('#btn_feedback').bind(_clickEventName, function(event) {
			_show_freeback();	
		});	
		// 收藏本文ClickEvent
		jQuery('#link_add_favorite').bind(_clickEventName, function(event) {
			var post_id	= jQuery('#favorite_current_post_id').val();
			jQuery.get('?matchboxfp=add&postid=' + post_id + '&ajax=1&user=' + _user_token(), function(data){
			  //alert(data);
			  jQuery('#link_add_favorite').hide();
			  jQuery('#link_remove_favorite').show();
		  	  
			});
		});
		// 取消收藏ClickEvent
		jQuery('#link_remove_favorite').bind(_clickEventName, function(event) {
			var post_id	= jQuery('#favorite_current_post_id').val();
			jQuery.get('?matchboxfp=remove&postid=' + post_id + '&ajax=1&user=' + _user_token(), function(data){
			  //alert(data);
			  jQuery('#link_remove_favorite').hide();
		  	  jQuery('#link_add_favorite').show();
			});
		});
		// 查看收藏ClickEvent
		jQuery('#link_list_favorite').bind(_clickEventName, function(event) {
			jQuery('#favorite_content').load('?matchboxfp=list&ajax=1&user=' + _user_token(), function(){
			  _hide_favorite();
			  jQuery('#favorite_list').css('margin-top', '38px');
			  jQuery('#favorite_list').height(jQuery(window).height() - 38);	
			  jQuery('#favorite_list').css({'display':'block'});
			});
		});
		// 收藏与分享取消Clickvent
		jQuery('#mb_header_favorite_back').bind(_clickEventName, function(event) {
			  _close_favorite_page();
		});
		// 查看收藏取消Clickvent
		jQuery('#btn_cancel_list_favorite').bind(_clickEventName, function(event) {
			  jQuery('#favorite_list').css({'display':'none'});
		});
		// 收藏与分析空白部分Clickvent
		jQuery('#footer_favorite_frame').bind(_clickEventName, function(event) {
			  _hide_favorite();
		});
		// 评价取消Clickvent
		jQuery('#btn_cancel_freeback').bind(_clickEventName, function(event) {
			  jQuery('#footer_freeback').css({'display':'none'});
		});
		/* 信息页面控制 */
		jQuery('#btn_header_back').bind("click", function(event) {
			_close_info_page();
		});
		jQuery('#btn_open_about').bind(_clickEventName, function(event) {
			_open_info_page('about');
		});
		jQuery('#btn_open_contribute').bind(_clickEventName, function(event) {
			_open_info_page('contribute');
		});
		jQuery('#btn_open_business').bind(_clickEventName, function(event) {
			_open_info_page('business');
		});
		jQuery('#matchbox_submit_comment').bind(_clickEventName, function(event) {
			_submit_comment();
		});
		
	});
	
	</script>

</head>

<body screen_capture_injected="true" <?php body_class(); ?> style="margin-top:38px;">
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
		
		<!--	<a href="<?php echo esc_url( home_url( '/' ) ); ?>">	-->
			<a>
				<img class="mb_header_title" src="<?php echo get_template_directory_uri(); ?>/images/title.png"/>

			</a>

		</div>
		<!--
		<hr style="margin: 0;"/>
		-->
	</div>
	<div class="md_ad" style="display:none;">
		<a href="#" target="_blank">
			<img src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/ad/main.jpg" 
				style="width:100%;height:100%;"/></a>
		<a class="ad_close">关闭</a>
	</div>

	<div id="main" class="mb_content" data-role="content" data-theme="m">
		
