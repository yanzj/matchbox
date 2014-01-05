var _clickEventName = 'touchstart';
var _fadeTime = 500;
var sUserAgent = navigator.userAgent.toLowerCase(); 
var bAndroid = sUserAgent.match(/android/i) == 'android';
var hashMap = {  
	Set : function(key,value){this[key] = value},  
	Get : function(key){return this[key]},  
	Contains : function(key){return this.Get(key) == null?false:true},  
	Remove : function(key){delete this[key]}  
};
	
var favorite = {
	Init : function() {
		var favorite = localStorage.getItem('favorite');
		if (!favorite) {
			localStorage.setItem('favorite', ',');
		}
	},
	Add : function(id, title) {
		var favorite = localStorage.getItem('favorite');
		favorite = favorite + id + ',';
		localStorage.setItem('favorite', favorite);
		localStorage.setItem('favorite_' + id, title);
	},
	Remove : function(id) {
		var favorite = localStorage.getItem('favorite');
		favorite = favorite.replace(',' + id + ',', ',');
		localStorage.setItem('favorite', favorite);
	},
	Exists : function(id) {
		var favorite = localStorage.getItem('favorite');
		if (favorite)
			return favorite.indexOf(',' + id + ',') > -1;
		return false;
	},
	Items : function() {
		jQuery('#favorite_content_ul').empty();
		var favorite = localStorage.getItem('favorite');
		var ids = favorite.split(',');
		for (i = ids.length - 1; i >= 0 ; i--) {
			if (ids[i]) {
				jQuery('#favorite_content_ul').append(jQuery('<li><a onclick="_show_favorite_page(' + ids[i] + ')">' + localStorage.getItem('favorite_' + ids[i]) + '</a></li>'));
			}
		}
	}
};
	
