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
			<div id='mySwipe' class='swipe' style="">
	  			<div id='mySwipe-wrap' class='swipe-wrap' style="">
		  			<?php while ( have_posts() ) : the_post(); ?>
					<div id="mathbox_content_<?php echo $post->ID;?>" style="width:100%;">
					<!--
					<b>mathbox_content_<?php echo $post->ID;?></b>
					-->
					</div>
					<?php endwhile; ?>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->


<script type="text/javascript">
	var my_array = new Array();
	var my_array_title = new Array();
	var current_post = 0;
	var current_post_id;
	var posts_count = <?php echo $_postscount; ?>;
	var urltemplate = '?p=';
	
	var _load_post = function(id, title) {
		current_post_id = id;
		var url = urltemplate + id;
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
		var shareUrl = '<?php echo esc_url( home_url( '/' ) ); ?>' + url + '&single=true';
		jQuery('#share_weixin').attr('href', 'javascript:alert(shareUrl + "\n微信扫描二维码分享")');
		jQuery('#share_sina').attr('href', 'http://v.t.sina.com.cn/share/share.php?url=' + shareUrl + '&amp;title=' + title);
		jQuery('#share_mail').attr('href', 'mailto:?subject=' + title + '&body=' + escape(shareUrl));
	};
	
	var _hidefavorite = function() {
		jQuery('#footer_favorite').hide();
	}
		
	jQuery(function() {
		jQuery("#footer_favorite").pinFooter();
		jQuery(window).resize(function() {
		    jQuery("#footer_favorite").pinFooter();
		});
		jQuery("#footer_favorite").hide();
		
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
		  	_load_post(my_array[index], my_array_title[index]);
		  },
		  transitionEnd: function(index, elem) {
		  	//alert('transitionEnd');
		  }
		});

		<?php echo $_pushscripts; ?>
		//alert(my_array);
		/*
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
		*/
		// 打开收藏与分享菜单
		jQuery('#btn_favorite').click(function() {
			jQuery('#footer_favorite').show();	
		});
		// 打开反馈菜单
		jQuery('#btn_feedback').click(function() {
				
		});	
		// 收藏文章
		jQuery('#link_add_favorite').click(function() {
			var post_id	= jQuery('#favorite_current_post_id').val();
			jQuery.get('?wpfpaction=add&postid=' + post_id + '&ajax=1', function(data){
			  alert(data);
			  jQuery('#link_add_favorite').hide();
			  jQuery('#link_remove_favorite').show();
		  	  
			});
		});
		// 取消文章收藏
		jQuery('#link_remove_favorite').click(function() {
			var post_id	= jQuery('#favorite_current_post_id').val();
			jQuery.get('?wpfpaction=remove&postid=' + post_id + '&ajax=1', function(data){
			  alert(data);
			  jQuery('#link_remove_favorite').hide();
		  	  jQuery('#link_add_favorite').show();
			});
		});
		// 打开收藏列表
		jQuery('#link_list_favorite').click(function() {
			jQuery('#favorite_content').load("?wpfpaction=list&ajax=1'", function(){
			  _hidefavorite();
			  jQuery('#favorite_list').css({'display':'block'});
			});
		});
		// 关闭收藏列表
		jQuery('#btn_cancel_list_favorite').click(function() {
			  jQuery('#favorite_list').css({'display':'none'});
		});
			
		_load_post(my_array[current_post], my_array_title[current_post]);
	});

</script>

<?php 
get_footer(); 
?>