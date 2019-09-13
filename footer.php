<?php
/**
 * The template for displaying the footer.
 *
 */
?>
    <?php if ( get_option( 'show_on_front' ) == 'posts' || !is_front_page() ) : ?>
	    <div class="clearfix"></div>
		</div><!-- /row -->                
		    </div><!-- /#container -->
    <?php endif; ?>
	<?php 
		$restau_lite_bottom_image = wp_get_attachment_image_src( absint( get_theme_mod( 'restau_lite_bottom_image' ) ), 'full' );
		$restau_lite_bottom_image = $restau_lite_bottom_image[0];
		if ( empty( $restau_lite_bottom_image ) ) {
		    $restau_lite_bottom_image = get_template_directory_uri() . '/images/footer_bck.jpg';
			}
	?>
	<div class="bottom-image" style="background-image: url(<?php echo esc_url( $restau_lite_bottom_image ); ?>);"></div>
	</div><!-- /.main-wrapper -->
	    <div class="sub-footer">
		<div class="container">
		    <div class="row">
			<div class="col-md-5">
			    <p><?php esc_html_e( '&copy;'); echo ' ' . date_i18n( esc_html__( 'Y') ) . ' ' . get_bloginfo( 'name' );  ?>.</p>
						 <div class="foot_policy"><p>&#8195;<a href="/privacy-policy/">Политика конфендациальности</a></p></div>
			</div>
			<div class="col-md-7">
			    <?php get_template_part( '/template-parts/social-menu', 'footer' ); ?>
			</div>
		    </div><!-- .row -->
		</div><!-- .container -->
	    </div><!-- .sub-footer -->
	<?php wp_footer();?>
</body>
</html>
