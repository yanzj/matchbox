<?php
/*
Plugin Name: Matchbox Extensible Plugin
Plugin URI: 
Description: 
Version: 0.0.1
Author: Wolfyan
Author URI: 
*/

/*
    Copyright (c) 2013 Matchbox 
*/

function matchbox_favorite_posts() {
    if (isset($_REQUEST['matchboxfp'])):
		
		$action_name = $_REQUEST['matchboxfp'];
		error_log('call matchbox_favorite_posts and action is : ' . $action_name);
        if ($action_name == 'add') {
            matchbox_add_favorite();
        } else if ($action_name == 'remove') {
            matchbox_remove_favorite();
        } else if ($action_name == 'clear') {
            matchbox_clear_favorite();
        } else if ($action_name == 'exists') {
            matchbox_exists_favorite();
        } else if ($action_name == 'list') {
            matchbox_list_favorite();
        } 
    endif;
}
add_action('template_redirect', 'matchbox_favorite_posts');

function matchbox_add_favorite($post_id = "") {
    $post_id = $_REQUEST['postid'];
	$user_token = $_REQUEST['user'];
	error_log('process matchbox_list_favorite '. $user_token . ':' . $post_id . '');
    if (matchbox_do_add_to_list($user_token, $post_id)) {
	    matchbox_die_or_go('success');
    } else {
        matchbox_die_or_go('failure');
    }
}

function matchbox_remove_favorite() {
	$post_id = $_REQUEST['postid'];
	$user_token = $_REQUEST['user'];
	
	if (matchbox_do_remove_from_list($user_token, $post_id)) {
	    matchbox_die_or_go('success');
    } else {
        matchbox_die_or_go('failure');
    }
}

function matchbox_clear_favorite() {
	$post_id = $_REQUEST['postid'];
	$user_token = $_REQUEST['user'];
	matchbox_die_or_go('success');
}

function matchbox_exists_favorite() {
	$post_id = $_REQUEST['postid'];
	$user_token = $_REQUEST['user'];
	
	global $wpdb;
	$table_name = $wpdb->prefix . "matchbox_favorite";
	$post_list = matchbox_get_post_list($user_token);
	if (substr_count($post_list, ';'. $post_id . ';') > 0) {
		matchbox_die_or_go('true');
	} else {
		matchbox_die_or_go('false');
	}
	
}

function matchbox_list_favorite() {
	$user_token = $_REQUEST['user'];
	error_log('process matchbox_list_favorite '. $user_token . ':' . $post_id . '');
	
	$strHtml = '';
	$collection_post_ids = matchbox_get_post_list($user_token);
	if ($collection_post_ids) {
		error_log(implode(',', $collection_post_ids));
		global $wpdb;
	    $query = "select id from $wpdb->posts where id in (0" . str_replace(';', ',', $collection_post_ids) . "0) ";
	    $results = $wpdb->get_results($query);
	    if ($results) {
	        $strHtml .= '<ul>';
	        foreach ($results as $o):
	            $p = get_post($o->id);
	            $strHtml .= '<li>';
	            $strHtml .= '<a onclick="_show_favorite_page(' . $o->id . ')" title="'. $p->post_title . '">' . $p->post_title . '</a>';
	            $strHtml .= '</li>';
	        endforeach;
	        $strHtml .= '</ul>';
	    }
    }
	matchbox_die_or_go($strHtml);
}

function matchbox_get_post_list($user_token) {
    global $wpdb;
	$table_name = $wpdb->prefix . "matchbox_favorite";
	$postids = $wpdb->get_col( "select post_list from $table_name where user_token='$user_token'" );
	error_log(implode(',',$postids));
	foreach ($postids as $postid) 
    {
        return is_null($postid)? '':$postid;
    }
	
	return NULL;
}

function matchbox_do_add_to_list($user_token, $post_id) {
    global $wpdb;
	$table_name = $wpdb->prefix . "matchbox_favorite";
	$post_list = matchbox_get_post_list($user_token);
	
	error_log('current post list is : ' . $post_list);
	
	if (!is_null($post_list)) {
		$post_list = ($post_list==''?';':$post_list) . $post_id . ';';
		$rows_affected = $wpdb->update( $table_name, array( 'post_list' =>  $post_list ),  array( 'user_token' => $user_token ) );
	} else {
		$rows_affected = $wpdb->insert( $table_name, array( 'user_token' => $user_token, 'post_list' => ';'. $post_id . ';') );
	}
	
	error_log($rows_affected );
	
	if ($rows_affected > 0) {
		return true;
	} else {
		return false;
	}
}

function matchbox_do_remove_from_list($user_token, $post_id) {
    global $wpdb;
	$table_name = $wpdb->prefix . "matchbox_favorite";
	$post_list = matchbox_get_post_list($user_token);
	
	error_log('current post list is : ' . $post_list);
	
	if (!is_null($post_list)) {
		$post_list = str_replace(';' . $post_id . ';', ';', $post_list);
		$rows_affected = $wpdb->update( $table_name, array( 'post_list' =>  $post_list ),  array( 'user_token' => $user_token ) );
	} 
	
	error_log($rows_affected );
	
	if ($rows_affected > 0) {
		return true;
	} else {
		return false;
	}
}

function matchbox_boss_action() {
    if (isset($_REQUEST['matchboxboss'])):
		$action_name = $_REQUEST['matchboxboss'];
        if ($action_name == 'lp') {	// list posts
        	matchbox_list_all_posts();
        } else if ($action_name == 'vp') { // view post
            matchbox_die_or_go($action_name);
        } 
    endif;
}
add_action('template_redirect', 'matchbox_boss_action');


function matchbox_list_all_posts() {
	error_log('matchbox_list_all_posts ');
	$content = include("matchbox-boss-index.php");
	die($content);
	/*
	$strHtml = '';
	global $wpdb;
    $query  = "select ID, post_title, post_date, post_status ";
    $query .= "from $wpdb->posts ";
    $query .= "where post_status in ('publish', 'inherit') and post_type = 'post' ";
	$query .= "order by id desc ";
    $results = $wpdb->get_results($query);
    if ($results) {
        $strHtml .= '<ul>';
        foreach ($results as $o):
            $p = get_post($o->ID);
            $strHtml .= '<li>';
            $strHtml .= '<a href="'. esc_url( home_url( '/' ) ) . '?p=' . $o->ID . '">' . $p->post_title . '</a>';
            $strHtml .= '</li>';
        endforeach;
        $strHtml .= '</ul>';
    }
	matchbox_die_or_go($strHtml);
	*/
}


function matchbox_die_or_go($str) {
	die($str);
}


global $matchbox_db_version;
$matchbox_db_version = "1.0";

function matchbox_install() {
   global $wpdb;
   global $matchbox_db_version;

   $table_name = $wpdb->prefix . "matchbox_favorite";
      
   $sql = "CREATE TABLE $table_name (
	  user_token VARCHAR(64)  NOT NULL,
	  post_list VARCHAR(2000) ,
	  PRIMARY KEY (user_token)
    );";

   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   dbDelta( $sql );
 
   add_option( "matchbox_db_version", $matchbox_db_version );
}

function matchbox_install_data() {
   
}

register_activation_hook( __FILE__, 'matchbox_install' );



