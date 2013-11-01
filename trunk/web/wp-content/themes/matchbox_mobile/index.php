<?php
	get_header(); 
?>

<?php 
	$_pushscripts = '';  // 保持代码块
	$_postcount = 0;     // 保存Post数量
	$_lasttime = NULL;
	$_postdates = array();
?>
	<!--
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		-->
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); /*LOOP*/ ?>		
				<?php 
					$_pushscripts .= "my_array.push('" . $post->ID . "');"; 
					$_pushscripts .= "my_array_title.push('" . $post->post_title . "');"; 
					if ($_postcount == 0):
						$_lasttime = $post->post_date;
					endif;
					$_strdate = date('Ymd', $post->post_date);
					$_postdates[$_strdate] = $_strdate;
					$_postscount++;
					if (count($_postdates) >= 10):
						break;
					endif;
				?>
			<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
		
		
		<style>
			.doc_content {
				background-color:#FFFFFF;
			}
		</style>
			<div id="mySwipe" class="swiper-container">
	  			<div id="mySwipe-wrap" class="swipe-wrap swipe-wraper">
		  			<?php while ( have_posts() ) : the_post(); /*LOOP*/ ?>
					<div id="mathbox_content_<?php echo $post->ID;?>" class="doc_content swiper-slide">
					<!--
					<b>mathbox_content_<?php echo $post->ID;?></b>
					-->
					</div>
					<?php endwhile; ?>
				</div>
			</div>

			<!--
		</div>
	</div>
	-->


<script type="text/javascript">
	
	var my_array = new Array();
	var my_array_title = new Array();
	var current_post = 0;
	var current_post_id;
	var posts_count = <?php echo $_postscount; ?>;
	var urltemplate = '?p=';
	var myScroll;
	
	var _load_post = function(idx) {
		
		if (myScroll) {
			//myScroll.destroy();
		}
		
		var id = my_array[idx];
		var title = my_array_title[idx];
		current_post_id = id;
		var url = urltemplate + id;
		var content_id = 'mathbox_content_' + id;
		
		var a = '<div style="width:100%;margin:0 auto;text-align:center;"><div id="circular" style="display:inline-block;margin-top:50px;">' 
					+ '<div id="circular_1" class="circular"></div>'
					+ '<div id="circular_2" class="circular"></div>'
					+ '<div id="circular_3" class="circular"></div>'
					+ '<div id="circular_4" class="circular"></div>'
					+ '<div id="circular_5" class="circular"></div>'
					+ '<div id="circular_6" class="circular"></div>'
					+ '<div id="circular_7" class="circular"></div>'
					+ '<div id="circular_8" class="circular"></div>'
					+ '<div class="clearfix"></div>'
				+ '</div></div>';
		//切换特效
		
		if (hashMap.Contains(id)) {
			_resize_height(content_id);
		} else {
			jQuery('#' + content_id).html(jQuery(a));
			//alert('load ' + id);
			jQuery('#' + content_id).load( url + '&single=true', function() {
			  hashMap.Set(id, '');
			  _init_player(id);
			  _resize_height(content_id);
			});
		}

		// 判断是否已经收藏 
		jQuery.get('?wpfpaction=exists&postid=' + id + '&ajax=1', function(data){
		  //alert("Data Loaded: " + data);
		  if ('false' == data) {
		  	jQuery('#link_remove_favorite').hide();
		  	jQuery('#link_add_favorite').show();
		  } else {
		  	jQuery('#link_add_favorite').hide();
		  	jQuery('#link_remove_favorite').show();
		  }
		  jQuery('#favorite_current_post_id').val(id);
		});
		
		// 分享连接
		var shareUrl = '<?php echo esc_url( home_url( '/' ) ); ?>' + url;
		jQuery('#share_weixin').attr('href', 'javascript:alert(shareUrl + "\n微信扫描二维码分享")');
		jQuery('#share_sina').attr('href', 'http://v.t.sina.com.cn/share/share.php?url=' + shareUrl + '&amp;title=' + title);
		jQuery('#share_mail').attr('href', 'mailto:?subject=' + title + '&body=' + shareUrl);

		//myScroll = new iScroll('scroller');
	};

	jQuery(function() {
		/*
		jQuery("#footer_favorite").pinFooter();
		jQuery(window).resize(function() {
		    jQuery("#footer_favorite").pinFooter();
		});
		jQuery("#footer_favorite").hide();
		*/
	 	var elem = document.getElementById('mySwipe');
		if (elem) {
			/*
			window.mySwipe = Swipe(elem, {
			  startSlide: 0,
			  //speed: 400,
			  //auto: 3000,
			  continuous: false,
			  //disableScroll: false,
			  //stopPropagation: false,
			  callback: function(index, elem) {
			  	
			  	_load_post(index);
			  },
			  transitionEnd: function(index, elem) {
			  	//alert(index);
			  }
			});
			*/
			
			 var mySwiper = jQuery('#mySwipe').swiper({
			    //mode : 'vertical', //Switch to vertical mode
			    speed : 500, //Set animation duration to 500ms
			    wrapperClass : 'swipe-wrap',
				slideClass : 'doc_content',
			    onTouchStart : function() {
			      //Do something when you touch the slide
			      //alert('OMG you touch the slide!') 
			    },
			    onSlideChangeEnd : function () {
			    	_load_post(mySwiper.activeIndex);
			    }
			 });

			<?php echo $_pushscripts; ?>
			//alert(my_array);
		}

		jQuery('#mySwipe-wrap').height(jQuery(window).height() - 36);
		_load_post(current_post);
		
		//setup_timeline();
	});

</script>
<?php 
get_footer(); 
?>