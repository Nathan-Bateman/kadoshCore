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
			$video = get_field('video_audio');
			// use preg_match to find iframe src
			preg_match('/src="(.+?)"/', $video, $matches);
			$src = $matches[1];
			// add extra params to iframe src
			$params = array(
				'rel'		=> 0,
			    'controls'    => 1,
			    'hd'        => 1,
			    'autohide'    => 1
			);

			$new_src = add_query_arg($params, $src);

			$video = str_replace($src, $new_src, $video);
			$video_url = get_field('video_audio', false, false);
			$audio = get_field('audio_file_for_download');
			$audio_path_info = pathinfo($audio,PATHINFO_EXTENSION);
			$notes = get_field('notes');
			$description = get_the_excerpt(get_the_ID());
			$speaker = get_the_terms(get_the_ID(),'speaker');
			$series = get_the_terms(get_the_ID(),'series');
			$speaker_name = $speaker[0]->name;
			$speaker_url = $speaker[0]->slug;
			$series_name = $series[0]->name;
			$series_url = $series[0]->slug;
			$facebook_share = 'https://www.facebook.com/sharer/sharer.php?u='.$video_url;
			$linkedin_share = 'https://www.linkedin.com/shareArticle?mini=true&url='.$video_url;
			$google_plus_share = 'https://plus.google.com/share?url='.$video_url;
			$twitter_share = 'https://twitter.com/share?url='.$video_url;
			$email_share = 'mailto:?to=&subject='.get_the_title().'&body='.$video_url;



			

		
		if ( is_single() ) :
			//the_title( '<h1 class="entry-title">', '</h1>' );

		else :
	
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
	<div class="entry-content sermon-entry-content"> 
		<div class='row'>
			<div class='col-md-12'>
				<div class='sermon-content-wrapper'>
					<?php 
						if (is_single()) { 
						?>
							<div class="video-sermon-single">
								<?php 
									set_post_format(get_the_ID(),'video');
									echo $video;
								?>
							</div>
							</div><!-- col-12-close -->
							</div><!-- row -->
							</div>
							<div class='row'>
								<div class='col-md-8'>
									<h2><?php echo get_the_title();  ?></h2>
									<div class='inline-social'>
										<!--<div class="social-wrap">
											<i class="fa fa-share fa-2x reveal-share-sermon" aria-hidden="true"></i>
										</div>-->
										<div class='social-share-buttons'>
									  		<ul class='sermon-share hide-share-sermon'>
										  		<a href="<?php echo $facebook_share;  ?>">
										  			<li><span class="fa-stack fa-lg">   <i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i> </span></li>
										  		</a>
										  		<a href="<?php echo $linkedin_share;  ?>">
										  			<li><span class="fa-stack fa-lg">   <i class="fa fa-circle fa-stack-2x"></i>   <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i> </span></li>
										  		</a>
										  		<a href="<?php echo $twitter_share;  ?>">
										  			<li><span class="fa-stack fa-lg">   <i class="fa fa-circle fa-stack-2x"></i>   <i class="fa fa-twitter fa-stack-1x fa-inverse"></i> </span></li>
										  		</a>
										  		<a href="<?php echo $google_plus_share;  ?>">
										  			<li><span class="fa-stack fa-lg">   <i class="fa fa-circle fa-stack-2x"></i>   <i class="fa fa-google fa-stack-1x fa-inverse"></i> </span></li>
										  		</a>
										  		<a href="<?php echo $email_share;  ?>">
										  			<li><span class="fa-stack fa-lg">   <i class="fa fa-circle fa-stack-2x"></i>   <i class="fa fa-paper-plane fa-stack-1x fa-inverse"></i> </span></li>
										  		</a>
										  	</ul>
									  	</div>
									  </div>
									<hr>
									<p><span>Description: </span><?php echo $description; ?></p>

								</div>
								<div class='col-md-4'>
									<h3>More</h3>
									
									<ul>
										<li><a href="<?php echo get_site_url().'/sermon/?speaker='.$speaker_url.'">'.'Speaker - '.$speaker_name.'</a>' ?></li>
										<?php if ($series_name) {?>
											<li><a href="<?php echo get_site_url().'/sermon/?series='.$series_url.'">'.'Series - '.$series_name.'</a>' ?></li>
										<?php } ?>
										<li><a href=<?php echo(get_site_url().'/sermon') ?>>All Sermons</a></li>
									</ul>
								</div>

							</div>
					<?php } else {	?>
						<div class='archive-wrapper'>
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
							    echo '<h5>'.$speaker_name.'</h5>';
							    echo '<h5>'.sermon_post_date().'</h5>';
							    // print_r($video);
						    ?>
						  </div>
						</div>
						<div class='sermon-share-download'>
							<div class="social-wrap">
								<i class="fa fa-share fa-2x reveal-share-sermon" aria-hidden="true"></i>
							</div>
							<div class='notes-wrap'>
								<a href="<?php echo $notes ?>"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></a>
							</div>
							<div class='download-wrap'>
								<?php 
								//print_r($extension);
									if (isset($audio_path_info) && $audio_path_info === 'mp3') {
										echo '<a href="'.$audio.'" download><i class="fa fa-download fa-2x"></i></a>';
									} else {
										echo '<i style="opacity:0.2" class="fa fa-download fa-2x"></i>';
									}
								?>
							</div>
						  </div>
							  <div class='social-share-buttons'>
							  		<ul class='sermon-share hide-share-sermon'>
								  		<a href="<?php echo $facebook_share;  ?>">
								  			<li><span class="fa-stack fa-lg">   <i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i> </span></li>
								  		</a>
								  		<a href="<?php echo $linkedin_share;  ?>">
								  			<li><span class="fa-stack fa-lg">   <i class="fa fa-circle fa-stack-2x"></i>   <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i> </span></li>
								  		</a>
								  		<a href="<?php echo $twitter_share;  ?>">
								  			<li><span class="fa-stack fa-lg">   <i class="fa fa-circle fa-stack-2x"></i>   <i class="fa fa-twitter fa-stack-1x fa-inverse"></i> </span></li>
								  		</a>
								  		<a href="<?php echo $google_plus_share;  ?>">
								  			<li><span class="fa-stack fa-lg">   <i class="fa fa-circle fa-stack-2x"></i>   <i class="fa fa-google fa-stack-1x fa-inverse"></i> </span></li>
								  		</a>
								  		<a href="<?php echo $email_share;  ?>">
								  			<li><span class="fa-stack fa-lg">   <i class="fa fa-circle fa-stack-2x"></i>   <i class="fa fa-paper-plane fa-stack-1x fa-inverse"></i> </span></li>
								  		</a>
								  	</ul>
								  </div>
								</div>
								</div><!-- col-12-close -->
							</div><!-- row -->
					  <?php } ?>
				</div>
	 
		
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php hume_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->