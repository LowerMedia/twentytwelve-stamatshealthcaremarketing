<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	
			<?php if(!is_front_page()) : ?>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			<?php endif; ?>
		<footer id="colophon" role="contentinfo" class="footer">
			<div class="site-info">
				<h4>Stamats Health Care Marketing &copy;<?php echo date("Y"); ?></h4>
				<?php wp_nav_menu( array( 'theme_location' => 'footer-social-menu' ) ); ?>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #main .wrapper -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>