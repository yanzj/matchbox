<?php
/*
Plugin Name: bShare 分享
Plugin URI: http://www.bshare.cn/wordpressRegister
Description: 数以万计的分享，源自一个简单的按钮， <a href="http://www.bshare.cn/">bShare 分享</a> 是一个强大的网页分享插件工具，您的读者可以将您网站上精采的内容快速分享、转贴到社群网络上。<a href="options-general.php?page=bookmark-share.php">点击这里进行配置</a>。
Version: 4.2.0
Author: Buzzinate, Denis
Author URI: http://www.bshare.cn
*/

load_plugin_textdomain('bshare');
if (get_option("bshare_code") == "") {
    update_option("bshare_code", '<a class="bshareDiv" target="_blank" href="http://www.bshare.cn/share">分享&收藏</a><script language="javascript" type="text/javascript" src="http://www.bshare.cn/button.js"></script>'); 
}
if (get_option("bshare_pos") == "") {
    update_option("bshare_pos", "down");
}

add_filter('the_content', 'bshare');
function bshare($content){
    if(is_single() || (is_page() && get_option("bshare_inPage") != "false")) {
        if (get_option("bshare_pos") == "up") {
            $content = '<div style="margin-bottom:10px">'.htmlspecialchars_decode(get_option("bshare_code")).'</div>'.$content;
        } else {
            $content = $content.'<div style="margin-bottom:10px">'.htmlspecialchars_decode(get_option("bshare_code")).'</div>';
        }
    } else if(is_feed() && get_option("bshare_inFeed") != "false") {
        global $post;
        $bshare_feed_code = '<p><a href="http://www.bshare.cn/share?url='.urlencode(get_permalink($post->ID)).'&title='.urlencode($post->post_title).'" title="用bShare分享或收藏本文"><img src="http://static.bshare.cn/frame/images/button_custom1-zh.gif" alt="用bShare分享或收藏本文" /></a></p>';
        $content = $content.$bshare_feed_code;
    }
    return $content;
}

add_action('plugins_loaded', 'widget_sidebar_bshare');
function widget_sidebar_bshare() {
    function widget_bshare($args) {
        if(is_single()||is_page()) return;
        extract($args);
        echo $before_widget;
        echo $before_title . __('bShare分享', 'bshare') . $after_title;
	    echo '<div style="margin:10px 0">';
	    echo htmlspecialchars_decode(get_option("bshare_code")) . '</div>';
        echo $after_widget;
    }
    register_sidebar_widget(__('bShare分享', 'bshare'), 'widget_bshare');
}

add_action('admin_menu', 'bshare_menu');
function bshare_menu() {
    add_options_page(__('bShare选项', 'bshare'), __('bShare分享', 'bshare'), 8, basename(__FILE__), 'bshare_options');
}
function bshare_options() {
    if (isset($_POST['bshare_code'])) {
        $code = stripslashes_deep($_POST['bshare_code']);
        update_option("bshare_code", htmlspecialchars($code));
    }
    
    if ($_POST['bshare_infeed'] != "true") {
        update_option("bshare_infeed", "false");
    } else {
        update_option("bshare_infeed", "true");
    }

    if ($_POST['bshare_inpage'] != "true") {
        update_option("bshare_inpage", "false");
    } else {
        update_option("bshare_inpage", "true");
    }

    if (isset($_POST['bshare_pos'])) {
        update_option("bshare_pos", $_POST['bshare_pos']);
    }

    echo '<div class="wrap">';
    echo '<form name="bshare_form" method="post" action="">';
    echo '<p>请将您在bshare.cn获取的嵌入代码复制至此处：</p>';
    echo '<p><textarea style="height:100px;width:600px" name="bshare_code">'.get_option("bshare_code").'</textarea></p>';
    echo '<p><input type="checkbox" name="bshare_infeed" value="true" ' . getChecked(get_option("bshare_infeed")) . '></input>&nbsp在Feed中加入bShare</p>';
    echo '<p><input type="checkbox" name="bshare_inpage" value="true" ' . getChecked(get_option("bshare_inpage")) . '></input>&nbsp在非博客页面加入bShare</p>';
    echo '<p>bShare按钮显示位置（对非浮动式按钮有效）：<br/><input type="radio" name="bshare_pos" value="up" ' . getRadioChecked(get_option("bshare_pos"), 'up') . '>&nbsp文章上方<br/><input type="radio" name="bshare_pos" value="down" ' . getRadioChecked(get_option("bshare_pos"), 'down') . '>&nbsp文章下方</p>';
    
    echo '<p class="submit"><input type="submit" value="submit"/></p>';
    echo '</form>';
    echo '</div>';
}

function getChecked($val) {
    if ($val == "false") {
        return '';
    } else {
        return 'checked="checked"';
    }
}
function getRadioChecked($val, $cur) {
    if ($val == $cur) {
        return 'checked="checked"';
    } else {
        return '';
    }
}

?>
