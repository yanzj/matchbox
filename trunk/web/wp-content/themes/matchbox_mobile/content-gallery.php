<?php
/**
 * The template for displaying posts in the Gallery post format.
 *
 * @package WordPress
 * @subpackage matchbox_mobile
 * 
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php if ( is_single() || ! get_post_gallery() ) : ?>
			<?php the_content(); ?>
		<?php else : ?>
			<?php echo get_post_gallery(); ?>
		<?php endif; ?>
	</div>
	
<?php $_favorite = $_GET['favorite']; ?>
<?php if ('true' != $_favorite) : ?>
	<?php include "popfuns.php"; ?>
<?php endif; ?>

</article>