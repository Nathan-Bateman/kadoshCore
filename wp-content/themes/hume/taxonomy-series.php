<?php
/**
 * The template for displaying sermon archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package hume_scores
 */

get_header(); ?>
<?php

	$args = array(
	    'post_type'=> 'sermons',
	    );              

	$the_query = new WP_Query( $args ); 
	if ( have_posts() ) : ?>

		<header class="page-header-sermon">
			<?php
				//the_archive_title( '<h1 class="page-title">', '</h1>' );
				 echo '<h1 class="page-title">';
				//post_type_archive_title();
				the_archive_title();
				 echo '</h1>';
			//the_archive_title( '<h1 class="page-title">', '</h1>' );
				//the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header>

	<div class='container-fluid'>
			<div id="primary" class="content-area">
				
							<main id="main" class="site-main" role="main">
							<!-- <?php
							// $args = array(
							//     'post_type'=> 'sermons',
							//     );              

							// $the_query = new WP_Query( $args ); 
							//if ( have_posts() ) : ?> -->

								<!-- <header class="page-header"> -->
									<!-- <?php
										//the_archive_title( '<h1 class="page-title">', '</h1>' );
										// echo '<h1 class="page-title">';
										// post_type_archive_title();
										// echo '</h1>';
										//the_archive_description( '<div class="archive-description">', '</div>' );
									?> -->
								<!--</header> .page-header -->
							<div class='row'>
								<div class='col-md-8 article-parent'>
									<?php
										/* Start the Loop */
										while ( have_posts() ) : the_post();

											/*
											 * Include the Post-Format-specific template for the content.
											 * If you want to override this in a child theme, then include a file
											 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
											 */

											// get_template_part( 'template-parts/content-sermon', get_post_format() );
											get_template_part( 'template-parts/content-sermon');
										endwhile;

										// the_posts_navigation();

									else :

										get_template_part( 'template-parts/content-sermon', 'none' );

									endif; ?>
								</div>
								
								<div class='col-md-4'>
									<?php
										get_sidebar();
									?>
								</div>
							</div>
							</main><!-- #main -->		
			<?php get_contact_prayer_section(); ?>
		</div><!-- #primary -->
	
<?php
the_posts_navigation();

get_footer();
?>
</div>
