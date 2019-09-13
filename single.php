<?php
/**
 * The template for displaying the single.
 *
 */
?>

<?php get_header(); ?>
	<main id="main" class="site-main col-md-8" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/content', 'single' ); ?>
		<?php endwhile; // End of the loop. ?>
	</main><!-- #main -->
	<?php get_sidebar(); ?>
		<div class="ya-re-hed">
			<!-- Yandex.RT -->				
		</div>
<?php get_footer(); ?>
