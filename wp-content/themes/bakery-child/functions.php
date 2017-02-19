<?php 
	if( !function_exists('vu_bakery_child_enqueue_scripts') ) {
		function vu_bakery_child_enqueue_scripts() {
			wp_enqueue_style( 'bakery-child-style', get_stylesheet_directory_uri() . '/style.css', array('bakery-main') );
		}
	}

	add_action( 'wp_enqueue_scripts', 'vu_bakery_child_enqueue_scripts', 99 );
?>