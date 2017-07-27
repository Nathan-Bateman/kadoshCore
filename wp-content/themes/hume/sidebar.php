<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hume_scores
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php 
	// dynamic_sidebar( 'sidebar-1' ); 

		echo '<h2 id=recent-sidebar-one>Recent</h2>';
		get_recent_sermons();
		get_recent_series();
	?>

	<form action="index.html">
            <div class='form-group'>
            	<h4>Filter by:</h4>
              <!-- <label class='col-form-label visuallyhidden'>Event Type </label> -->
                  <input id="sermon-topic" class='form-control' list='sermontopics' placeholder="Topic" required>
                    <datalist id="sermontopics">
                      <option value="Lunch">
                      <option value="Dinner">
                      <option value="Breakfast">
                      <option value="Prayer">
                      <option value="Dove Shoot">
                      <option value="Spouse Date">
                    </datalist>
                   <input id="sermon-series" class='form-control' list='sermonseries' placeholder="Series" required>
                    <datalist id="sermonseries">
                      <option value="Lunch">
                      <option value="Dinner">
                      <option value="Breakfast">
                      <option value="Prayer">
                      <option value="Dove Shoot">
                      <option value="Spouse Date">
                    </datalist>
                   <input id="sermon-speaker" class='form-control' list='sermonspeaker' placeholder="Speaker" required>
                    <datalist id="sermonspeaker">
                      <option value="Lunch">
                      <option value="Dinner">
                      <option value="Breakfast">
                      <option value="Prayer">
                      <option value="Dove Shoot">
                      <option value="Spouse Date">
                    </datalist>
                    <input id="sermon-year" class='form-control' list='sermonyear' placeholder="year" required>
                    <datalist id="sermonyear">
                      <option value="Lunch">
                      <option value="Dinner">
                      <option value="Breakfast">
                      <option value="Prayer">
                      <option value="Dove Shoot">
                      <option value="Spouse Date">
                    </datalist>

    </form>
</aside><!-- #secondary -->
