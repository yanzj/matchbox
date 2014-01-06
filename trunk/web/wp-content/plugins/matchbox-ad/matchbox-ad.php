<?php
/*
Plugin Name: Matchbox AD Plugin
Plugin URI: 
Description: 
Version: 0.0.1
Author: Wolfyan
Author URI: 
*/

/*
    Copyright (c) 2013 Matchbox 
*/

function matchbox_ad_insert() {
	if (matchbox_ad_if_available() == '1') {
?>
	<div class="md_ad" style="display:none;">' 
		<a href="#" target="_blank"><img src="<?php echo get_site_url();?>/wp-content/ad/main.jpg" style="width:100%;height:100%;" onload="showAD()"/></a>
		<a class="ad_close">关闭</a>
	</div>
<?php
	}
}

add_action('admin_menu', 'matchbox_ad_menu');

function matchbox_ad_menu() {
  add_options_page('广告开关', '广告开关', 'manage_options', 'matchbox_ad', 'matchbox_ad_options');
}

function matchbox_ad_options() {
	$msg = '';
	if (isset($_REQUEST['power'])) {
		echo $_REQUEST['power'];
		if (matchbox_ad_update_available($_REQUEST['power'])) {
			$msg = '修改成功！';
		} else {
			$msg = '修改失败！';
		}
	}
	$available_on = '';
	$available_off = '';
	if (matchbox_ad_if_available()) {
		$available_on  = 'checked="checked"';
	} else {
		$available_off = 'checked="checked"';
	}
?>
  	<div style="width:100%;font-size:120%;">
  		<div style="text-align:center;width:100%;font-size:150%;font-weight: bold;margin-top:40px;">广告开关</div>
  	    <hr style="height:1px;margin-top:20px; margin-bottom:20px;"/>
  		<div style="margin-top: 16px">
  		<div style="text-align:center;width:100%;font-size:110%;font-weight: bold;color:green;"><?php echo $msg; ?></div>
		<div style="margin-top: 16px">
  	    <form action="" method="post" >
  			<div style="text-align:center;width:100%;font-size:120%;font-weight: bold;color:blue;">
		  		<input type="radio" name="power" value="1" <?php echo $available_on; ?>/>开启
		  		<input type="radio" name="power" value="0" <?php echo $available_off; ?>/>关闭
			</div>
			<div style="text-align:center;width:100%;font-size:120%;font-weight: ">
	  			<input type="submit" value="保存" style="width:120px;margin-top: 32px" />
			</div>
  		</form>
  		</div>
	</div>
<?php
}

function matchbox_ad_update_available($available) {
    global $wpdb;
	$table_name = $wpdb->prefix . "matchbox_ad";
	$rows_affected = $wpdb->query( "update $table_name set available = $available");
	error_log($rows_affected );
	if ($rows_affected >= 0) {
		return true;
	} else {
		return false;
	}
}

function matchbox_ad_if_available() {
    global $wpdb;
	$table_name = $wpdb->prefix . "matchbox_ad";
	$ads = $wpdb->get_row( "select available, path from $table_name" );
	return $ads -> available;
}

global $matchbox_db_version;
$matchbox_db_version = "1.0";

function matchbox_ad_install() {
   global $wpdb;
   global $matchbox_db_version;

   $table_name = $wpdb->prefix . "matchbox_ad";
   
   $sql = "CREATE TABLE $table_name (
	  available VARCHAR(1)  NOT NULL default '1',
	  path VARCHAR(2000)
    );";
		
   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   dbDelta( $sql );
   $wpdb->insert( $table_name, array( 'available' => '1', 'path' => '' ));
   add_option( "matchbox_db_version", $matchbox_db_version );
}

register_activation_hook( __FILE__, 'matchbox_ad_install' );



