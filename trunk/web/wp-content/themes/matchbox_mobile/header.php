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
	<div id="mb_header_left" class="mb_header_left" style="width:64px;background:url('<?php echo $TEMPLATE_URL;?>/images/fun_left.png') no-repeat;background-size: 18px auto;height:32px;background-position-y:17px;"></div>
	<div id="mb_header_right" class="mb_header_right" style="width:64px;background:url('<?php echo $TEMPLATE_URL;?>/images/fun_right.png') no-repeat;background-size: 18px auto;background-position-x: right;background-position-y: 7px;"></div>
	<div id="mb_header_back" class="mb_header_right" style="display:none;width:64px;background:url('<?php echo $TEMPLATE_URL;?>/images/fun_right_back.png') no-repeat;background-size: 18px auto;background-position: 100% 7px;"></div>
	<div id="mb_header_favorite_back" class="mb_header_left" style="display:none;width:64px;background:url('<?php echo $TEMPLATE_URL;?>/images/fun_right_back2.png') no-repeat;height:32px;background-position-y: 12px;"></div>
	<div class="mb_header_center" onclick="_close_pop_all()">
		<a><img class="mb_header_title" src="<?php echo $TEMPLATE_URL; ?>/images/title.png"/></a>
	</div>
</div>

<div id="main" class="mb_content" data-role="content" data-theme="m">