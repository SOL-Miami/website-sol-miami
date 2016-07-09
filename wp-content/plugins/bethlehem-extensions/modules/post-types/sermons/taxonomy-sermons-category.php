<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$template = sermons_locate_template( 'archive-sermons.php' );
load_template( $template );