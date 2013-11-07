<?php
/**
 * The template for displaying posts in the Image post format.
 *
 * @package WordPress
 * @subpackage matchbox_mobile
 * 
 */
?>
<div style="overflow-x: hidden"></div>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	
<?php $_favorite = $_GET['favorite']; ?>
<?php if ('true' != $_favorite) : ?>
	<?php include "popfuns.php"; ?>
<?php endif; ?>
	
</article>
<div id="height_<?php the_ID(); ?>" style="overflow-x: hidden"></div>