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
	<script type='text/javascript' src='<?php echo $SITE_URL; ?>/wp-includes/js/phonegap/cordova.js'></script>
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