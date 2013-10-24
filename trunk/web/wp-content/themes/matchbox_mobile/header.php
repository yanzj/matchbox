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
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.ez-pinned-footer.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/swipe.js"></script>
	<script type="text/javascript">
	function toggleSound(audioid) {
		var music = document.getElementById(audioid);
		jQuery("#matchbox_play_button");
		if (music.paused) {
			music.play();
			jQuery("#matchbox_play_button").attr('src', '<?php echo get_template_directory_uri(); ?>/images/pause.png');
		} else {
			music.pause();
			jQuery("#matchbox_play_button").attr('src', '<?php echo get_template_directory_uri(); ?>/images/play.png');
		}
	}
	
	var _hidefavorite = function() {
		jQuery('#footer_favorite').hide();
	}
	var _showfavorite = function(kind) {
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
		jQuery('#footer_favorite').show();	
	}
	var _showfreeback = function() {
		jQuery('#footer_freeback').show();	
	}
	var _hidefreeback = function() {
		jQuery('#footer_freeback').hide();	
	}
	var _showcomment = function() {
		jQuery('#matchbox_comment_loading_circle').hide();
		jQuery('#matchbox_comment_status').empty();
		jQuery('#matchbox_submit_comment').show();
		jQuery('#footer_comment').show();
		_hidefreeback();
	}
	var _hidecomment = function() {
		jQuery('#footer_comment').hide();	
	}
	var _commentsubmit = function() {
		jQuery('#matchbox_comment_status').hide();
		jQuery('#matchbox_comment_loading_circle').show();
		jQuery('#matchbox_submit_comment').hide();
		jQuery.post( "<?php echo esc_url( home_url( '/' ) ); ?>wp-comments-post.php", 
			jQuery( "#matchbox_commentform" ).serialize() )
			.done(function( data ) {
		    	jQuery('#matchbox_comment_status').html('<span><?php echo "您的评价已经提交，谢谢！" ?></span>');
		    })
		    .fail(function() {
			    jQuery('#matchbox_submit_comment').show();
		    	jQuery('#matchbox_comment_status').html('<span><?php echo "对不起，你的评价提交失败了！" ?></span>');
			})
			.always(function() {
				jQuery('#matchbox_comment_loading_circle').hide();
				jQuery('#matchbox_comment_status').show();
			});
	}
	</script>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/site-style.css" />
</head>

<body screen_capture_injected="true" <?php body_class(); ?> style="margin-top:36px;">
	<div id="masthead" class="site-header">
		<div style="float:left; width:40px;height:32px; padding-top:3px;">
			<img id="btn_favorite" src="<?php echo get_template_directory_uri(); ?>/images/fun_left.png"/></div>	
		<div style="float:right; width:40px; height:32px; padding-top:3px;">
			<img id="btn_feedback" src="<?php echo get_template_directory_uri(); ?>/images/fun_right.png"/></div>
		<div style="margin-left:40px; margin-right:40px; text-align: center;">
			<!--
			<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<span class="site-title"><?php bloginfo( 'name' ); ?></span>
			</a>
			-->
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/title.png" style="width:110px;height:36px"/></a>
		</div>
		<hr style="margin: 0;"/>
	</div><!-- #masthead -->
	<style>
	.adframe {
		position: fixed;
	    top: 0;
		right: 0;
		left: 0;
		width:100%;
		height:100%;
		z-index:9999;
	}
		
	</style>
	<div class="adframe" style="display:none;">
		<a href="#" target="_blank">
			<img src="http://192.168.16.2:8080/wp-content/uploads/2013/10/20095121364651126.jpg" 
				style="width:100%;height:100%;"/></a>
		<a class="ad_close">关闭</a>
	</div>
	<script>
	jQuery(function(){
		/*
		if(window.localStorage){
		 alert('This browser supports localStorage');
		}else{
		 alert('This browser does NOT support localStorage');
		}
		*/
		var getDateStr = function () { 
			var dd = new Date(); 
			var y = dd.getYear(); 
			var m = dd.getMonth() + 1;//获取当前月 
			var d = dd.getDate(); 
			return y+"-"+m+"-"+d; 
		} 
		var firstUsing = function () {
			var name = 'lastdate';
			var today = getDateStr();
			var ret = false;
			lastdate = localStorage.getItem(name);
			//alert(lastdate);
			if (!lastdate || lastdate != today) {
				//alert('is Today First Use');
				ret = true;
			} 
			localStorage.setItem(name,today);
	        return ret;
		}
		if (firstUsing()) {
			setTimeout('jQuery(".adframe").fadeIn("slow")',100);
			setTimeout('jQuery(".adframe").fadeOut("slow")',4000);
				jQuery(".ad_close").click(function(){
				jQuery(".adframe").hide("slow");
			});
		}
	});
	</script>


	<div id="main" class="site-main">
		
