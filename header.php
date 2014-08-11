<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
		<hgroup>
			<div class='header-img-wrap'>
				


		<?php /*ABOUT PAGE*/ 
		 if( is_page( 35 ) ) : ?>
			<img src="<?php echo esc_url('http://stamatshealthcaremarketing.petelower.com/wp-content/uploads/2014/08/cropped-squarelogo-gold.png');?>" id="header-image" class="header-image" />
		<?php endif; ?>
		<?php /*ABOUT PAGE*/ 
		 if( is_page( 36 ) ) : ?>
			<img src="<?php echo esc_url('http://stamatshealthcaremarketing.petelower.com/wp-content/uploads/2014/08/squarelogo-salmon.png');?>" id="header-image" class="header-image" />
		<?php endif; ?>
		<?php /*ABOUT PAGE*/ 
		 if( is_page( 37 ) ) : ?>
			<img src="<?php echo esc_url('http://stamatshealthcaremarketing.petelower.com/wp-content/uploads/2014/08/squarelogo-pink.png');?>" id="header-image" class="header-image" />
		<?php endif; ?>
		<?php /*ABOUT PAGE*/ 
		 if( is_page( 38 ) ) : ?>
			<img src="<?php echo esc_url('http://stamatshealthcaremarketing.petelower.com/wp-content/uploads/2014/08/squarelogo-peach.png');?>" id="header-image" class="header-image" />
		<?php endif; ?>
		<?php /*ABOUT PAGE*/ 
		 if( is_home() ) : ?>
			<img src="<?php echo esc_url('http://stamatshealthcaremarketing.petelower.com/wp-content/uploads/2014/08/squarelogo-blue.png');?>" id="header-image" class="header-image" />
		<?php endif; ?>


			</div>
			<h1 class="site-title hide-me"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		</hgroup>
	</header><!-- #masthead -->

	<?php if(is_front_page()) : ?>
		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
	<?php endif; ?>

	<nav id="site-navigation" class="main-navigation" role="navigation">
		<h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
		<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
	</nav><!-- #site-navigation -->

	<div id="main" class="wrapper">