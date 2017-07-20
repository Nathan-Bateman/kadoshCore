<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hume_scores
 */

get_header(); ?>
<?php
		while ( have_posts() ) : the_post(); ?>
				<header class="page-header-sermon">
			<?php
				//the_archive_title( '<h1 class="page-title">', '</h1>' );
				echo '<h1 class="page-title">';
				echo get_the_title();
				echo '</h1>';
				//the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header>
	<div id="primary" class="content-area container-fluid single-sermon">
		<main id="main" class="site-main" role="main">

		<?php
		//while ( have_posts() ) : the_post();

			// get_template_part( 'template-parts/content-sermon', get_post_format() );
		get_template_part( 'template-parts/content-sermon');

			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
