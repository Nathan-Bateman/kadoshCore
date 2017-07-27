<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hume_scores
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class='row'>
			<div class='col-md-12 wrapper-footer'>
				<div class="copyright">
				<i class="fa fa-copyright" aria-hidden="true"></i><span><?php echo get_theme_mod('entity_name'); ?></span>
				</div>
				<div class="site-info">
					<a href="<?php echo esc_url( __( 'http://nathan-bateman.github.io/', 'hume' ) ); ?>"><?php printf( esc_html__( 'Assembled by %s', 'hume' ), 'Kadosh Web Solutions' ); ?></a>
				</div>
			</div>
			
	</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