var _get_date_str = function () { 
	var dd = new Date(); 
	var y = dd.getYear(); 
	var m = dd.getMonth() + 1;
	var d = dd.getDate(); 
	return y+"-"+m+"-"+d; 
};
// 重置内容高度
var _resize_height = function (content_id) {  
	jQuery('#' + content_id).scrollTop(0); // 返回顶部
	//return;
	if (jQuery('#' + content_id).height() < jQuery(window).height() - 34) {
	  	//alert(jQuery('#' + content_id).height() + '/' + jQuery(window).height());
		//jQuery('#mySwipe-wrap').height(jQuery(window).height() - 34);
	} else {
	  	//jQuery('#mySwipe-wrap').height(jQuery('#' + content_id).height());
	}
	
	jQuery('body').height(jQuery('#mySwipe-wrap').height());
	if ( jQuery('#height_' + content_id).length > 0 ) {
		if (jQuery('#' + content_id).height() < jQuery('body').height()) {
			jQuery('#height_' + content_id).height(jQuery('body').height() - jQuery('#' + content_id).height() + 20);
			console.log(jQuery('#height_' + content_id).height());
		}
	}
	if (bAndroid) {
		new iScroll(content_id);
	}
};	
// 载入播放器
var _init_player = function(id) {
	var audioId = 'audio-' + id + '-1';
	var processId = 'progress-in-' + audioId;
	var playtoggleId = 'playtoggle-' + audioId;
	if (jQuery('#' + audioId)) {
        var audio = jQuery('#' + audioId).get(0);
	    jQuery(audio).bind('timeupdate', function() {
	    	var pos = (audio.currentTime / audio.duration) * 100;
	        jQuery('#' + processId).css('width', pos + '%'); 
      }).bind('play',function(){
          jQuery("#" + playtoggleId).addClass('playing');
      }).bind('pause ended', function() {
          jQuery("#" + playtoggleId).removeClass('playing');
      }).bind("canplay", function () {
      	console.log(this.currentTime + '/' + this.duration);
    	});
			jQuery("#" + playtoggleId).bind('touchstart', function() {
				if (audio.paused) {
					jQuery('audio').each(function(){
						var oAudio = jQuery(this).get(0);
						console.log(audio.id + ':' + oAudio.id);
				    if (audio.id != oAudio.id) {
				      //oAudio.currentTime = 0;
				    	oAudio.pause(); 
				    }
				  });
					audio.play();
				} else { 
					audio.pause(); 
				}
				event.stopPropagation();
			});
    }
};
// 取得用户标识
var _user_token = function() {
	var token = '';
	/*
	token = localStorage.getItem('user_token');
	if (!token) {
		token = Math.uuid(16,10);
		localStorage.setItem('user_token', token);
	} 
	console.log('token: ' + token);
	*/
    return token;
};
// 关闭所有POP层
var _close_pop_all = function() {
	jQuery('#mb_header_back').hide();
	jQuery('#mb_header_favorite_back').hide();
	jQuery('#mb_header_right').show();
	jQuery('#mb_header_left').show();
	jQuery('.pop_page').hide();
};
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
	jQuery('#footer_favorite_frame').css('margin-top', '34px');
	jQuery('#footer_favorite_frame').height(jQuery(window).height() - 34);	
	jQuery('#footer_favorite_frame').slideDown(_fadeTime);	
};
// 关闭收藏与分享POP层
var _hide_favorite = function() {
	jQuery('#footer_favorite_frame').slideUp(_fadeTime);
};
// 打开收藏文章
var _show_favorite_page = function(postid) {
	jQuery('#mb_favorite_page_content').empty();
	jQuery('#mb_header_left').hide();
	jQuery('#mb_header_favorite_back').show();
	jQuery('#mb_favorite_page').css('margin-top', '34px');
	jQuery('#mb_favorite_page').height(jQuery(window).height() - 34);	
	jQuery('#mb_favorite_page').slideDown(_fadeTime);
	jQuery('#mb_favorite_page_content').load( '?p=' + postid + '&single=true&favorite=true', 
		function() {
		_init_player('favorited-' + postid);
	});
};
// 关闭收藏文章
var _close_favorite_page = function() {
	jQuery('#mb_favorite_page').slideUp(_fadeTime);
	jQuery('#mb_header_favorite_back').hide();
	jQuery('#mb_header_left').show();
};
// 显示评价POP层
var _show_freeback = function() {
	_close_pop_all();
	jQuery('#footer_freeback').css('margin-top', '34px');
	jQuery('#footer_freeback').height(jQuery(window).height() - 34);	
	jQuery('#footer_freeback').slideDown(_fadeTime);	
};
// 关闭评价POP层
var _hide_freeback = function() {
	jQuery('#footer_freeback').slideUp();	
};
// 打开信息页面
var _open_info_page = function(kind) {
	jQuery('#mb_info_page').css('margin-top', '33px');
	jQuery('#mb_info_page').height(jQuery(window).height() - 33);	
	_hide_freeback();
	
	jQuery('#mb_info_page .mb_info_page_sub').hide();
	jQuery('#mb_info_page_' + kind).show();
	jQuery('#mb_header_right').hide();
	jQuery('#mb_header_back').show();
	jQuery('#mb_info_page').slideDown(_fadeTime);

};
// 关闭信息页面
var _close_info_page = function() {
	jQuery('#mb_info_page').slideUp(_fadeTime);
	jQuery('#mb_header_back').hide();
	jQuery('#mb_header_right').show();
};
// 打开评价表单
var _show_comment = function() {
	jQuery('#matchbox_comment_loading_circle').hide();
	jQuery('#matchbox_comment_status').empty();
	jQuery('#matchbox_submit_comment').show();
	jQuery('#footer_comment').css('margin-top', '34px');	
	jQuery('#footer_comment').height(jQuery(window).height() - 34);	
	jQuery('#footer_comment').slideDown(_fadeTime);
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
		url : SITE_URL + '/wp-comments-post.php', 
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
function showAD() {
	if (firstUsing()) {
		setTimeout('jQuery(".md_ad").fadeIn("slow")',100);
		setTimeout('jQuery(".md_ad").fadeOut("slow")',4000);
		jQuery(".ad_close").bind(_clickEventName, function(){
			jQuery(".md_ad").hide("slow");
		});
	}
}
jQuery(function(){		
	jQuery('#footer_favorite').bind(_clickEventName, function(event) {
	 	event.stopPropagation();
	});
	// 收藏与分享ClickEvent
	jQuery('#mb_header_right').bind(_clickEventName, function(event) {
		_show_favorite();	
	});
	
	// 评价ClickEvent
	jQuery('#mb_header_left').bind(_clickEventName, function(event) {
		_show_freeback();	
	});	
	
	// 收藏本文ClickEvent
	jQuery('#link_add_favorite').bind('click', function(event) {
		var post_id	= jQuery('#favorite_current_post_id').val();
		var post_title = jQuery('#mb_post_title_' + post_id).val();
		favorite.Add(post_id, post_title);
		jQuery('#link_add_favorite').hide();
		jQuery('#link_remove_favorite').show();
	});
	// 取消收藏ClickEvent
	jQuery('#link_remove_favorite').bind('click', function(event) {
		var post_id	= jQuery('#favorite_current_post_id').val();
		favorite.Remove(post_id);
		jQuery('#link_remove_favorite').hide();
	  	jQuery('#link_add_favorite').show();
	});
	// 查看收藏ClickEvent
	jQuery('#link_list_favorite').bind('click', function(event) {
		jQuery('#footer_favorite_frame').hide();
		jQuery('#favorite_list').css('margin-top', '34px');
		jQuery('#favorite_list').height(jQuery(window).height() - 34);	
		jQuery('#favorite_list').slideDown(_fadeTime);
		favorite.Items();
	});
	// 收藏与分享取消Clickvent
	jQuery('#mb_header_favorite_back').bind('click', function(event) {
		  _close_favorite_page();
	});
	// 查看收藏取消Clickvent
	jQuery('#btn_cancel_list_favorite').bind('click', function(event) {
		  jQuery('#favorite_list').slideUp(_fadeTime);
		  
	});
	// 收藏与分享空白部分Clickvent
	jQuery('#footer_favorite_frame').bind('click', function(event) {
		  _hide_favorite();
	});
	jQuery('#footer_freeback').bind(_clickEventName, function(event) {
		  _hide_freeback();
	});
	// 评价取消Clickvent
	jQuery('#btn_cancel_freeback').bind('click', function(event) {
		  jQuery('#footer_freeback').slideUp(_fadeTime);
	});
	/* 信息页面控制 */
	jQuery('#mb_header_back').bind(_clickEventName, function(event) {
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
	

var my_array = new Array();
var my_array_title = new Array();
var current_post = 0;
var current_post_id;
var urltemplate = '?p=';
var myScroll;
var _deviceReady;

	
var circularHtml = '<div style="width:100%;margin:0 auto;text-align:center;"><div id="circular" style="display:inline-block;margin-top:50px;">' 
				+ '<img src="/wp-content/themes/matchbox_mobile/images/loader.gif"/>'
			  + '</div></div>';

var _closeSplashScreen = function() {
		document.addEventListener("deviceready", onDeviceReady, false);	
		function onDeviceReady() {
        navigator.splashscreen.hide();
    }
};
    
var _load_post = function(idx, surplus, first) {
	
	if (myScroll) {
		//myScroll.destroy();
	}
	
	var id = my_array[idx];
	var title = my_array_title[idx];
	current_post_id = id;
	var url = urltemplate + id;
	var content_id = 'mathbox_content_' + id;
	
	//切换特效
	
	if (hashMap.Contains(url)) {
		console.log('has ' + url);
		_resize_height(content_id);
		if (!_deviceReady) {
		 		console.log(surplus + 'deviceReady3');
		 	  _closeSplashScreen();
		 		_deviceReady = true;
		 		
		 	}
	} else {
		if (first) {
			jQuery('#' + content_id).html(circularHtml);
		}
		//alert('load ' + id);
		jQuery('#' + content_id).load( url + '&single=true', function() {
		  hashMap.Set(url, '');
		  _init_player(id);
		 
		 jQuery('#ad_image_' + id).toggle(
		     function () {
		        jQuery('#mb_ad_link_' + id).show();
		     },
		     function () {
		        jQuery('#mb_ad_link_' + id).hide();
		     }
		 ).bind('click');
		 
		 jQuery('#mb_ad_link_' + id).bind(_clickEventName, function(event) {
		 	event.stopPropagation();
		 });
		 if (first) {
		 	 _resize_height(content_id);
		 }
		 
		 if (surplus > 0) {
		 	 if (my_array.length >= idx + 1) {
		 	 	// alert('next');
		 		_load_post(idx+1, surplus-1, false);
		 	 } else {
			 	if (!_deviceReady) {
			 		console.log(surplus + 'deviceReady1');
			 		_closeSplashScreen();
			 		_deviceReady = true;
			 		
			 	}
		 	 }
		 } else {
		 	if (!_deviceReady) {
		 		console.log(surplus + 'deviceReady2');
		 		_closeSplashScreen();
		 		_deviceReady = true;
		 		
		 	}
		 }
	   });
	}

	// 判断是否已经收藏 
	if (first) {
		if (!favorite.Exists(id)) {
		  jQuery('#link_remove_favorite').hide();
		  jQuery('#link_add_favorite').show();
		} else {
		  jQuery('#link_add_favorite').hide();
		  jQuery('#link_remove_favorite').show();
		}
		jQuery('#favorite_current_post_id').val(id);
			
		// 分享连接
		var shareUrl = SITE_URL + '/' + url;
		//jQuery('#share_weixin').attr('href', 'javascript:alert(shareUrl + "\n微信扫描二维码分享")');
		//jQuery('#share_sina').attr('href', 'http://v.t.sina.com.cn/share/share.php?appkey=appkey&url=' + shareUrl + '&title=' + jQuery('#mb_post_title_' + id).val());
		//jQuery('#share_mail').attr('href', 'mailto:?subject=' + title + '&body=' + shareUrl);
	}
};
