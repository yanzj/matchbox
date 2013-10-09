<?php
	get_header(); 
?>

<?php 
	$_pushscripts = '';  // 保持代码块
	$_postcount = 0;    // 保存Post数量
	$_lasttime = NULL;
	$_postdates = array();
?>
	<div id="primary" class="content-area">
		
		<div id="content" class="site-content" role="main">
		<?php if ( have_posts() ) : ?>
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>		
				<?php 
					// 循环中构建  Array.push(obj) javascript 代码块
					$_pushscripts .= "my_array.push('" . $post->ID . "');"; 
					
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
			<div id='mySwipe' class='swipe' style="">
	  			<div id='mySwipe-wrap' class='swipe-wrap' style="">
		  			<?php while ( have_posts() ) : the_post(); ?>
					<div id="mathbox_content_<?php echo $post->ID;?>" style="width:100%;">
					<b>mathbox_content_<?php echo $post->ID;?></b>
					</div>
					<?php endwhile; ?>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->


<script type="text/javascript">
	var my_array = new Array();
	var current_post = 0;
	var posts_count = <?php echo $_postscount; ?>;
	var urltemplate = '?p=';
	
	var _load_post = function(id) {
		url = urltemplate + id;
		//alert(url);
		// jQuery('#d_content').load( url, function() {
		  // //alert( "Load was performed." );
		  // scroll(0,0); // 返回顶部
		// });
		content_id = 'mathbox_content_' + id;
		jQuery('#' + content_id).load( url, function() {
		  //alert( "Load was performed." );
		  scroll(0,0); // 返回顶部
		  //jQuery('#mySwipe-wrap').css('height', jQuery('#' + content_id).css('height'));
		});
	};
		
	jQuery(function() {
	 	var elem = document.getElementById('mySwipe');
		// window.mySwipe = Swipe(elem, {});
		
		window.mySwipe = Swipe(elem, {
		  startSlide: 0,
		  //speed: 400,
		  //auto: 3000,
		  continuous: false,
		  //disableScroll: false,
		  //stopPropagation: false,
		  callback: function(index, elem) {
		  	//alert('callback');
		  	_load_post(my_array[index]);
		  },
		  transitionEnd: function(index, elem) {
		  	//alert('transitionEnd');
		  }
		});

		<?php echo $_pushscripts; ?>
		//alert(my_array);
		
		jQuery('#btn_prev').click(function() {
			// alert('btn perv click');
			if (current_post > 0) {
				current_post = current_post - 1;
				_load_post(my_array[current_post]);
			}
		});
		jQuery('#btn_next').click(function() {
			//alert('btn next click');
			if (current_post < posts_count - 1) {
				current_post = current_post + 1;
				_load_post(my_array[current_post]);
			}
		});
		
		_load_post(my_array[current_post]);
	});

</script>

<?php 
get_footer(); 
?>