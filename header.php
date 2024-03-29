<?php
/**
 * The template for displaying the header.
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
			<meta charset="<?php bloginfo( 'charset' ); ?>">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="profile" href="http://gmpg.org/xfn/11">
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
			<meta name="yandex-verification" content="***************" />
			<meta name="google-site-verification" content="**********************" />
        <!-- WP_Head -->
        <?php wp_head(); ?>
        <!-- End WP_Head -->
			<script src="https://code.jquery.com/jquery-latest.min.js"></script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
			<script async src="https://www.googletagmanager.com/gtag/js?id=UA-*****************"></script>
			<script>
				window.dataLayer = window.dataLayer || [];
				function gtag(){dataLayer.push(arguments);}
				gtag('js', new Date());
				gtag('config', 'UA-******************');
			</script>
		<!---captcha--->
			<script src='https://www.google.com/recaptcha/api.js'></script>  
		<!---adsbygoogle--->
			<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<script>
			  (adsbygoogle = window.adsbygoogle || []).push({
				google_ad_client: "ca-pub-**********************",
				enable_page_level_ads: true
			  });
			</script>
    </head>
	<body <?php body_class(); ?>>
    <?php
		$header_image = 'style="background-image: url(' . get_template_directory_uri() . '/images/background.jpg' . ');"';
			if ( get_header_image() ){
				$header_image = 'style="background-image: url(' . esc_url( get_header_image() ) . ');"';
			}
    ?>
    <div class="top-page-container with-image" <?php echo $header_image; ?>>
	   <header id="header" class="site-header" role="banner">
            <div class="container">
        	   <div class="row">
            		<div class="logo_container col-md-4 col-md-push-4 col-sm-12 col-xs-12">
                        <?php
                        $logo = '<a href="' . esc_url( home_url( '/' ) ) . '"rel="home" class="ql_logo">' . get_bloginfo( 'name' ) . '</a>';
                            if ( has_custom_logo() ) {
                                $logo = get_custom_logo();
                            }
                        ?>
                        <?php if ( is_front_page() && is_home() ) : ?>
    						<h1 class="site-title"><?php echo $logo; ?></h1>							
                        <?php else : ?> 
                            <a href="/"><h1 class="site-title">Служба заказов</br><p class="ya">ЯЕду</p></h1></a>
    					<?php endif; ?>
                    </div><!-- /logo_container -->                   
                    <div class="col-md-4 col-md-pull-4 col-sm-6">
                        <?php get_template_part( '/template-parts/social-menu', 'header' ); ?>
                    </div><!-- /col-md-4 -->
                    <div class="col-md-4 col-right col-sm-6">
                    	<div class="collapse navbar-collapse" id="ql_nav_collapse">
                            <nav id="jqueryslidemenu" class="jqueryslidemenu navbar " role="navigation">
                                <?php
                                if ( is_front_page() ) {
                                    $menu_id = 'front-page';
                                }else{
                                    $menu_id = 'primary';
                                }
                                wp_nav_menu( array(                     
                                    'theme_location'  => $menu_id,
                                    'menu_id' => 'primary-menu',
                                    'depth'             => 3,
                                    'menu_class'        => 'nav',
                                    'fallback_cb'       => 'restau_lite_bootstrap_navwalker::fallback',
                                    'walker'            => new restau_lite_bootstrap_navwalker()
                                ));
                                ?>
                            </nav>
                        </div><!-- /ql_nav_collapse -->
                    </div><!-- /col-md-4 -->
                    <div class="clearfix"></div>
            	</div><!-- row-->
            </div><!-- /container -->
		</header>
        <?php if ( get_option( 'show_on_front' ) != 'posts' && is_front_page() ) : ?>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php
						$welcome_image = wp_get_attachment_image_src( absint( get_theme_mod( 'restau_lite_welcome_image' ) ), 'full' );
						$welcome_image = $welcome_image[0];
						if ( empty( $welcome_image ) ) {
							$welcome_image = get_template_directory_uri() . '/images/welcome.jpg';
						}
						?>
						<div class="welcome-image" style="background-image: url(<?php echo esc_url( $welcome_image ); ?>)">
							<?php
							$restau_lite_welcome_logo_image = wp_get_attachment_image( absint( get_theme_mod( 'restau_lite_welcome_logo_image' ) ), 'full' );
							?>
							<span class="logo-big">
							<?php echo form();?>                                                    
							</span><!--вывод формы заказов-->
						</div><!-- /welcome-image -->
					</div>
				</div><!-- /row -->
			</div><!-- /container -->
        <?php endif; ?>
    </div><!-- /top-page-container -->
	<div class="clearfix"></div>
    <div class="main-wrapper">   
        <?php if ( get_option( 'show_on_front' ) == 'posts' || !is_front_page() ) : ?>
        <div id="container" class="container">
            <div class="row">
        <?php endif; ?>