<?php
	get_header(); 
?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/scrollbar.css" />
<script type="application/javascript" src="<?php echo get_template_directory_uri(); ?>/js/iscroll.js?v4"></script>
<style>
#scroller {
	position:relative;
/*	-webkit-touch-callout:none;*/
	-webkit-tap-highlight-color:rgba(0,0,0,0);

	float:left;
	width:100%;
	padding:0;
}

#scroller ul {
	position:relative;
	list-style:none;
	padding:0;
	margin:0;
	width:100%;
	text-align:left;
}

#scroller li {
	padding:0 10px;
	height:40px;
	line-height:40px;
	border-bottom:1px solid #ccc;
	border-top:1px solid #fff;
	background-color:#fafafa;
	font-size:14px;
}

#scroller li > a {
	display:block;
}
	
</style>
<div id="wrapper">
	<div id="scroller">
		<ul id="thelist">
<?php	  	
	global $wpdb;
    $query  = "select ID, post_title, post_date, post_status ";
    $query .= "from $wpdb->posts ";
    $query .= "where post_status in ('publish', 'inherit') and post_type = 'post' ";
	$query .= "order by id desc ";
    $results = $wpdb->get_results($query);
    if ($results) {
        foreach ($results as $o):
            $p = get_post($o->ID);
            echo '<li><a href="'. esc_url( home_url( '/' ) ) . '?p=' . $o->ID . '">' . $p->post_title . '</a></li>';
        endforeach;
    }
?>

		</ul>
	</div>
</div>
	  			
</div>

<script type="text/javascript">
	var _show_favorite = function(kind) {
		
	}
	jQuery(function(){	
		myScroll = new iScroll('wrapper');	
	});
	

</script>

<?php 
get_footer(); 
?>