<?php
/**
 * Template Name: Sermon Page
 */

get_header();

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		$args = array(
		    'post_type'=> 'sermons',
		    );              

		$the_query = new WP_Query( $args ); 
		echo '<pre>';
		print_r($the_query);
		echo '</pre>';
		if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
		echo "<pre>";
		print_r(the_post());
		echo "</pre>";
			//get_template_part( 'template-parts/content-sermon', get_post_format() );

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

get_sidebar();
get_footer();
endif;