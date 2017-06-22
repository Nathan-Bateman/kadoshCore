<?php
// - standalone json feed -
 
header('Content-Type:application/json');
 
// - grab wp load, wherever it's hiding -
if(file_exists('../../../../wp-load.php')) :
    include '../../../../wp-load.php';
else:
    include '../../../../../wp-load.php';
endif;
 
global $wpdb;