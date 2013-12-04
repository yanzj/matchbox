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
    Loading...
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

<?php 
get_footer(); 
?>