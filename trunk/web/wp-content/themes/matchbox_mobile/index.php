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

<div class="preloader">
	<div class='loading'>
	    <span></span>
	    <span></span>
	    <span></span>
	    <span></span>
	</div>
	<div>Loading...</div>
</div>
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
		
		if (hashMap.Contains(url)) {
			_resize_height(content_id);
		} else {
			jQuery('#' + content_id).html(jQuery(a));
			//alert('load ' + id);
			jQuery('#' + content_id).load( url + '&single=true', function() {
			  hashMap.Set(url, '');
			  _init_player(id);
			  
			 jQuery('#ad_image_' + id).toggle(
			     function () {
			        jQuery('#mb_ad_link_' + id).show();
			     },
			     function () {
			        jQuery('#mb_ad_link_' + id).hide();
			     }
			 ).bind(_clickEventName);
			 
			 jQuery('#mb_ad_link_' + id).bind(_clickEventName, function(event) {
			 	event.stopPropagation();
			 });

			  _resize_height(content_id);
			});
		}

		// 判断是否已经收藏 
		jQuery.get('?matchboxfp=exists&postid=' + id + '&ajax=1&user=' + _user_token(), function(data){
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
	};

	jQuery(function() {
	 	var elem = document.getElementById('mySwipe');
		if (elem) {
			 holdPosition = 0;
			 var mySwiper = jQuery('#mySwipe').swiper({
			    speed : 500, 
			    wrapperClass : 'swipe-wrap',
				slideClass : 'doc_content',
			//	useCSS3Transforms : false,
			//	calculateHeight: true,
				watchActiveIndex: true,
			    onTouchStart: function() {
			      holdPosition = 0;
			    },
			    onResistanceBefore: function(s, pos){
			      holdPosition = pos;
			    },
			    onTouchEnd: function(){
			      if (holdPosition>80) {
			        mySwiper.setWrapperTranslate(80,0,0);
			        mySwiper.params.onlyExternal = true;
			        jQuery('.preloader').addClass('visible');
			        loadNewSlides();
			      }
			    },
			    onSlideChangeEnd : function () {
			    	_load_post(mySwiper.activeIndex);
			    }
			 });
			 
			 function loadNewSlides() {
				jQuery.getJSON( '?matchbox=last&last=' + my_array[0], function() {
					console.log( "call success" );
				}).done(function(data) {
					console.log( "callback success" );
					console.log( data.last + ' ' + data.update + ' ' + data.list.length);
					if ('true' == data.update) {
						for (i=data.list.length-1; i >=0; i--) {
							post = data.list[i];
							my_array.unshift(post.id);
							my_array_title.unshift(post.title);
							var newSlide = mySwiper.createSlide('<div id="mathbox_content_' + post.id + '" class="doc_content swiper-slide"></div>');
							newSlide.prepend(); 
							_load_post(0);
						}
					}
					
				}).fail(function() {
					console.log( "loadNewSlides error" );
				}).always(function() {
					mySwiper.setWrapperTranslate(0,0,0);
			      	mySwiper.params.onlyExternal = false;
			      	mySwiper.updateActiveSlide(0);
			      	jQuery('.preloader').removeClass('visible');
				});
			  }

			<?php echo $_pushscripts; ?>
		}

		jQuery('#mySwipe-wrap').height(jQuery(window).height() - 38);
		_load_post(current_post);

	});

</script>
<?php 
get_footer(); 
?>