<?php
/**
 * The template for displaying posts in the Chat post format.
 *
 * @package WordPress
 * @subpackage mathbox_mobile
 * 
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content" id="ad_image_<?php the_ID(); ?>">
		<?php the_content(); ?>
	</div>
<?php $_favorite = $_GET['favorite']; ?>
<?php if ('true' != $_favorite) : ?>
	<?php include "popfuns.php"; ?>
<?php endif; ?>
</article>
