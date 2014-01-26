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
<body screen_capture_injected="true" <?php body_class(); ?> style="margin-top:36px;margin-bottom:2px;">
<div id="masthead" class="mb_header">
	<div id="mb_header_left" class="mb_header_left" style="width:64px;background:url('<?php echo $TEMPLATE_URL;?>/images/fun_left.png') no-repeat;background-size: 18px auto;height:32px;background-position-y:16px;"></div>
	<div id="mb_header_right" class="mb_header_right" style="width:64px;background:url('<?php echo $TEMPLATE_URL;?>/images/fun_right.png') no-repeat;background-size: 18px auto;background-position-x: right;background-position-y: 6px;"></div>
	<div id="mb_header_back" class="mb_header_right" style="display:none;width:64px;background:url('<?php echo $TEMPLATE_URL;?>/images/fun_right_back.png') no-repeat;background-size: 16px auto;background-position: 100% 8px;"></div>
	<div id="mb_header_favorite_back" class="mb_header_left" style="display:none;width:64px;background:url('<?php echo $TEMPLATE_URL;?>/images/fun_right_back2.png') no-repeat;height:32px;background-position-y: 11px;"></div>
	<div class="mb_header_center" onclick="_close_pop_all()">
		<a><img class="mb_header_title" src="<?php echo $TEMPLATE_URL; ?>/images/title.png"/></a>
	</div>
</div>

<div id="main" class="mb_content" data-role="content" data-theme="m">