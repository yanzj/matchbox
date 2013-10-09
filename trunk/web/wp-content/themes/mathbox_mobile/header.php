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
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/swipe.js"></script>

<?php 
	wp_head(); 
?>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/site-style.css" />
</head>

<body <?php body_class(); ?>>
	<div id="masthead" class="site-header">
		<div style="float:left; width:40px;height:32px; padding-top:3px;">
			<img src="<?php echo get_template_directory_uri(); ?>/images/fun_left.png"/></div>	
		<div style="float:right; width:40px; height:32px; padding-top:3px;">
			<img src="<?php echo get_template_directory_uri(); ?>/images/fun_right.png"/></div>
		<div style="margin-left:40px; margin-right:40px; text-align: center;">
			<!--
			<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<span class="site-title"><?php bloginfo( 'name' ); ?></span>
			</a>
			-->
			<img src="<?php echo get_template_directory_uri(); ?>/images/title.png" style="width:110px;height:36px"/>
		</div>
		<hr style="margin: 0;"/>
	</div><!-- #masthead -->

	<div id="main" class="site-main">
		<hr/>
