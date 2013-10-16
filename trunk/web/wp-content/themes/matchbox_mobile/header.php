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
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
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
	var _showfavorite = function() {
		jQuery('#footer_favorite').show();	
	}
	var _showfreeback = function() {
		jQuery('#footer_freeback').show();	
	}
	var _hidefreeback = function() {
		jQuery('#footer_freeback').hide();	
	}
	</script>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/site-style.css" />
</head>

<body <?php body_class(); ?>>
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

	<div id="main" class="site-main">
		<hr/>
