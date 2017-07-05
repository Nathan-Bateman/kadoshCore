<?php
/**
 * Template part for displaying sermon posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package hume_scores
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			// the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			// $id = the_ID();
			// $title = the_title();
			$video = get_field('video_audio');
			$notes = get_field('notes');
			$speaker = get_field('speaker');
			$series = get_field('series');
			$facebook_share = 'https://www.facebook.com/sharer/sharer.php?u='.$video;
			$linkedin_share = 'https://www.linkedin.com/shareArticle?mini=true&url='.$video;
			$google_plus_share = 'https://plus.google.com/share?url='.$video;
			$twitter_share = 'https://twitter.com/share?url='.$video;
			$email_share = 'mailto:?to=&subject='.the_title().'&body='.$video;
			//must get the property of the array called ""
			//$terms = get_the_terms( the_ID(), 'series' );
			
			//$url = $file['type'];

			// print_r($video);
			// echo '<br>';
			// print_r($notes);
			// echo '<br>';
			// print_r($speaker);
			// echo '<br>';
			// print_r($series);
			// echo '<br>';
			// print_r($terms);

			

		endif;

		if ( 'sermons' === get_post_type() ) : ?>

		<div class="entry-meta">
			<?php 
				hume_posted_on(); 


			?>

		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content sermon-entry-content container-fluid"> <!-- bootstrap container -->
		<div class='row'>
			<div class='col-md-12'>
				<div class='sermon-content-wrapper'>
				 <div class="polaroid-sermon-archive">
				 <?php
				 echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
				 if ( has_post_thumbnail() ) { 
		    			the_post_thumbnail( 'sermon-archive-size' ); 
					}
					echo '</a>';
				 ?> 
				 <div class="label-wrapper">
				    <?php 
				    
				    	the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
					    echo '<h5>'.$speaker.'</h5>';
					    echo '<h5>'.sermon_post_date().'</h5>';
				    ?>
				  </div>
				</div>
			<div class='sermon-share-download'>
					<div class="social-wrap">
					  	<ul>
					  		<a href="<?php echo $facebook_share  ?>">
					  			<li><span class="fa-stack fa-lg">   <i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i> </span></li>
					  		</a>
					  		<a href="<?php echo $linkedin_share  ?>">
					  			<li><span class="fa-stack fa-lg">   <i class="fa fa-circle fa-stack-2x"></i>   <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i> </span></li>
					  		</a>
					  		<a href="<?php echo $twitter_share  ?>">
					  			<li><span class="fa-stack fa-lg">   <i class="fa fa-circle fa-stack-2x"></i>   <i class="fa fa-twitter fa-stack-1x fa-inverse"></i> </span></li>
					  		</a>
					  		<a href="<?php echo $google_plus_share  ?>">
					  			<li><span class="fa-stack fa-lg">   <i class="fa fa-circle fa-stack-2x"></i>   <i class="fa fa-google fa-stack-1x fa-inverse"></i> </span></li>
					  		</a>
					  		<a href="<?php echo $email_share  ?>">
					  			<li><span class="fa-stack fa-lg">   <i class="fa fa-circle fa-stack-2x"></i>   <i class="fa fa-paper-plane fa-stack-1x fa-inverse"></i> </span></li>
					  		</a>
					  	</ul>
					</div>
					<div class='download-wrap'>
						<i class="fa fa-download fa-2x"></i>
					</div>
				  </div>
				</div>
			</div><!-- col-12-close -->

		</div><!-- row -->	 
		
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php hume_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->