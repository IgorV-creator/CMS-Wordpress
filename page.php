<?php
/**
 * The template for displaying all pages.
 *
 */
	get_header(); ?>

	<main id="main" class="site-main col-md-8" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			<div class="ya-re-peg">
				<!-- Yandex.RTB-->
			</div>                	

			<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>
				<div class="ya-re-peg">
					<!-- Yandex.RTB R-A-409228-2 -->
					
				</div>  
		<?php endwhile; // End of the loop. ?>

	</main><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
